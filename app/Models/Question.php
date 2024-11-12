<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\{Builder, Model, Prunable, SoftDeletes};

class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory;
    use SoftDeletes;
    use Prunable;

    protected $casts = [
        'draft' => 'boolean',
    ];

    /**
     * @return HasMany<Vote, User>
     */
    public function votes(): HasMany
    {
        /** @var HasMany<Vote, User> */
        return $this->hasMany(Vote::class);
    }

    /**
     * @return BelongsTo<User, Question>
     */
    public function createdBy(): BelongsTo
    {
        /** @var BelongsTo<User, Question> */
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return Builder<Question>
     */
    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }
}
