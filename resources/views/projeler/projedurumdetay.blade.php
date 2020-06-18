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

    <h2 class="col-md-10 col-md-offset-4">Proje Durum Güncelle</h2>
    <div class="panel-body"> 
      <form class="form-horizontal" role="form" method="POST" action="{{ route('projeler.projedurumguncelle',['id' => $projedetay->proje_id]) }}">
        {!! csrf_field() !!}
        <div class="form-group row">
          <label for="title" class="col-md-2 control-label">Proje Detay Basligi</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="proje_detay_baslik" value="{{ $projedetay->proje_detay_baslik }}" >
              @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
              @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="overview" class="col-md-2 control-label">Detay</label>
          <div class="col-md-10">
            <textarea id="proje_detay" cols="10" rows="10" class="form-control{{ $errors->has('proje_detay') ? ' is-invalid' : '' }}" name="proje_detay" value="" required autofocus>{{$projedetay->proje_detay}}</textarea>
            @if ($errors->has('proje_detay'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('proje_detay') }}</strong>
            </span>
            @endif
          </div>
        </div>


        <div class="form-group row">
          <label for="durumu" class="col-md-2 control-label">Durumu</label>
          <div class="col-md-10">
            <select id="durumu" cols="10" rows="10" class="form-control{{ $errors->has('durumu') ? ' is-invalid' : '' }}" name="durumu" value="{{ $projedetay->durumu }}">
              <option value="{{$projedetay->durumu}}">{{$projedetay->durumu}}</option>
              <option value="0">Seçiniz</option>
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
              Güncelle
            </button>
            <a class="btn btn-primary" href="/projeler/detay/{{$projedetay->proje_id}}">Geri Al</a>
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