<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use App\Models\Project\Type;
use App\Models\Project\Technology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectsController extends Controller {

    private array $validations = [
        'image' => 'nullable|image|max:4096',
        'title' => 'required|string|min:5|max:50',
        'type' => 'required|string',
        'programming_languages' => 'string|max:500',
        'technologies' => 'string|max:500',
        'description' => 'nullable',
        'project_url' => 'required|url|max:600',
    ];

    private array $validation_messages = [
        'required' => 'The :attribute field is required',
        'min' => 'The :attribute field must be at least :min characters',
        'max' => 'The :attribute field cannot exceed :max characters',
        'url' => 'The field must be a valid URL',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $projects = Project::paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse {

        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        $imagePath = Storage::put('uploads', $data['image']);

        //        $imgPath = Storage::put('uploads', $data['image']);

        // get type id (one to many)
        $type_id = DB::table('types')->where('name', $data['type'])->value('id');

        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->type_id = $type_id;
        $newProject->image = $imagePath;
        $newProject->slug = Str::slug($data['title']);
        $newProject->description = $data['description'];
        $newProject->project_url = $data['project_url'];
        $newProject->save();

        // PROCESS PROGRAMMING LANGUAGES
        $newProjectLanguageIds = [];
        $inputProgrammingLanguages = explode(',', $data['programming_languages']); // convert from input string to array

        foreach ($inputProgrammingLanguages as $language) {
            $language = trim(strtoupper($language));
            $existingLanguage = DB::table('programming_languages')
                ->where('name', $language)
                ->first();

            if ($existingLanguage) {
                $newProjectLanguageIds[] = $existingLanguage->id;
            } else {
                $newLanguageId = DB::table('programming_languages')->insertGetId(['name' => $language]);
                $newProjectLanguageIds[] = $newLanguageId;
            }
        }
        $newProject->programmingLanguages()->sync($newProjectLanguageIds);

        // PROCESS TECHNOLOGIES
        $newProjectTechnologyIds = [];
        $inputTechnologies = explode(',', $data['technologies']); // convert from input string to array

        foreach ($inputTechnologies as $technology) {
            $technology = trim(strtoupper($technology));
            $existingTechnology = DB::table('technologies')
                ->where('name', $technology)
                ->first();

            if ($existingTechnology) {
                $newProjectTechnologyIds[] = $existingTechnology->id;
            } else {
                $newTechnologyId = DB::table('technologies')->insertGetId(['name' => $technology]);
                $newProjectTechnologyIds[] = $newTechnologyId;
            }
        }
        $newProject->technologies()->sync($newProjectTechnologyIds);

        return redirect()->route('admin.projects.index')->with('success', $newProject);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project) {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project) {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project) {

        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();
        // if there is image to upload
        if (isset($data['image'])) {
            // save new project image
            $imagePath = Storage::put('uploads', $data['image']);
            // delete old image if exist
            Storage::delete($project->image);
            $project->image = $imagePath;
        }

        // get type id (one to many)
        $type_id = DB::table('types')->where('name', $data['type'])->value('id');

        $project->title = $data['title'];
        $project->type_id = $type_id;
        $project->slug = Str::slug($data['title']);
        $project->description = $data['description'];
        $project->project_url = $data['project_url'];
        $project->update();

        // PROCESS PROGRAMMING LANGUAGES
        // string to array
        $arrayLanguages = explode(',', $data['programming_languages']); // convert from input string to array
        // to upper and trim spaces
        $inputProgrammingLanguages = array_map(function ($element) {
            return strtoupper(trim($element));
        }, $arrayLanguages);
        // Update the project's programming languages
        $projectLanguageIds = [];
        foreach ($inputProgrammingLanguages as $language) {
            $existingLanguage = DB::table('programming_languages')
                ->where('name', $language)
                ->first();
            if ($existingLanguage) {
                $projectLanguageIds[] = $existingLanguage->id;
            } else {
                $newLanguageId = DB::table('programming_languages')->insertGetId(['name' => $language]);
                $projectLanguageIds[] = $newLanguageId;
            }
        }
        // Sync the programming language IDs with the project's programming languages
        $project->programmingLanguages()->sync($projectLanguageIds);


        // PROCESS TECHNOLOGIES
        // string to array
        $arrayTechnologies = explode(',', $data['technologies']); // convert from input string to array
        // to upper and trim spaces
        $inputTechnologies = array_map(function ($element) {
            return strtoupper(trim($element));
        }, $arrayTechnologies);
        // Update the project's technologies
        $projectTechnologyIds = [];
        foreach ($inputTechnologies as $technology) {
            $existingTechnology = DB::table('technologies')
                ->where('name', $technology)
                ->first();
            if ($existingTechnology) {
                $projectTechnologyIds[] = $existingTechnology->id;
            } else {
                $newTechnologyId = DB::table('technologies')->insertGetId(['name' => $technology]);
                $projectTechnologyIds[] = $newTechnologyId;
            }
        }
        // Sync pivot project technology
        $project->technologies()->sync($projectTechnologyIds);

        return redirect()->route('admin.projects.index')->with('success', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return Response
     */
    public function destroy(Project $project) {
        if ($project->image) {
            Storage::delete($project->image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}
