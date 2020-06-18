@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="box-tools pull-right">
       <a class="btn btn-primary btn-xs" href="{{route('firmalar.create')}}">Firma Ekle</a>
     </div>
     <i class="fa fa-users">
      Firmalar
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
           <table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th>Firma Adi</th>
                <th>Yetkili Adi</th>
                <th>Yetkili Soyadi</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($firmalar as $department)
              <tr role="row" class="odd">
                <td>{{ $department->FirmaAdi }}</td>
                <td>{{ $department->YetkiliAdi }}</td>
                <td>{{ $department->YetkiliSoyadi }}</td>
                <td>{{ $department->email }}</td>
                <td>
                  <form class="row" method="POST" action="{{ route('firmalar.destroy', ['id' => $department->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a href="{{ route('firmalar.edit', ['id' => $department->id]) }}" class="btn btn-default btn-xs">
                      Güncelle
                    </a>
                    <button type="submit" class="btn btn-danger btn-xs btn-delete">
                      Sil
                    </button>
                  </form>
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