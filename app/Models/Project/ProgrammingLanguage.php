<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProgrammingLanguage extends Model {
    use HasFactory;

    public $timestamps = false;

    public function projects(): BelongsToMany {
        return $this->belongsToMany(Project::class);
    }
}
