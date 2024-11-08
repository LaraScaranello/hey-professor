<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory;

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
}
