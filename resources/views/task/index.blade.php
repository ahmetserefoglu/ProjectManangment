@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="box-tools pull-right">
       <a class="btn btn-primary btn-xs" href="{{route('tasks.create')}}">Gorev Ekle</a>
     </div>
     <i class="fa fa-users">
      Gorevler
    </i>
  </div>

  <div class="box-body">
    <div class="col-md-12">

      <div class="panel-body">
        <table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
          <thead>
            <tr role="row">
              <th>No.</th>
              <th>Görev Adı</th>
              <th>Görev Açıklama</th>
              <th>Baslama Tarihi</th>
              <th>Bitiş Tarihi</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach( $tasks as $task)
            <tr >
              <td>
                {{$task->id}}
              </td>
              <td >{{$task->name}}</td>
              <td >{{$task->description}}</td>
              <td >{{$task->start_date}}</td>
              <td >{{$task->end_date}}</td>
              <td>
               <form class="row" method="POST" action="{{ route('tasks.destroy', ['id' => $task->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ route('tasks.edit', ['id' => $task->id]) }}" class="btn btn-default btn-xs">
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
    <div align="center">
     <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true">
     </dir-pagination-controls>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>
@stop