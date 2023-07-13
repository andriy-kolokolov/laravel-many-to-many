<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model {
    use HasFactory;

    public function index() {
        $projects = Project::with('languages', 'frameworks')->get();
        return view('projects.index', compact('projects'));
    }

    public function programmingLanguages(): BelongsToMany {
        return $this->belongsToMany(ProjectProgrammingLanguages::class, 'project_language', 'project_id', 'language_id');
    }

    public function types() {
        return $this->hasMany(ProjectType::class);
    }

    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }
}
