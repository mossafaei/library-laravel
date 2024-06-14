@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User') }}</div>

                <div class="card-body">
                    <p>Name: {{$data->name}}</p>
                    <p>Email: {{$data->email}}</p>
                    <p>Address: {{$data->address}}</p>
                    <p>Phone Number: {{$data->phone_number}}</p>

                    <a href="/user/edit/{{$id}}">
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit User
                                </button>
                            </div>
                        </div>
                    </a>

                    <table class="table">
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Name
                            </th>
                        </tr>

                        @foreach($borrows as $borrow)
                        <tr>
                            <th>
                                <a href="/book/{{$borrow->book_id}}">{{$borrow->book_id}}</a>
                            </th>
                            <th>
                                {{$borrow->book()->get()[0]->name}}
                            </th>
                            <th>
                                <form method="POST" action="/take">
                                    @csrf

                                    <input type="text" id="book_id" name="book_id" value="{{$borrow->book_id}}" hidden>
                                    <input type="text" id="user_id" name="user_id" value="{{$id}}" hidden>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Take') }}
                                            </button>

                                        </div>
                                    </div>

                                </form>
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