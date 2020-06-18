@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <i class="fa fa-users">
      Gorevler
    </i>
  </div>



  <div class="box-body">
   <div class="col-md-8" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
     <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-info"></i> Bilgi!</h4>
      **** ' lı Alanları Doldurmanız Gereklidir.
    </div>
    <h2 class="col-md-10 col-md-offset-2">Yeni Gorev Ekleme</h2>
    <div class="panel-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.store') }}">
        <div class="form-group">
          <label for="name">Görev Adı</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group">
          <label for="description">Görev Açıklama</label>
          <textarea name="description" rows="5" class="form-control" value="{{ old('description') }}"></textarea>
          @if ($errors->has('description'))
          <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group">
          <label for="description">Start Date</label>
          <input id="tarih" type="date" class="form-control" name="start_date"  value="{{ old('start_date') }}" required autofocus>
          @if ($errors->has('start_date'))
          <span class="help-block">
            <strong>{{ $errors->first('start_date') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group">
          <label for="description">End Date</label>
          <input id="tarih" type="date" class="form-control" name="end_date"  value="{{ old('end_date') }}" required autofocus>
          @if ($errors->has('end_date'))
          <span class="help-block">
            <strong>{{ $errors->first('end_date') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
          <button type="submit" class="btn btn-primary">
            Kaydet
          </button>
          <a href="/tasks" class="btn btn-primary">Geri Al</a>
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
</div>
@stop