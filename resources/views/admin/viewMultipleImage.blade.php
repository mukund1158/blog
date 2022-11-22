@extends('layouts/master')
@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @foreach ($data as $item)
                    
                    @foreach (json_decode($item->name) as $image)
                    <img src="{{asset('/storage/multiupload/'.$image)}}" alt={{$image}}>        
                    @endforeach
                
                @endforeach
            </div>
        </div>
    </div>
@endsection