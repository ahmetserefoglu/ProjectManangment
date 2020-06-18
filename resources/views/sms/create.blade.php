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
    <div class="col-md-12" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
      
      <h2 class="col-md-10 col-md-offset-4">Yeni Fatura Ekleme</h2>
      <div class="panel-body">                
        <form class="form-horizontal" role="form" method="POST" action="{{ route('sms.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Fatura No</label>

                <div class="col-md-10">
                    <input id="contact_number" type="text" class="form-control" name="contact_number" value="{{ old('contact_number') }}" required autofocus>

                    @if ($errors->has('contact_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contact_number') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

        <div class="form-group">
            <div class="col-md-10 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Kaydet
                </button>
                <a href="/firmalar" class="btn btn-primary">Geri Al</a>
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



