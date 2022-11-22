@extends('layouts/master')
@section('main-content')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-6">
                <form action="{{route('admin.uploadImage')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photos[]" multiple>
                    <input type="submit">
                </form>
            </div>  
        </div>
    </div>
@endsection