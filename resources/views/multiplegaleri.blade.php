@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

<div class="row">
  <div class="col-md-12">
       <div class="panel panel-default">
      <div class="panel-heading">
 <i class="fa fa-image (alias)">
      Galeri
    </i>
      </div>

      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            
            @if($galleries->count()>0)
              <table id="" class="table table-striped table-bordered table-responsive">
                <thead>
                  <tr>
                    <th>Galeri Adi</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($galleries as $gallery)
                    <tr>
                      <td>{{$gallery->name}} <span>{{$gallery->images()->count()}}</span></td>
                      <td><a href="/gallery/view/{{$gallery->id}}"><i class="fa fa-folder-open"></i></a></td>
                      <td><a href="/gallery/delete/{{$gallery->id}}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
          <div class="col-md-4" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
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
            <form class="form" method="POST" action="{{ url('gallery/save') }}">
            {!! csrf_field() !!}

             <div class="form-group">
                <input type="text" name="gallery_name" id="gallery_name" placeholder="Galeri Adini Giriniz" class="form-control">
            </div>
                <button class="btn btn-primary">Kaydet</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop