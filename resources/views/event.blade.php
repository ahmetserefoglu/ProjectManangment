@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

@endsection

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
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Bilgi!</h4>
        **** ' lı Alanları Doldurmanız Gereklidir.
      </div>
      <h2 class="col-md-10 col-md-offset-2">Yeni Gorev Ekleme</h2>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('events.add') }}">
      {{ csrf_field() }}
     <div class="row" style="border: 2px solid #a1a1a1;">

      <div class="panel-body">
        <div class="col-xs-12 col-sm-12 col-md-12">
          @if (Session::has('success'))
          <div class="alert alert-success">{{ Session::get('success') }}</div>
          @elseif (Session::has('warnning'))
          <div class="alert alert-danger">{{ Session::get('warnning') }}</div>
          @endif
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
          <label for="name">Görev Adı</label>
          <input type="text" name="event_name" class="form-control" value="{{ old('event_name') }}" required autofocus>
          @if ($errors->has('event_name'))
          <span class="help-block">
            <strong>{{ $errors->first('event_name') }}</strong>
          </span>
          @endif
        </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
          <label for="description">Start Date</label>
          <input id="tarih" type="date" class="form-control" name="start_date"  value="{{ old('start_date') }}" required autofocus>
          @if ($errors->has('start_date'))
          <span class="help-block">
            <strong>{{ $errors->first('start_date') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="col-xs-3 col-sm-3 col-md-3">
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

      <div class="col-xs-1 col-sm-1 col-md-1 text-center">
          <button type="submit" class="btn btn-primary">
            Kaydet
          </button>
          <a href="/tasks" class="btn btn-primary">Geri Al</a>
        </div>
        </div>
    </form>

  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">MY Event Details</div>
  <div class="panel-body" >
    {!! $calendar_details->calendar() !!}
  </div>
</div>
</div>
</div>

@section('js')


<!-- Scripts -->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

{!! $calendar_details->script() !!}

@endsection

@stop

