@extends('layouts/mainLayout')

@section('content')
<div class="mg-sm">
    <form method="POST" action="{{url('/alumni/'.$alum->id)}}">
    @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='name' value="{{$alum->name}}">
            </div>
            @if ($errors->has('name'))
            <span role="alert">
                <strong class="error-text">{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Angkatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='angkatan' value="{{$alum->angkatan}}">
            </div>
            @if ($errors->has('angkatan'))
            <span role="alert">
                <strong class="error-text">{{ $errors->first('angkatan') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name='email' value="{{$alum->email}}">
            </div>
            @if ($errors->has('email'))
            <span role="alert">
                <strong class="error-text">{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">No Telp</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='no_telp' value="{{$alum->no_telp}}">
            </div>
            @if ($errors->has('no_telp'))
            <span role="alert">
                <strong class="error-text">{{ $errors->first('no_telp') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tempat Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='tempat_lahir'value="{{$alum->tempat_lahir}}">
            </div>
            @if ($errors->has('tempat_lahir'))
            <span role="alert">
                <strong class="error-text">{{ $errors->first('tempat_lahir') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="date form-control"  id="datepicker" name="tanggal_lahir" value="{{$alum->tanggal_lahir}}">
            </div>
            @if ($errors->has('tanggal_lahir'))
            <span role="alert">
                <strong class="error-text">{{ $errors->first('tanggal_lahir') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="alamat" rows="3">{{$alum->alamat}}</textarea>
            </div>
            @if ($errors->has('alamat'))
            <span role="alert">
                <strong class="error-text">{{ $errors->first('alamat') }}</strong>
            </span>
            @endif
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">
                        <label class="form-check-label" for="gridRadios2">
                            Female
                        </label>
                    </div>
                </div>
                @if ($errors->has('gender'))
                <span role="alert">
                    <strong class="error-text">{{ $errors->first('gender') }}</strong>
                </span>
                @endif
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{url('/alumni')}}" class="btn btn-light">cancel</a>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
   });
</script>
@endsection