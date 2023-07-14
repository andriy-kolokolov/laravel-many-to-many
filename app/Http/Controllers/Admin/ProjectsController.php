<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use App\Models\Project\ProjectLanguage;
use App\Models\Project\ProjectProgrammingLanguages;
use App\Models\Project\ProjectType;
use App\Models\Project\Technology;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectsController extends Controller
{
    private array $validations = [
        'title' => 'required|string|min:5|max:50',
        'type' => 'nullable|string',
        'programming_languages' => 'required|string|max:500',
        'technologies' => 'string|max:500',
        'description' => 'nullable',
        'project_url' => 'required|url|max:600',
    ];

    private array $validation_messages = [
        'required'  => 'The :attribute field is required',
        'min'       => 'The :attribute field must be at least :min characters',
        'max'       => 'The :attribute field cannot exceed :max characters',
        'url'       => 'The field must be a valid URL',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validations, $this->validation_messages);

        // Create a new project instance and fill it with the validated data
        $project = new Project();
        $project->title = $validatedData['title'];
        $project->description = $validatedData['description'];
        $project->project_url = $validatedData['project_url'];
        $project->save();

        // Process programming languages
        $programmingLanguages = preg_split('/[\s,]+/', $validatedData['programming_languages']);
        $programmingLanguageIds = [];

        foreach ($programmingLanguages as $programmingLanguage) {
            $existingProgrammingLanguage = ProjectProgrammingLanguages::where('programming_language', $programmingLanguage)->first();

            if (!$existingProgrammingLanguage) {
                $programmingLanguageModel = new ProjectProgrammingLanguages();
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
            $types = preg_split('/[\s,]+/', $validatedData['type']);
            foreach ($types as $type) {
                $projectType = new ProjectType();
                $projectType->project_id = $project->id;
                $projectType->type = trim($type);
                $projectType->save();
            }
        }

        return redirect()->route('admin.projects.index')->with('success', $project);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
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
            $existingProgrammingLanguage = ProjectProgrammingLanguages::where('programming_language', $programmingLanguage)->first();

            if (!$existingProgrammingLanguage) {
                $programmingLanguageModel = new ProjectProgrammingLanguages();
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
            $types = preg_split('/[\s,]+/', $validatedData['type']);
            foreach ($types as $type) {
                $projectType = new ProjectType();
                $projectType->project_id = $project->id;
                $projectType->type = trim($type);
                $projectType->save();
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
    public function destroy(Project $project)
    {
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
