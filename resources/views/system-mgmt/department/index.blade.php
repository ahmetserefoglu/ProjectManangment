 @extends('adminlte::page')

 @section('title', 'AdminLTE')


 @section('content')
 <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="box-tools pull-right">
       <a class="btn btn-primary btn-xs" href="{{route('yontemler.create')}}">Yöntem Ekle</a>
     </div>
 <i class="fa fa-list">
      {{$page_title}}
    </i>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">

          <div class="col-sm-6"></div>
          <div class="col-sm-6"></div>
        </div>
        <div class="col-md-12">
        <form method="POST" action="{{ url(config('adminlte.departmentsearch', 'departmentsearch')) }}">

        </form>
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <div class="col-sm-12">
             <table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th>Yöntem Adi</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($departments as $department)
                <tr role="row" class="odd">
                  <td>{{ $department->name }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('yontemler.destroy', ['id' => $department->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ route('yontemler.edit', ['id' => $department->id]) }}" class="btn btn-default btn-xs btn-detail">
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
@stop