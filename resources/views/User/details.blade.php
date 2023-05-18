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
            <div class="col-md-4">
                <h1>{{$user->name}}</h1>

            </div>
            <div class="w-100"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Roles
                    </div>
                    <div class="card-body">
                        <div class="addnew mb-2">

                            <a href="/user/show/{{$user->id}}"><button class="btn btn-primary">Assign New Role</button></a>
                        </div>
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Roles</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->name}}</td>

                                    <td><a href="/user/rolepermission/{{$i->id}}"><button class="btn btn-primary">View Permissions</button></a></td>
                                    <td>
                                        <form action="/user/revokerole" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="roleid" value="{{$i->id}}">
                                            <input type="hidden" name="userid" value="{{$user->id}}">
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
