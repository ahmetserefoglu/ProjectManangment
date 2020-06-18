@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <i class="fa fa-plus-square">
      {{$page_title}}
    </i>
     <div class="box-tools pull-right">
     <a class="btn btn-primary btn-xs" href="/projeler/detay/{{$id}}/create">Durum Ekle</a>
     <a class="btn btn-primary btn-xs" href="/projeler"><i class="fa  fa-mail-reply (alias)"></i></a>
   </div>
 </div>

 <div class="box-body">
  <div class="row">
    <div class="col-md-12">

      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
           <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th>Id</th>
                <th>Proje Detay Baslık</th>
                <th>Proje Aciklama</th>
                <th>Kisi</th>
                <th>Proje Durumu</th>
                <th>Dosya Sayisi</th>
                <th>Güncellenme Tarihi</th>
                <th>İncele</th>
              </tr>
            </thead>
            <tbody>
              @foreach($projedetay as $gallery)
              <tr>
                <td>{{$gallery->id}} </td>
                <td>{{$gallery->proje_detay_baslik}} </td>
                <td>{{$gallery->proje_detay}} </td>
                <td>{{$gallery->user_id}} </td>
                <td>
                <div class="progress progress-xs">
            <div class="progress-bar progress-bar-aqua" style="width: {{$gallery->durumu}}%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <span class="badge bg-aqua" >{{$gallery->durumu}}% </span></td>
                <td><span>{{$gallery->projedosyalari()->count()}}</span></td>
                <td>{{$gallery->updated_at}} </td>
                <td><a class="btn btn-default btn-xs" href="/projeler/dosya/{{$gallery->id}}"><i class="fa fa-folder-open"></i></a>
               <a class="btn btn-default btn-xs" href="/projeler/detay/{{$id}}/update"><i class="fa fa-edit (alias)"></i></a>
               <!--<a class="btn btn-default btn-xs" href="/projeler/detay/{{$gallery->proje_id}}/create/"><i class="fa fa-fw fa-plus-square "></i></a>-->

              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
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