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
    <div class="box-tools pull-right">
     <a class="btn btn-primary btn-xs" href="/gallery/list"><i class="fa  fa-mail-reply (alias)"></i></a>
   </div>
      </div>

      <div class="box-body" >
        <div class="row">
          <div class="col-md-12">
              <h1>{{$gallery->name}}</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div id="gallery-images" >
                <ul>
                  @foreach($gallery->images as $image)
                    <li >
                      <a href="{{url($image->file_path)}}"  data-lightbox="mygallery">
                        <img src="{{ url('gallery/images/thumbs/'.$image->file_name) }}">
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <form action="{{url('image/do-upload')}}" class="dropzone" id="addImages">
                {!! csrf_field() !!}
                <input type="hidden" name="gallery_id" value="{{$gallery->id}}">
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop