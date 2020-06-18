@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <i class="fa fa-file-archive-o">
     
    </i>
    Galeri:<b>{{$gallery->proje["ProjeAdi"]}}</b>
    <div class="box-tools pull-right">
     <a class="btn btn-primary btn-xs" href="/projeler/detay/{{$gallery->proje_id}}"><i class="fa  fa-mail-reply (alias)"></i></a>
   </div>
  </div>

  <div class="box-body">

    <div class="col-md-10">
        

        <div class="col-md-12" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
             <div class="alert alert-info alert-dismissible">
              <div id="gallery">
                Dosya Listesi
                <ol >
                    @foreach($gallery->projedosyalari as $image)
                    <li class="">
                      <a href="/gallery/images/{{$image->filename}}"  download><span>{{$image->filename}}</span></a>
                    </li>
                  @endforeach
                </ol>
              </div>
            </div>
            <div class="alert alert-danger none" style="display: none;"><p></p></div>
            <div class="alert alert-success none" style="display: none;"><p></p></div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('projeler.upload') }}" class="dropzone" id="file">
                    {!! csrf_field() !!}
                    <input type="hidden" name="file_id" value="{{$gallery->id}}">
                  </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
</div>
</div>
</div>
@stop