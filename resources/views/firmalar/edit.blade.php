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
             <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Bilgi!</h4>
              **** ' lı Alanları Doldurmanız Gereklidir.
            </div>
        <h2 class="col-md-10 col-md-offset-4"> Firma Duzenle</h2>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('firmalar.update',['id' => $firmalar->id]) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Firma Adı</label>

                    <div class="col-md-10">
                        <input id="FirmaAdi" type="text" class="form-control" name="FirmaAdi" value="{{ $firmalar->FirmaAdi }}" required autofocus>

                        @if ($errors->has('FirmaAdi'))
                        <span class="help-block">
                            <strong>{{ $errors->first('FirmaAdi') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('YetkiliAdi') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Yetkili Adı</label>

                    <div class="col-md-10">
                        <input id="YetkiliAdi" type="text" class="form-control" name="YetkiliAdi" value="{{ $firmalar->YetkiliAdi }}" required autofocus>

                        @if ($errors->has('YetkiliAdi'))
                        <span class="help-block">
                            <strong>{{ $errors->first('YetkiliAdi') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('YetkiliSoyadi') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Yetkili Soyadı</label>

                    <div class="col-md-10">
                        <input id="YetkiliSoyadi" type="text" class="form-control" name="YetkiliSoyadi" value="{{ $firmalar->YetkiliSoyadi }}" required autofocus>

                        @if ($errors->has('YetkiliSoyadi'))
                        <span class="help-block">
                            <strong>{{ $errors->first('YetkiliSoyadi') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Email</label>

                    <div class="col-md-10">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $firmalar->email }}" required autofocus>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Şifre </label>

                    <div class="col-md-10">
                        <input id="password" type="password" class="form-control" name="password" value="{{ $firmalar->password }}" required autofocus>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('ulke') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Ulke</label>

                    <div class="col-md-10">
                     <select name="ulke" class="form-control">
                        <option value="{{ $firmalar->ulke }}">{{ $firmalar->ulke }}</option>
                        @foreach ($ulkeler as $ulke)
                        <option value="{{ $ulke->CountryName }}">{{$ulke->CountryName}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('ulke'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ulke') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('il') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">İl</label>

                <div class="col-md-10">
                    <select name="il" class="form-control" >
                        <option value="{{ $firmalar->il }}">{{ $firmalar->il }}</option>
                        @foreach ($sehirler as $il)
                        <option value="{{ $il->CityName }}">{{$il->CityName}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('il'))
                    <span class="help-block">
                        <strong>{{ $errors->first('il') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('ilce') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">ilce</label>

                <div class="col-md-10">
                    <select name="ilce" class="form-control">
                        <option value="{{ $firmalar->ilce }}">{{ $firmalar->ilce }}</option>
                        @foreach ($ilceler as $ilce)
                        <option value="{{ $ilce->DistrictName }}">{{$ilce->DistrictName}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('ilce'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ilce') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('telefon') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">telefon</label>

                <div class="col-md-10">
                    <input id="telefon" type="text" class="form-control" name="telefon" value="{{ $firmalar->telefon }}" required autofocus>

                    @if ($errors->has('telefon'))
                    <span class="help-block">
                        <strong>{{ $errors->first('telefon') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Adres</label>

                <div class="col-md-10">
                    <input id="address" type="text" class="form-control" name="address" value="{{ $firmalar->address }}" required autofocus>

                    @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('webadresi') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">webadresi</label>

                <div class="col-md-10">
                    <input id="webadresi" type="text" class="form-control" name="webadresi" value="{{ $firmalar->webadresi }}" required autofocus>

                    @if ($errors->has('webadresi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('webadresi') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Kaydet
                </button>
                <a href="/firmalar" class="btn btn-primary">Geri Al</a>
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



