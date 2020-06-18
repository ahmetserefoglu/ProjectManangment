@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
       <div class="panel panel-default">
      <div class="panel-heading">
         <div class="box-tools pull-right">
       <a class="btn btn-primary btn-xs" href="{{route('gorusmeler.create')}}">Gorusme Ekle</a>
     </div>
 <i class="fa fa-bullhorn">
      Gorusmeler
    </i>
      </div>

      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            
            @if($gorusmeler->count()>0)
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <div class="col-sm-12">
             <table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th>Gorusen Kisi</th>
                  <th>GorusmeKonusu</th>
                  <th>Tarih</th>
                  <th>Gorusme Tipi</th>
                  <th>Gorusme Yontemi</th>
                  <th>Gorusme Detayi</th>
                  <th>Gorusulen Firma</th>
                  <th>Onem Derecesi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gorusmeler as $gorusme)
                <tr role="row" class="odd">
                  <td>{{ $gorusme->GorusenKisi }}</td>
                  <td>{{ $gorusme->GorusmeKonusu }}</td>
                  <td>{{ $gorusme->Tarih }}</td>
                  <td>{{ $gorusme->department_id }}</td>
                  <td>{{ $gorusme->Yontemi }}</td>
                  <td>{{ $gorusme->GorusmeDetayi }}</td>
                  <td>{{ $gorusme->OnemDerecesi }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('gorusmeler.destroy', ['id' => $gorusme->id]) }}" onsubmit = "return confirm('Silmek İstiyor musunuz?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <a href="{{ route('gorusmeler.edit', ['id' => $gorusme->id]) }}" class="btn btn-default btn-xs">
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
            @endif
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
@stop