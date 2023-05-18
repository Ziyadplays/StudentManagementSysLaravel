@extends('layouts.master')
@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1>Users</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->name}}</td>
                                    <td><a href="/user/view/{{$i->id}}"><button class = 'btn btn-primary'>View More</button></a></td>
                                    <td><a href="/user/edit/{{$i->id}}"><button class = 'btn btn-primary'>Edit</button></a></td>
                                    <td>
                                        <form action="/user/delete" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{$i->id}}">
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>

@endsection
