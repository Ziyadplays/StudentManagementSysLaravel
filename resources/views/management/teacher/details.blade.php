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
                <h1>{{$teacher->name}}</h1>

            </div>
            <div class="w-100"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Classes
                    </div>
                    <div class="card-body">
                        <div class="addnew mb-2">

                            <a href="/teacher/showclass/{{$teacher->id}}"><button class="btn btn-primary">Assign New Class</button></a>
                        </div>
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Class</th>
                                <th scope="col">Section</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teacher->studentClass as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->name}}</td>
                                    <td>{{$i->section}}</td>
                                    <td><a href="/teacher/classpage/{{$i->id}}"><button class="btn btn-primary">View Classes</button></a></td>
                                    <td>
                                        <form action="/teacher/deleteclass" method="post">
                                            @csrf
                                            <input type="hidden" name="classid" value="{{$i->id}}">
                                            <input type="hidden" name="teacherid" value="{{$teacher->id}}">
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
        <div class="row mt-4"   >
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Students</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Class</th>
                                <th scope="col">Section</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{\App\Models\Student::find($i->id)->user->name}}</td>
                                    <td>{{$i->studentClass->name}}</td>
                                    <td>{{$i->studentClass->section}}</td>
                                    {{--                                    <td><a href="/class/classpage/{{$i->id}}"><button class="btn btn-primary">View Classes</button></a></td>--}}
                                    {{--                                    <td>--}}
                                    {{--                                        <form action="/teacher/deleteclass" method="post">--}}
                                    {{--                                            @csrf--}}
                                    {{--                                            <input type="hidden" name="classid" value="{{$i->id}}">--}}
                                    {{--                                            <input type="hidden" name="teacherid" value="{{$teacher->id}}">--}}
                                    {{--                                            <button type="submit" class="btn btn-primary">Delete</button>--}}
                                    {{--                                        </form>--}}
{{--                                    </td>--}}
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
