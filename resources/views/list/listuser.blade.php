@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <form method="GET" action="/user/">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="searchEmail" type="text" class="form-control @error('searchEmail') is-invalid @enderror" name="searchEmail" value="{{ old('searchEmail') }}" required autocomplete="searchEmail" autofocus>

                                @error('searchEmail')
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
                                Email
                            </th>
                        </tr>

                        @foreach($data as $user)
                        <tr>
                            <th>
                                <a href="/user/{{$user->id}}">{{$user->id}}</a>
                            </th>
                            <th>
                                {{$user->name}}
                            </th>
                            <th>
                                {{$user->email}}
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