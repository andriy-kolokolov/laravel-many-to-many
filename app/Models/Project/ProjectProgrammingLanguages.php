<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProgrammingLanguages extends Model
{

    protected $table = 'projects_programming_languages';

    protected $fillable = ['project_id', 'programming_language'];

    use HasFactory;
}
