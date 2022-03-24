<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success_create'))
                            <div class="alert alert-success" role="alert">
                                The Film <b>{{ session('success_create') }}</b> was successfully added!
                            </div>
                    @endif

                    @if(session('success_delete'))
                            <div class="alert alert-success" role="alert">
                                The Filmlog for <b>{{ session('success_delete') }}</b> was successfully deleted!
                            </div>
                    @endif

                    <div style="margin:auto;text-align: center;">
                    <form method="POST" action="/search-film/">
                        @csrf
                        <input type="text" name="search_film" placeholder="Search film" required="required">
                        <button type="submit" name="search_submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            SEARCH
                        </button>
                    </form>
                    </div>

                    <br>
                    <br>
                        @isset($filmlogs)
                            <h4 class=""><b>Your Films</b></h4>
                            @if(count($filmlogs) <= 0)
                            <p class=""><b>You have no films logged yet.</b></p>
                            @endif

                        <br>

                            <div class="container">
                                <div class="row">


                            @foreach ($filmlogs as $flog)
                                <div class="col-sm-3 mb-4">
                                    <div class="text-center w-48" style="text-align: -moz-center;">
                                        <img src="{{ $flog->poster_url }}" width="200px">

                                        {{ $flog->title }} ({{ $flog->year }})
                                        <input type="hidden" name="imdbID" value="{{ $flog->imdb_id }}">
                                        <input type="hidden" name="type" value="{{ $flog->type }}">

                                        <form method="POST" action="/delete-filmlog">
                                            @csrf
                                            <input type="hidden" name="filmlog_id" value="{{ $flog->id }}">
                                            <input type="hidden" name="title" value="{{ $flog->title }}">

                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                                                DELETE
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                                </div>
                            </div>

                        @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
