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
                            <div class="container mt-5">
                                <h4 class="text-center mb-4"><b>Your Films</b></h4>

                                @if(count($filmlogs) <= 0)
                                    <p class="text-center mb-4"><b>You have no films logged yet.</b></p>
                                @endif

                                <div class="row justify-content-center">
                                    @foreach ($filmlogs as $flog)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                            <div class="card h-100">
                                                @if($flog->film->poster_url)
                                                    <img src="{{ $flog->film->poster_url }}" class="card-img-top" alt="{{ $flog->film->title }}">
                                                @else
                                                    <div class="card-img-placeholder"></div>
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $flog->film->title }} ({{ $flog->film->year }})</h5>
                                                    <form method="POST" action="/delete-filmlog/{{ $flog->id }}">
                                                        @csrf
                                                        <input type="hidden" name="imdbID" value="{{ $flog->film->imdb_id }}">
                                                        <input type="hidden" name="type" value="{{ $flog->film->type }}">
                                                        <button type="submit" class="btn btn-dark btn-sm btn-block mt-3 btn-delete">
                                                            DELETE
                                                        </button>
                                                    </form>
                                                </div>
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
