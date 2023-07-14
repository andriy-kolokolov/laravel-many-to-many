<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model {
    use HasFactory;

    public function programmingLanguages(): BelongsToMany {
        return $this->belongsToMany(ProgrammingLanguage::class);
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class);
    }

    public function technologies(): BelongsToMany {
        return $this->belongsToMany(Technology::class);
    }
}
