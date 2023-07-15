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
        'title' => 'required|string|min:5|max:50',
        'type' => 'string|max:50',
        'programming_languages' => 'string|max:500',
        'technologies' => 'string|max:500',
        'description' => 'nullable',
        'project_url' => 'required|url|max:600',
        //        'image' => 'nullable|image|max:1024'
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
        return view('admin.projects.create');
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

        //        $imgPath = Storage::put('uploads', $data['image']);

        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->slug = Str::slug($data['title']);
        $newProject->description = $data['description'];
        $newProject->project_url = $data['project_url'];
        $newProject->save();

        // PROCESS PROGRAMMING LANGUAGES
        $inputProgrammingLanguages = explode(',', $data['programming_languages']); // convert from input string to array
        foreach ($inputProgrammingLanguages as $language) {
            $language = trim(strtoupper($language));
            $existingLanguage = DB::table('programming_languages')
                ->where('name', $language)
                ->first();

            if ($existingLanguage) {
                $newProject->programmingLanguages()->sync($existingLanguage->id);
            } else {
                $newLanguageId = DB::table('programming_languages')->insertGetId(['name' => $language]);
                $newProject->programmingLanguages()->sync([$newLanguageId]);
            }
        }

        // PROCESS PROGRAMMING LANGUAGES
        $inputTechnologies = explode(',', $data['technologies']); // convert from input string to array
        foreach ($inputTechnologies as $technology) {
            $technology = trim(strtoupper($technology));
            $existingTechnology = DB::table('technologies')
                ->where('name', $technology)
                ->first();

            if ($existingTechnology) {
                $newProject->programmingLanguages()->sync($existingTechnology->id);
            } else {
                $newTechnologyId = DB::table('technologies')->insertGetId(['name' => $technology]);
                $newProject->programmingLanguages()->sync([$newTechnologyId]);
            }
        }

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
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project) {
        $validatedData = $request->validate($this->validations, $this->validation_messages);

        // Update the existing project instance with the validated data
        $project->title = $validatedData['title'];
        $project->description = $validatedData['description'];
        $project->project_url = $validatedData['project_url'];
        $project->save();

        // Process programming languages
        $programmingLanguages = preg_split('/[\s,]+/', $validatedData['programming_languages']);
        $programmingLanguageIds = [];

        foreach ($programmingLanguages as $programmingLanguage) {
            $existingProgrammingLanguage = ProgrammingLanguages::where('programming_language', $programmingLanguage)->first();

            if (!$existingProgrammingLanguage) {
                $programmingLanguageModel = new ProgrammingLanguages();
                $programmingLanguageModel->programming_language = $programmingLanguage;
                $programmingLanguageModel->save();
                $programmingLanguageIds[] = $programmingLanguageModel->id;
            } else {
                $programmingLanguageIds[] = $existingProgrammingLanguage->id;
            }
        }
        $project->programmingLanguages()->sync($programmingLanguageIds);

        // Process technologies
        $technologies = preg_split('/[\s,]+/', $validatedData['technologies']);
        $technologiesIds = [];

        foreach ($technologies as $technology) {
            $existingTechnology = Technology::where('name', $technology)->first();

            if (!$existingTechnology) {
                $technologyModel = new Technology();
                $technologyModel->name = $technology;
                $technologyModel->save();
                $technologiesIds[] = $technologyModel->id;
            } else {
                $technologiesIds[] = $existingTechnology->id;
            }
        }
        $project->technologies()->sync($technologiesIds);

        // Process types if provided
        if (!empty($validatedData['type'])) {
            $type = trim($validatedData['type']);
            $projectType = Type::where('project_id', $project->id)->first();

            if ($projectType) {
                $projectType->type = $type;
                $projectType->save();
            } else {
                $newProjectType = new Type();
                $newProjectType->project_id = $project->id;
                $newProjectType->type = $type;
                $newProjectType->save();
            }
        }

        return redirect()->route('admin.projects.index')->with('success', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return Response
     */
    public function destroy(Project $project) {
        $technologies = $project->technologies;
        $project->technologies()->detach();
        foreach ($technologies as $technology) {
            $technology->projects()->detach();
            $technology->delete();
        }
        $project->delete();

        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}
