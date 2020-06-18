 @extends('adminlte::page')

 @section('title', 'AdminLTE')


 @section('content')
 <div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
      <div class="panel-heading">
         <i class="fa fa-image (alias)">
          {{ $page_title or "Page Title" }}
      </i>
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <div class="col-md-8" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
        <h2 class="col-md-10 col-md-offset-4">Yeni Gorusme Ekleme</h2>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('gorusmeler.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group{{ $errors->has('firma_id') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Firma</label>

                    <div class="col-md-10">
                        <select name="firma_id" class="form-control">
                            <option  value="0">Firma Seçiniz</option>
                            @foreach ($firmalar as $firma)
                            <option value="{{ $firma->id }}">{{$firma->FirmaAdi}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('firma_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firma_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('GorusulenKisi') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Gorusen Kisi</label>

                    <div class="col-md-10" class="form-control">

                        <select name="GorusenKisi" class="form-control">
                            <option  value="0">Görüşen Kişi Seçiniz</option>
                            @foreach ($kullanicilar as $kisi)
                            <option value="{{ $kisi->name }}">{{$kisi->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('GorusulenKisi'))
                        <span class="help-block">
                            <strong>{{ $errors->first('GorusulenKisi') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('GorusmeKonusu') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Gorusme Konusu</label>

                    <div class="col-md-10">
                        <input id="GorusmeKonusu" type="text" class="form-control" name="GorusmeKonusu" value="{{ old('GorusmeKonusu') }}" required autofocus>

                        @if ($errors->has('GorusmeKonusu'))
                        <span class="help-block">
                            <strong>{{ $errors->first('GorusmeKonusu') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('GorusmeDetayi') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Gorusme Detayı</label>

                    <div class="col-md-10">
                        <textarea id="GorusmeDetayi"  class="form-control" name="GorusmeDetayi" value="{{ old('GorusmeDetayi') }}" > 
                        </textarea>

                        @if ($errors->has('GorusmeDetayi'))
                        <span class="help-block">
                            <strong>{{ $errors->first('GorusmeDetayi') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('Tarih') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Tarih</label>

                    <div class="col-md-10">
                        <input id="" type="date" class="form-control" name="Tarih" value="{{ old('Tarih') }}" required autofocus>

                        @if ($errors->has('Tarih'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Tarih') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Tipi</label>

                    <div class="col-md-10">
                        <select name="department_id" class="form-control">
                            @foreach ($departmentlar as $departman)
                            <option value="{{ $departman->id }}">{{$departman->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('department_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('department_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('OnemDerecesi') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">OnemDerecesi </label>

                    <div class="col-md-10">
                        <select name="OnemDerecesi" class="form-control" data-placeholder="Select a State"
                        style="width: 100%;" >
                        <option value="0">Seciniz</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>

                    @if ($errors->has('OnemDerecesi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('OnemDerecesi') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Kaydet
                    </button>
                    <a href="/gorusmeler" class="btn btn-primary">Geri Al</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
@stop



