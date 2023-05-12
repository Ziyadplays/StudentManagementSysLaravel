@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <h1>Class {{$class->name}}-{{$class->section}}</h1>
            </div>
            <div class="w-100"></div>
            <div class="col-md-8 mt-2">
                <div class="card">
                    <div class="card-header">
                        Teachers
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Teachers</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($class->Teacher as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->name}}</td>
                                    <td><a href="classpage/{{$i->id }}}"><button class="btn btn-primary">View More</button></a></td>
                                    <td>
                                        <form action="deleteteacher" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name='id' value="{{$i->id}}">
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form></td>
                                    <td><a href=""><button class="btn btn-primary">Edit</button></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mt-2">
                <div class="card">
                    <div class="card-header">
                        Students
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Teachers</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->name}}</td>
                                    <td><a href="studentpage/{{$i->id }}}"><button class="btn btn-primary">View More</button></a></td>
{{--                                    <td>--}}
{{--                                        <form action="updatestudentclass" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('PUT')--}}
{{--                                            <input type="hidden" name='id' value="{{$i->id}}">--}}
{{--                                            <button type="submit" class="   btn btn-primary">Delete</button>--}}
{{--                                        </form></td>--}}
                                    <td><a href="updatestudentclass/{{$i->id}}"><button class="btn btn-primary">Change Class</button></a></td>
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
