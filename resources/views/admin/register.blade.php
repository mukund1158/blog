@extends('layouts/master')
@section('main-content')
<body>
    {{-- <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main> --}}
                <div class="container">
                    <div class="row justify-content-evenly">
                        <div class="col-md-6">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Add User</h3></div>
                                <div class="card-body">
                                    <form action="{{route('admin.storeUser')}}" id="userForm" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputName" type="text" name="name"  />
                                            <label for="inputEmail">Name</label>
                                        </div>
                                        <span class="text-danger">
                                            @error('name')
                                            {{$message}}   
                                            @enderror
                                        </span>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="email" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <span class="text-danger">
                                            @error('email')
                                            {{$message}}   
                                            @enderror
                                        </span>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" />
                                            <label for="inputEmail">Password</label>
                                        </div>
                                        <span class="text-danger">
                                            @error('password')
                                            {{$message}}   
                                            @enderror
                                        </span>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputDate" name="birthday" type="date"/>
                                            <label for="inputEmail">Birth Date</label>
                                        </div>
                                        <span class="text-danger">
                                            @error('birthday')
                                            {{$message}}   
                                            @enderror
                                        </span>
                                        <div class="form-floating mb-3">
                                            <select class="form-control" name="locale" id="inputLang">
                                                <option value="" selected disabled>Select Language</option>
                                                <option value="en">English</option>
                                                <option value="de">German</option>
                                            </select>       
                                        </div>
                                        <span class="text-danger">
                                            @error('lang')
                                            {{$message}}   
                                            @enderror
                                        </span>

                                        <button class="btn btn-primary" type="submit" >Add user</button>
                                        
                                    </form>
                                    
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </main>
        </div> --}}
@endsection