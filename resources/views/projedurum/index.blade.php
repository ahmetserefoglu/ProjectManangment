@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <i class="fa fa-image (alias)">
      Dosya Yükleme
    </i>
    <div class="box-tools pull-right">
     <a class="btn btn-primary btn-xs" href="/projedurum/create">Proje Durum</a>
   </div>
 </div>

 <div class="box-body">
  <div class="row">
    <div class="col-md-12">

      @if($fileuploads->count()>0)
      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
           <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th>Id</th>
                <th>Proje Adi</th>
                <th>Proje Aciklama</th>
                <th>Proje Durumu</th>
                <th>Dosya Sayisi</th>
                <th>Güncellenme Tarihi</th>
                <th>İncele</th>
                <th>Sil</th>
              </tr>
            </thead>
            <tbody>
              @foreach($fileuploads as $gallery)
              <tr>
                <td>{{$gallery->id}} </td>
                <td>{{$gallery->title}} </td>
                <td>{{$gallery->overview}} </td>
                <td>{{$gallery->durumu}} </td>
                <td><span>{{$gallery->uploads()->count()}}</span></td>
                <td>{{$gallery->updated_at}} </td>
                <td><a href="/fileupload/view/{{$gallery->id}}"><i class="fa fa-folder-open"></i></a></td>
                <td><a href="/fileupload/delete/{{$gallery->id}}"><i class="fa fa-trash"></i></a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>

    @endif
  </div>

</div>
</div>
</div>
</div>
</div>
@stop