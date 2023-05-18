@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            Clases
        </div>
        <div class="card-body">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sections</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classes as $i)
                    <tr>
                        <td>{{$i->id}}</td>
                        <td>{{$i->name}}</td>
                        <td>{{$i->section}}</td>
                        <td><a href="/class/view/{{$i->id}}"><button class="btn btn-primary">View Details</button></a></td>
                        <td><a href="/class/delete/{{$i->id}}"><button class="btn btn-primary">Delete</button></a></td>
{{--                        <td><a href=""><button class="btn btn-primary">Edit</button></a></td>--}}
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
