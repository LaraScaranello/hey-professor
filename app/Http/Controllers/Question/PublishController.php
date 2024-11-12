<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\{RedirectResponse};

class PublishController extends Controller
{
    use AuthorizesRequests;

    /**
     * @throws AuthorizationException
     */
    public function __invoke(Question $question): RedirectResponse
    {
        $this->authorize('publish', $question);

        $question->update(['draft' => false]);

        return back();
    }
}
