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
    <div class="col-md-12" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
      
      <h2 class="col-md-10 col-md-offset-4">Yeni Fatura Ekleme</h2>
      <div class="panel-body">                
        <form class="form-horizontal" role="form" method="POST" action="{{ route('faturalar.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Fatura No</label>

                <div class="col-md-10">
                    <input id="faturano" type="text" class="form-control" name="faturano" value="{{ old('faturano') }}" required autofocus>

                    @if ($errors->has('faturano'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturano') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('faturamusteri') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">F. Müşteri</label>

                <div class="col-md-10">
                     <select name="faturamusteri" class="form-control">
                    <option value="0">Müşteri Seçiniz</option>
                    @foreach ($firmalar as $firma)
                    <option value="{{ $firma->FirmaAdi }}">{{$firma->FirmaAdi}}</option>
                    @endforeach
                </select>

                    @if ($errors->has('faturamusteri'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturamusteri') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('faturadetay') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">F. Detay</label>

                <div class="col-md-10">

                    <textarea id="faturadetay"  class="form-control" name="faturadetay" value="{{ old('faturadetay') }}" > 
                        </textarea>


                    @if ($errors->has('faturadetay'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturadetay') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('faturatarih') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">F.Tarih</label>

                <div class="col-md-10">
                    <input id="" type="date" class="form-control" name="faturatarih" value="{{ old('faturatarih') }}" required autofocus>

                    @if ($errors->has('faturatarih'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturatarih') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('faturatotal') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">F.Toplam Tutarı(TL)</label>

                <div class="col-md-10">
                    <input type="number" min="0.00" max="10000.00" step="0.01" id="number"  class="form-control" name="faturatotal" value="{{ old('faturatotal') }}" required autofocus>

                    @if ($errors->has('faturatotal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturatotal') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('faturavergi') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">F.Vergi </label>

                <div class="col-md-10">
                    <input id="faturavergi" type="text" class="form-control" name="faturavergi" value="{{ old('faturavergi') }}" required autofocus>

                    @if ($errors->has('faturavergi'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturavergi') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('faturaadres') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">F.Adresi </label>

                <div class="col-md-10">
                    <input id="address" type="text" class="form-control" name="faturaadres" value="{{ old('faturaadres') }}" required autofocus>

                    @if ($errors->has('faturaadres'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturaadres') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('faturaodeme') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">F.Ödeme </label>

                <div class="col-md-10">
                    <select name="faturaodeme" class="form-control">
                    <option value="0">Ödeme Tipi Seçiniz</option>
                    <option value="Nakit">Nakit</option>
                    <option value="KrediKarti">Kredi Kartı</option>
                </select>

                    @if ($errors->has('faturaodeme'))
                    <span class="help-block">
                        <strong>{{ $errors->first('faturaodeme') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('proje_id') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Proje </label>

                <div class="col-md-10">
                    <select name="proje_id" class="form-control">
                    <option value="0">Proje Seçiniz</option>
                    @foreach ($projeler as $proje)
                    <option value="{{ $proje->id }}">{{$proje->ProjeAdi}}</option>
                    @endforeach
                </select>

                    @if ($errors->has('proje_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('proje_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('ulke') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Ülke</label>

                <div class="col-md-10">
                   <select name="ulke" class="form-control">
                    <option value="0">Ülke Seçiniz</option>
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
                <select name="il" class="form-control">
                    <option value="0">Şehir Seçiniz</option>
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
            <label for="name" class="col-md-2 control-label">İlce</label>

            <div class="col-md-10">
                <select name="ilce" class="form-control">
                    <option value="0">İlce Seçiniz</option>
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
            <label for="name" class="col-md-2 control-label">Telefon</label>

            <div class="col-md-10">
                <input id="telefon" type="tel" class="form-control"  name="telefon" value="{{ old('telefon') }}" title='Phone Number (Format: +99(99)9999-9999)' required autofocus>

                @if ($errors->has('telefon'))
                <span class="help-block">
                    <strong>{{ $errors->first('telefon') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('webadresi') ? ' has-error' : '' }}">
            <label for="name" class="col-md-2 control-label">Web-Adresi</label>

            <div class="col-md-10">
                <input id="webadresi" type="text" class="form-control" name="webadresi" value="{{ old('webadresi') }}" required autofocus>

                @if ($errors->has('webadresi'))
                <span class="help-block">
                    <strong>{{ $errors->first('webadresi') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-4">
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



