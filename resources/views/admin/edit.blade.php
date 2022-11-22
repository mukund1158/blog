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
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit User</h3></div>
                                <div class="card-body">
                                    <form action="{{route('admin.update')}}" id="userForm" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <input class="form-control" id="inputName" type="text" name="name" value="{{$data->name}}" />
                                           
                                        </div>
                                        <span class="text-danger">
                                            @error('name')
                                            {{$message}}   
                                            @enderror
                                        </span>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="email" value="{{$data->email}}" />
                                        </div>
                                        <span class="text-danger">
                                            @error('email')
                                            {{$message}}   
                                            @enderror
                                        </span>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputDate" name="birthday" type="date" value="{{ $data->birthday}}"/>
                                            <label for="inputEmail">Birth Date</label>
                                        </div>
                                        <span class="text-danger">
                                            @error('birthday')
                                            {{$message}}   
                                            @enderror
                                        </span>

                                        <div class="form-floating mb-3">
                                            <select class="form-control" name="locale" id="inputLang">
                                                <option {{$data->lang == 'en' ? 'selected' : null  }} value="en">English</option>
                                                <option {{$data->lang == 'de' ? 'selected' : null  }} value="de">German</option>
                                            </select>       
                                        </div>
                                        <span class="text-danger">
                                            @error('lang')
                                            {{$message}}   
                                            @enderror
                                        </span>

                                        <button class="btn btn-primary" type="submit">Update</button>
                                        <a href="{{route('admin.dashboard')}}"><button class="btn btn-primary">Close</button></a>  
                                    </form>
                                   
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </main>
        </div> --}}
@endsection