@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <i class="fa fa-image (alias)">
      Proje Durum
    </i>

  </div>

  <div class="box-body">
    <div class="col-md-8" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">

      <h2 class="col-md-10 col-md-offset-4">Proje Kisi Güncelleme</h2>
      <div class="panel-body"> 
        <form class="form-horizontal" role="form" method="POST" action="{{ route('projeler.projekisidetayguncelle',['id' => $projeler->id]) }}">
          {!! csrf_field() !!}
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Proje Kisiler</label>
            <div class="col-sm-9">
              <select name="kisi" class="form-control select2" data-placeholder="Proje Kisiler"
              style="width: 100%;">
              <option  value="{{$projeler->userid}}">{{$projeler->isim}}</option>
              @foreach($kisiler as $kisi)
              <option  value="{{$kisi->id}}">{{$kisi->name}}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label for="durumu" class="col-md-2 control-label">Durumu</label>
          <div class="col-md-10">
            <select id="durum" cols="10" rows="10" class="form-control{{ $errors->has('durum') ? ' is-invalid' : '' }}" name="durum" value="{{ $projeler->durum }}">
              <option value="{{$projeler->durum}}">{{$projeler->durum}}</option>
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
              <option value="40">40</option>
              <option value="50">50</option>
              <option value="60">60</option>
              <option value="70">70</option>
              <option value="80">80</option>
              <option value="90">90</option>
              <option value="100">100</option>
            </select>

            @if ($errors->has('overview'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('overview') }}</strong>
            </span>
            @endif
          </div>
        </div>


        <div class="form-group row mb-0">
          <div class="col-sm-6 col-md-offset-2">
            <button type="submit" class="btn btn-primary">
              Kaydet
            </button>
            <a class="btn btn-primary" href="/projeler/kisiler/{{$projeler->proje_id}}">Geri Al</a>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>
</div>
</div>
</div>
@stop