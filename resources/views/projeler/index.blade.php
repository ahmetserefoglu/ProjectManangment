@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      <div class="box-tools pull-right">
        <!--<a href="#" class="btn btn-default btn-sm" onclick="HTMLtoPDF()"><i class="fa fa-print"></i></a>-->
       @if(Auth::user()->rolename!='Müşteri')
       <a class="btn btn-primary btn-xs"  href="{{route('projeler.create')}}">Yeni Proje Ekle</a>
       @endif
     </div>

     <i class="fa fa-plus-square">
      {{ $page_title or "Page Title" }}
    </i>

  </div>
  <!-- /.box-header -->
  <div class="panel-body" id="HTMLtoPDF">
    <table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
      <thead>
        <tr>
          <th>ID</th>
          <th>Firma Adı</th>
          <th>Proje Adı</th>
          <th>Proje İcerik</th>
          <th>Proje Süresi</th>
          <th>Proje Durumu</th>
          <th>P.Başlangıç Tarihi</th>
          <th>P.Bitiş Tarihi</th>
          <th>İncele</th>
        </tr>
      </thead>
      <tbody>
         @foreach($projeler as $proje)
       <tr >
        <td >{{$proje->id}}</td>
        <td >{{$proje->FirmaAdi}}</td>
        <td >{{$proje->ProjeAdi}}</td>
        <td >{{$proje->Icerik}}</td>
        <td >{{$proje->Sure}}</td>
        <td >
          @if($proje->toplam==100 || $proje->toplam>100)

            <div class="progress progress-xs">
            <div class="progress-bar progress-bar-red" style="width: 100%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <span class="badge bg-red" >100% </span>

          @else
          <div class="progress progress-xs">
            <div class="progress-bar progress-bar-aqua" style="width: {{$proje->toplam}}%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <span class="badge bg-aqua" >{{$proje->toplam}}% </span>
          @endif
        </td>
        <td >{{$proje->BaslangicTarihi}}</td>
        <td >{{$proje->BitisTarihi}}</td>
        <td>
          @if(Auth::user()->rolename!='Müşteri')
          <form class="row" method="POST" action="{{ route('projeler.destroy', ['id' => $proje->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ route('projeler.edit', ['id' => $proje->id]) }}" class="btn btn-default btn-xs">
                        Güncelle
                      </a>
                      <a href="/projeler/detay/{{$proje->id}}" class="btn btn-default btn-xs">
                        Detay
                      </a>
                      <a href="/projeler/kisiler/{{$proje->id}}" class="btn btn-default btn-xs">
                        Kisiler
                      </a>
                      <button type="submit" class="btn btn-danger btn-xs btn-delete">
                        Sil
                      </button>
                    </form>
          @endif
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
@stop