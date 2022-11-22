
@extends('layouts.master')

@section('main-content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">{{ __('card.dashboard') }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ __('card.dashboard') }}</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">{{ __('card.primary') }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">{{ __('card.warning') }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">{{ __('card.success') }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">{{ __('card.danger') }}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4 mt-5">
                <div class="card-header" style="display:inline-flex">
                    <form action="{{route('admin.search')}}" method="get">
                        @csrf
                        <input type="search" name="search" style="padding: 4px; width:250px">
                        <button type="submit" class="btn btn-primary">{{ __('card.search') }}</button>
                    </form>
                    @can('fullRight')
                    <a href="{{route('admin.addUser')}}">
                    <button class="btn btn-primary" style="margin-left:45px">{{ __('card.Add User') }}</button>
                    </a>

                    <form action="{{route('admin.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div style="display:inline-flex">
                            <input type="file" name="user" style="margin-left:30px; width:35%">
                            <button type="submit" class="btn btn-primary">{{ __('card.Import User') }}</button>
                            <a href="{{route('admin.template')}}" style="margin-left:10px">{{ __('card.Excel Template File')}}</a>
                        </div>
                    </form>
                    @endcan

                </div>

                <div class="card-body">
                    <table id="datatablesSimple" class="table table-strip">
                        <thead>
                            <tr>
                                <th>{{ __('card.Id') }}</th>
                                <th>{{ __('card.Image') }}</th>
                                <th>{{ __('card.Name') }}</th>
                                <th>{{ __('card.Email') }}</th>
                                <th>{{ __('card.Role') }}</th>
                                <th>{{ __('card.Created At') }}</th>
                                <th>{{ __('card.Updated At') }}</th>
                                @role('super-admin')
                                <th>{{ __('card.Operation') }}</th>
                                @endrole
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($data as $item)
                                
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><img src="{{asset('storage/upload/user/'.$item->image)}}" alt="" width="50%"></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @foreach($item->roles as $role)
                                        {{$role->name}}
                                    @endforeach
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                @can('fullRight')    
                                    <a href="{{route('admin.edit',$item->id)}}"><button class="btn btn-primary">Edit</button></a>
                                @endcan
                                
                                @can('fullRight')    
                                    <a href="{{route('admin.delete',$item->id)}}" onclick="return confirm('Are you sure want to delete user?')"><button class="btn btn-danger">Delete</button></a>
                                @endcan   
                                </td>
                                
                            </tr>

                            @endforeach
                        </tbody>                       
                    </table>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </main>
</div>   
@endsection