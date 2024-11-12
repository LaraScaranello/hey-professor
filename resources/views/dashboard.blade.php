<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Vote for a question') }}
        </x-header>
    </x-slot>

    <x-container>
        {{-- listagem --}}
        <div class="dark:text-gray-400 uppercase font-bold mb-1">List of Questions</div>
        <div class="dark:text-gray-400 space-y-4">

            <form action="{{ route('dashboard') }}" method="get" class="flex items-center space-x-2">
                @csrf
                <x-text-input type="text" name="search" value="{{ request()->search }}" class="w-full" />
                <x-btn.primary type="submit">Search</x-btn.primary>
            </form>

            @if($questions->isEmpty())
                <div class="dark:text-gray-300 text-center flex flex-col justify-center">
                    <div class="flex justify-center">
                        <x-draw.searching width="300" />
                    </div>
                    <div class="mt-4 dark:text-gray-400 font-bold text-2xl">
                        Question not found
                    </div>
                </div>
            @else
                @foreach($questions as $item)
                    <x-question :question="$item" />
                @endforeach

                {{ $questions->withQueryString()->links() }}
            @endif
        </div>
    </x-container>
</x-app-layout>
