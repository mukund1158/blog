@extends('layouts/app')
@section('content')
    

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-3">
                <hr>
                {{session('success')}}
                <hr>
                <h3>Enter Email Ids</h3>
                <form action="{{route('queue')}}" method="post">
                    @csrf
                    <textarea name="emails" id="" cols="60" rows="4"></textarea><br>
                    <button type="submit" class="btn btn-primary">Send Mails</button>
                </form>
            </div>
        </div>
    </div>
@endsection