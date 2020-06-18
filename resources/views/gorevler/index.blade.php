@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="box-tools pull-right">
       <a class="btn btn-primary btn-xs" href="{{route('gorevler.create')}}">Gorev Ekle</a>
     </div>
     <i class="fa fa-users">
      Gorevler
    </i>
  </div>

  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <div class="col-sm-12">
             <table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th>Gorev Adi</th>
                  <th>Gorev Baslama Tarihi</th>
                  <th>Gorev Suresi</th>
                  <th>Gorev İlerlemesi</th>
                  <th>Gorev</th>
                  <th>Sort Order </th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gorevler as $gorev)
                <tr role="row" class="odd">
                  <td>{{ $gorev->text }}</td>
                  <td>{{ $gorev->start_date }}</td>
                  <td>{{ $gorev->duration }}</td>
                  <td>{{ $gorev->progress }}</td>
                  <td>{{ $gorev->parent }}</td>
                  <td>{{ $gorev->sortorder }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('gorevler.destroy', ['id' => $gorev->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ route('gorevler.edit', ['id' => $gorev->id]) }}" class="btn btn-default btn-xs">
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