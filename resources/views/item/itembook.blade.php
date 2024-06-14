@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Book') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <p>Name: {{$data->name}}</p>
                    <p>Description: {{$data->description}}</p>
                    <p>Available in the library: {{$lend}}</p>
                    <p>Total: {{$data->count}} </p>

                    <a href="/book/edit/{{$id}}">
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit Book
                                </button>
                            </div>
                        </div>
                    </a>
                    
                    <p></p>

                    @if($lend > 0)
                    <form method="POST" action="/lend">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3" hidden>
                            <label for="book_id" class="col-md-4 col-form-label text-md-end">{{ __('Book_id') }}</label>

                            <div class="col-md-6">
                                <input value="{{$id}}" id="book_id" type="text" class="form-control @error('book_id') is-invalid @enderror" name="book_id" value="{{ old('book_id') }}" required autocomplete="book_id" autofocus>

                                @error('book_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Lend The Book') }}
                                </button>

                            </div>
                        </div>

                    </form>
                    @endif

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
                            <th>
                                Start
                            </th>
                            <th>
                                End
                            </th>
                        </tr>

                        @foreach($borrows as $borrow)
                        <tr>
                            <th>
                                <a href="/user/{{$borrow->user_id}}">{{$borrow->user_id}}</a>
                            </th>
                            <th>
                                {{$borrow->user()->get()[0]->name}}
                            </th>
                            <th>
                                {{$borrow->user()->get()[0]->email}}
                            </th>
                            <th>
                                {{$borrow->created_at}}
                            </th>
                            <th>
                                {{$borrow->end_date}}
                            </th>
                        </tr>
                        @endforeach
                        
                    </table>
                    {{ $borrows->links('pagination::bootstrap-4') }}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection