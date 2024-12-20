<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * @return HasMany<Vote, User>
     */
    public function votes(): HasMany
    {
        /** @var HasMany<Vote, User> */
        return $this->hasMany(Vote::class);
    }

    /**
     * @return HasMany<Question, User>
     */
    public function questions(): HasMany
    {
        /** @var HasMany<Question, User> */
        return $this->hasMany(Question::class, 'created_by');
    }

    public function like(Question $question): Void
    {
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id],
            [
                'like'   => 1,
                'unlike' => 0,
            ]
        );
    }

    public function unlike(Question $question): Void
    {
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id],
            [
                'like'   => 0,
                'unlike' => 1,
            ]
        );
    }
}
