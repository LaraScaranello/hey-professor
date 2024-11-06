<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory;

    /**
     * @return HasMany<Vote, User>
     */
    public function votes(): HasMany
    {
        /** @var HasMany<Vote, User> */
        return $this->hasMany(Vote::class);
    }

    /**
     * @return Attribute<int, null>
     */
    public function likes(): Attribute
    {
        return new Attribute(get: fn (): int => $this->votes()->sum('like'));
    }

    /**
     * @return Attribute<int, null>
     */
    public function unlikes(): Attribute
    {
        return new Attribute(get: fn (): int => $this->votes()->sum('unlike'));
    }
}
