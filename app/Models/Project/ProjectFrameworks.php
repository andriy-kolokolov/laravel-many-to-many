<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFrameworks extends Model
{
    use HasFactory;

    // Set the table name explicitly TO DISABLE DEFAULT PLURALIZATION
    protected $table = 'projects_frameworks';
}
