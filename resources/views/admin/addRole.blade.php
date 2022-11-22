@extends('layouts.master')
@section('main-content')
<div class="col-5 offset-2">
    <div class="card mb-4 mt-5">
        <div class="card-header">
            <h5 class="text-center">Select user to assign role</h5>
        </div>

        <div class="card-body">
            <form action="{{route('admin.addRole')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name and Email</label>
                    <select id="" name="name" class="form-select">
                        <option value="" selected disabled>Select user</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}} => {{$user->email}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Role</label>
                    <select id="" name="role" class="form-select">
                        <option value="" selected disabled>Select user</option>
                            <option value="2">Admin</option>
                            <option value="1">Super-Admin</option>
                            <option value="3">User</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
               
            </form>
           
        </div>
    </div>
</div>
@endsection