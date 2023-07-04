@extends('layouts.master')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            Students
        </div>
        <div class="card-body">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $i)
                    <tr>
                        <td>{{$i->id}}</td>
                        <td>{{$i->user->name}}</td>
                        <td><a href="/student/view/{{$i->id}}">
                                <button class="btn btn-primary">View Details</button>
                            </a>
                        </td>
                        <td>
                            <form action="/student/delete/" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$i->id}}">
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </td>
                        <td><a href="class/view/updatestudentclass/{{$i->id}}">
                                <button class="btn btn-primary">Change Class</button>
                            </a></td>
                        <td><a href="student/edit/{{$i->id}}">
                                <button class="btn btn-primary">Edit Student</button>
                            </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{--        <div class="d-flex justify-content-center">--}}
        {{--            {!! $students->links('pagination::bootstrap-5') !!}--}}
        {{--        </div>--}}
    </div>

@endsection
