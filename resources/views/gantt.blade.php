
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ $page_title or "Page Title" }}
      </div>

      <div class="panel-body" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
        <div id=“gridbox” style="width:100%; height:100%; overflow:hidden;" >
          <div id="gantt_here"  style='width:100%; height:700px;'></div>
        </div>
      </div> <!-- container / end -->

    </div>
  </div>
</div>
@section('js')
<script src="{{ asset ('/js/gantx.js') }}"></script>
@stop
@stop