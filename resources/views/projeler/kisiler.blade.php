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
     <a class="btn btn-primary btn-xs" href="/projeler/kisiler/{{$id}}/create">P.Ağırlık Ekle</a>
     <a class="btn btn-primary btn-xs" href="/projeler"><i class="fa  fa-mail-reply (alias)"></i></a>
   </div>
 </div>

 <div class="box-body">
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
  <div class="row">
    <div class="col-md-12">

      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
           <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th>P.Kisi</th>
                <th>P.Durumu</th>
                <th>İncele</th>
              </tr>
            </thead>
            <tbody>
              @foreach($projedetay as $gallery)
              <tr>
                <td>{{$gallery->isim}}</td>
                <td><div class="progress progress-xs">
            <div class="progress-bar progress-bar-aqua" style="width: {{$gallery->durum}}%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <span class="badge bg-aqua" >{{$gallery->durum}}% </span></td>
          <td>
          @if(Auth::user()->rolename!='Müşteri')
          <form class="row" method="POST" action="{{ route('projeler.destroy', ['id' => $gallery->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="/projeler/kisiler/{{$gallery->id}}/update" class="btn btn-default btn-xs">
                        Güncelle
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
</div>
</div>
</div>
</div>
@stop