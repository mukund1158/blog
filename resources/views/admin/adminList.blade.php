@extends('layouts.master')

@section('main-content')
<div class="col-10">
    <div class="card mb-4 mt-5">

        <div class="card-header" style="display:inline-flex">
            @can('fullRight')
                <a href="{{route('admin.addRoleForm')}}">
                    <button class="btn btn-primary" style="margin-left:45px">Add user to assign role</button>
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th>Created At</th>
                        <th>Updated At</th>   
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @foreach($user->roles as $role)
                            <td>{{$role->name}}</td>
                                
                            @foreach($role->permissions as $permission)
                                <td>{{$permission->name}}</td>        
                            @endforeach
                        
                        @endforeach    
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
    </div>
</div>
@endsection