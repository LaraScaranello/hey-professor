<?php

namespace App\Http\Controllers;

use App\Models\Question;

use function App\Support\user;

use Closure;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\{RedirectResponse};
use Illuminate\View\View;

class QuestionController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        return view('question.index', [
            'questions' => user()->questions,
        ]);
    }

    public function store(): RedirectResponse
    {
        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail("Are you shure that is a question? It is missing the question mark in the end.");
                    }
                },
            ],
        ]);

        user()->questions()
            ->create([
                'question' => request()->question,
                'draft'    => true,
            ]);

        return back();
    }

    public function edit(Question $question): View
    {

        return view('question.edit', compact('question'));
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);
        $question->delete();

        return back();
    }
}
