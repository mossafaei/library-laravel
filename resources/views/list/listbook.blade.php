@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <form method="GET" action="/book/">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="searchName" type="text" class="form-control @error('searchName') is-invalid @enderror" name="searchName" value="{{ old('searchName') }}" required autocomplete="searchName" autofocus>

                                @error('searchName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>

                            </div>
                        </div>

                    </form>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Total
                            </th>
                            <th>
                                Available
                            </th>
                        </tr>

                        @foreach($data as $book)
                        <tr>
                            <th>
                                <a href="/book/{{$book->id}}">{{$book->id}}</a>
                            </th>
                            <th>
                                {{$book->name}}
                            </th>
                            <th class="text-truncate">
                                {{$book->description}}
                            </th>
                            <th>
                                {{$book->count}}
                            </th>
                            <th>
                                {{$book->count - $book->borrows()->whereNull('end_date')->count()}}
                            </th>
                        </tr>
                        @endforeach
                        
                    </table>
                    {{ $data->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection