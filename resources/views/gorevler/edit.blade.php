 @extends('adminlte::page')

 @section('title', 'AdminLTE')


 @section('content')
 <div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
      <div class="panel-heading">
         <i class="fa fa-image (alias)">
          {{ $page_title or "Page Title" }}
      </i>
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <div class="col-md-8" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
             <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Bilgi!</h4>
              **** ' lı Alanları Doldurmanız Gereklidir.
            </div>
        <h2 > Gorev Duzenle</h2>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('gorevler.update',['id' => $gorev->id]) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Text</label>

                    <div class="col-md-10">
                        <input id="text" type="text" class="form-control" name="text" value="{{ $gorev->text }}" required autofocus>

                        @if ($errors->has('text'))
                        <span class="help-block">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Süre</label>

                    <div class="col-md-10">
                        <input id="duration" type="text" class="form-control" name="duration" value="{{ $gorev->duration }}" required autofocus>

                        @if ($errors->has('duration'))
                        <span class="help-block">
                            <strong>{{ $errors->first('duration') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('progress') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">İlerleme</label>

                    <div class="col-md-10">
                        <input id="progress" class="form-control" type="number" name="progress" value="{{ $gorev->progress }}" required autofocusx data-decimals="2" min="0" max="1" step="0.1"/>
                        @if ($errors->has('progress'))
                        <span class="help-block">
                            <strong>{{ $errors->first('progress') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Başlama Tarihi</label>

                    <div class="col-md-10">
                        <input  id="" type="date" class="form-control" name="start_date" value="{{ $gorev->start_date }}" required autofocus>

                        @if ($errors->has('start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('parent') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Parent </label>

                    <div class="col-md-10">
                        <input id="parent" type="text" class="form-control" name="parent" value="{{ $gorev->parent }}" required autofocus>

                        @if ($errors->has('parent'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('sortorder') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">sortorder </label>

                    <div class="col-md-10">
                        <input id="sortorder" type="text" class="form-control" name="sortorder" value="{{ $gorev->sortorder }}" required autofocus>

                        @if ($errors->has('sortorder'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sortorder') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Kaydet
                        </button>
                        <a href="/gorevler" class="btn btn-primary">Geri Al</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
@stop



