@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row justify-content-evenly">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Profile</h3></div>
                <div class="card-body">
                    <form action="{{route('user.updateUser')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-floating mb-3">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input class="form-control" id="inputEmail" type="file" name="avtar" value="{{$user->image}}"/>
                        </div>
                        <span class="text-danger">
                            @error('avtar')
                            {{$message}}   
                            @enderror
                        </span>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEmail" type="text" name="name" value="{{$user->name}}"/>
                            <label for="inputEmail">Name</label>
                        </div>
                        <span class="text-danger">
                            @error('name')
                            {{$message}}   
                            @enderror
                        </span>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEmail" name="email" type="email" value="{{$user->email}}" />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <span class="text-danger">
                            @error('email')
                            {{$message}}   
                            @enderror
                        </span>
                        

                        

                        <button class="btn btn-primary" type="submit">Update</button>  
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection