@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <i class="fa fa-file-archive-o">

     </i>
     {{$page_title}}
   </div>

   <div class="panel-body" >
    <div class="col-md-8" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">

      <h3 class="col-md-8 col-md-offset-4"  >Proje Ekle</h3>

      <form class="form-horizontal" role="form" method="POST" action="{{ route('projeler.store') }}">
       {{ csrf_field() }}
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <div class="form-group{{ $errors->has('firma_id') ? ' has-error' : '' }}">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Firma Adi</label>
          <div class="col-sm-9">
            <select name="FirmaAdi" class="form-control" data-placeholder="Select a State"
            style="width: 100%;" >
            <option  value="0">Firma Seçiniz</option>
            @foreach($firmalar as $firma)
            <option  value="{{$firma->FirmaAdi}}">{{$firma->FirmaAdi}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Proje Adi</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="ProjeAdi" name="ProjeAdi" placeholder="Proje Adi" ng-required="true">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Proje Icerik</label>
        <div class="col-sm-9">
         <textarea  class="textarea" id="Icerik" name="Icerik" placeholder="Proje Icerik"  ng-model=""
         style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
       </div>
     </div>


     <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Proje Kisiler</label>
      <div class="col-sm-9">
        <select name="Kisiler[]" class="form-control select2" multiple="multiple" data-placeholder="Proje Kisiler"
        style="width: 100%;">
        <option  value="0">Kişi Seçiniz</option>
        @foreach($kisiler as $kisi)
        <option  value="{{$kisi->name}}">{{$kisi->name}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Proje Süresi</label>
    <div class="col-sm-9">
      <input type="text"  min="0" max="5" class="form-control" id="Sure" name="Sure" placeholder="Proje Süresi" >
    </div>
  </div>



  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Proje Durumu</label>
    <div class="col-sm-9">
      <select name="Durumu" class="form-control" data-placeholder="Proje Durumu"
      style="width: 100%;" >
      <option value="0">Durumu Seçiniz</option>
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="30">30</option>
      <option value="40">40</option>
      <option value="50">50</option>
      <option value="60">60</option>
      <option value="70">70</option>
      <option value="80">80</option>
      <option value="90">90</option>
      <option value="100">100</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label for="inputEmail3" class="col-sm-2 control-label">Proje Başlangıç Tarihi</label>
  <div class="col-sm-9">
    <input type="date" value="{{ old('BaslangicTarihi') }}" name="BaslangicTarihi" placeholder="Başlangıç Tarihi" class="form-control" required >
  </div>
</div>

<div class="form-group">
  <label for="inputEmail3" class="col-sm-2 control-label">Proje Bitiş Tarihi</label>
  <div class="col-sm-9 ">
    <input type="date" alue="{{ old('BitisTarihi') }}" name="BitisTarihi"  placeholder="Bitiş Tarihi" class="form-control" required >

  </div>
</div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      Kaydet
    </button>
    <a href="/projeler" class="btn btn-primary">Geri Al</a>
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