@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('home')}}" style="text-decoration: none; color:black;"> {{ __('Home') }}</a>
{{-- 
                    @canany(['edit', 'delete', 'addUser'])
                    <a href="{{route('admin.dashboard')}}" style="text-decoration: none; color:black; margin-left:50px"> {{ __('Dashboard') }}</a>
                    @endcanany --}}
                     
                    @hasanyrole('sub-admin|super-admin|admin')
                    <a href="{{route('admin.dashboard')}}" style="text-decoration: none; color:black; margin-left:50px"> {{ __('Dashboard') }}</a>
                    @endhasanyrole

                   
                   
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @can('isAdmin')
                        <h4 class="text-center"> This is for Admin</h4>
                    @endcan

                    @can('isSubAdmin')
                        <h4 class="text-center"> This is for Sub-Admin</h4>
                    @endcan

                    @can('isSuperAdmin')
                        <h4 class="text-center"> This is for Super-Admin</h4>
                    @endcan

                    @can('isUser')
                        <h4 class="text-center"> This is for User</h4>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
