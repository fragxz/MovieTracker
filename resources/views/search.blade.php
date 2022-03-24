<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="font-semibold text-xl text-gray-800 leading-tight">Add a new film!</div>
<br>
                    @isset($films)
                        <p>We found the following films:</p><br>
                        @foreach ($films as $film)
                            <form method="POST" action="/add-film">
                                @csrf
                                <p>
                                    {{ $film['Title'] }}
                                    <input type="hidden" name="title" value="{{ $film['Title'] }}">
                                    <input type="hidden" name="year" value="{{ $film['Year'] }}">
                                    <input type="hidden" name="imdbID" value="{{ $film['imdbID'] }}">
                                    <input type="hidden" name="type" value="{{ $film['Type'] }}">
                                    <input type="hidden" name="poster" value="{{ $film['Poster'] }}">
                                    <button type="submit" name="submit_add" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                                        ADD
                                    </button>
                                </p>
                            </form>
                        @endforeach
                    @else
                        Sorry! No films were found. Please check your search request for typos.<br>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
