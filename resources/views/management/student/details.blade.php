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
                <h1>{{$student->name}}</h1>
            </div>
            <div class="w-100"></div>
            <div class="col-md-8">
                <div class="col-md-4">
                    <h1>Classes</h1>
                </div>
                <div class="card">
                    <div class="card-body">
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
                            <tr>
                                @if($class != null)
                                    <td>{{$class->id}}</td>
                                    <td>{{$class->name}}</td>
                                    <td>{{$class->section}}</td>
                                    <td><a href="/student/classpage/{{$class->id}}">
                                            <button class="btn btn-primary">View Class Page</button>
                                        </a></td>
                                    <td>
                                        <form action="/student/deleteclass" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="classid" value="{{$class->id}}">
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form>
                                    </td>
                                    <td><a href="">
                                            <button class="btn btn-primary">Edit</button>
                                        </a></td>
                                @endif

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <h1>Teachers</h1>
            </div>
            <div class="w-100"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Teacher</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if($class != null)
                                @foreach($class->Teacher as $i)
                                    <tr>

                                        <td>{{$i->id}}</td>
                                        <td>{{\App\Models\Teacher::find($i->id)->user->name}}</td>
                                        <td><a href="/student/teacherpage/{{$i->id}}">
                                                <button class="btn btn-primary">View Teachers Page</button>
                                            </a></td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection
