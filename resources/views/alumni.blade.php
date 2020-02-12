@extends('layouts/mainLayout')

@section('content')
<a href="{{url('alumni/add')}}" class="btn btn-primary mg-sm">Add New Alumni</a>
    <div class="alumni">
        @foreach($alumni as $alum)
            <div class="card alumni-card">
                <img src="" class="card-img-top" alt="">
                <div class="card-body">
                    <div class="content">     
                        <h5 class="card-title">{{$alum->name}}</h5>
                        <p class="card-text">{{$alum->gender}}</p>
                        <p class="card-text">{{$alum->email}}</p>
                        <p class="card-text">{{$alum->no_telp}}</p>
                        <p class="card-text">{{$alum->alamat}}</p>
                        <p class="card-text">{{$alum->no_telp}}</p>
                    </div>
                    <div class="inline">
                        <a href="{{url('alumni/'.$alum['id'].'/edit')}}" class="btn btn-primary mg-sm-right">Edit</a>                   
                        <form method="POST" action="{{url('alumni/'.$alum['id'].'/delete')}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection