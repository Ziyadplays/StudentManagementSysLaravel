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
                       <h1>Permissions</h1>
                   </div>
                   <div class="card-body">
                       <div class="addnew mb-2">
                           <a href="/role/permissionview/{{$role->id}}"><button class="btn btn-primary">Add New Permission</button></a>
                       </div>
                       <table class="table table-striped table-dark">
                           <thead>
                           <tr>
                               <th scope="col">#</th>
                               <th scope="col">Permission</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($permission as $i)
                               <tr>
                                   <td>{{$i->id}}</td>
                                   <td>{{$i->name}}</td>
                                   <td>
                                       <form action="/role/revokepermission" method="POST">
                                           @csrf
                                           @method('DELETE')

                                           <input type="hidden" name="permissionid" value="{{$i->id}}">
                                           <input type="hidden" name="roleid" value="{{$role->id}}">
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
