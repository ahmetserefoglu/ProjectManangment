@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
    <!--<div class="box-tools pull-right">
       <button  type="button" class="btn btn-default btn-xs" id="mail" data-toggle="modal" data-target="#modal-default">
        Seçileni SMS Gönder
       </button>
   </div>-->
    <div class="box-tools pull-right">
      <a class="btn btn-default btn-xs" href="{{route('faturalar.create')}}">Fatura Ekle</a>
    </div>
    <div class="box-tools pull-right">
       <button  type="button" class="btn btn-default btn-xs" id="mail" data-toggle="modal" data-target="#modal-default">
        Seçileni Mail Gönder
       </button>
   </div>
   <i class="fa fa-users">
    {{ $page_title }}
  </i>
</div>

<div class="box-body">
  <div class="row">
    <div class="col-md-12">
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
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <form role="form" method="POST" action="{{ route('faturalar.send' , ['id' => 1]) }}" >
           <table id="example" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                <th>Id</th>
                <th>F.No </th>
                <th>F.Müşteri</th>
                <th>F.Detay</th>
                <th>F.Tarih</th>
                <th>F.Total</th>
                <th>F.Vergi</th>
                <th>F.Odeme</th>
                <th>F.Adres</th>
                <th>F.Proje</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($faturalar as $fatura)
              <tr role="row" class="odd">
                <td><input type="checkbox" class="checkbox_check" name="select_all[]" value="{{ $fatura->id }}" id="example-select-all"></td>
                <td>{{ $fatura->id }}</td>
                <td>{{ $fatura->faturano }}</td>
                <td>{{ $fatura->faturamusteri }}</td>
                <td>{{ $fatura->faturadetay }}</td>
                <td>{{ $fatura->faturatarih }}</td>
                <td>{{ $fatura->faturatotal }}</td>
                <td>{{ $fatura->faturavergi }}</td>
                <td>{{ $fatura->faturaodeme }}</td>
                <td>{{ $fatura->faturaadres }}</td>

                <td>{{ $fatura->proje_id }}</td>
                <td>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <a  href="{{ route('faturalar.edit', ['id' => $fatura->proje_id]) }}" id="edit" class="btn btn-default btn-xs">
                    Güncelle
                  </a>
                  <a  href="{{ route('faturalar.show', ['id' => $fatura->proje_id]) }}" id="show" class="btn btn-default btn-xs">
                    Göster
                  </a>
                    <!--<button type="submit" class="btn btn-danger btn-xs btn-delete">
                      Sil
                    </button>-->



                  </td>
                </tr>
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      {!! csrf_field() !!}
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Mail</h4>
                        </div>
                        <div class="modal-body">
                          <input type="text" class="form-control" id="email" name="email" placeholder="Mail Adresi" >
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kapat</button>
                          <button type="submit" class="btn btn-primary">
                            Gönder
                          </button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  @endforeach
                </tbody>
              </table>
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

@section('js')
<script src="{{asset('js/checkboxDatatable.js')}}"></script>
@endsection

@stop


