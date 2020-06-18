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
             <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Bilgi!</h4>
              **** ' lı Alanları Doldurmanız Gereklidir.
            </div>
       @if (count($errors) > 0)
       <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif


      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
      @endif

        <h2 class="col-md-10 col-md-offset-4">Proje Durum Ekleme</h2>
        <div class="panel-body"> 
      <form class="form-horizontal" role="form" method="POST" action="{{ route('proje.upload') }}">
        {!! csrf_field() !!}

        <div class="form-group row">
          <label for="title" class="col-md-2 control-label">Proje Adı</label>
          <div class="col-md-10">
            <select name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" data-placeholder="Select a State"
              style="width: 100%;" >
              @if($projeler->count()>0)
              <option  value="0">Seciniz</option>
              @foreach ($projeler as $proje)
              <option  value="{{$proje->ProjeAdi}}">{{$proje->ProjeAdi}}</option>
              @endforeach
              @else
              <option  value="">Bulunamadı</option>
              @endif

              @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
              @endif
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="overview" class="col-md-2 control-label">Aciklama</label>
          <div class="col-md-10">
            <textarea id="overview" cols="10" rows="10" class="form-control{{ $errors->has('overview') ? ' is-invalid' : '' }}" name="overview" value="{{ old('overview') }}" required autofocus></textarea>
            @if ($errors->has('overview'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('overview') }}</strong>
            </span>
            @endif
          </div>
        </div>


        <div class="form-group row">
          <label for="durumu" class="col-md-2 control-label">Durumu</label>
          <div class="col-md-10">
            <select id="durumu" cols="10" rows="10" class="form-control{{ $errors->has('durumu') ? ' is-invalid' : '' }}" name="durumu" value="{{ old('durumu') }}">
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
              Kaydet
            </button>
            <a class="btn btn-primary" href="/projedurum/">Geri Al</a>
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