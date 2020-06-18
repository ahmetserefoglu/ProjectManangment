 @extends('adminlte::page')

 @section('title', 'AdminLTE')

 @section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-image (alias)"></i>
        <h3 class="box-title">Departman Listesi</h3>
        
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>

      <!-- /.box-header -->
      <div class="box-body">
        <div class="col-md-8" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
             <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Bilgi!</h4>
              **** ' lı Alanları Doldurmanız Gereklidir.
            </div>
                <h2 class="col-md-6 col-md-offset-4">Yöntem Güncelle</h2>
                <div class="panel-body">
                    <form class="form" role="form" method="POST" action="{{ route('yontemler.update',['id' => $department->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Departman Adı</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $department->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Güncelle
                                </button>
                                <a href="/yontemler" class="btn btn-primary"><i class="fa  fa-mail-reply (alias)"></i></a>
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

