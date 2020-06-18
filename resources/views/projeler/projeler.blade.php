@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row" ng-app="projeRecords" ng-controller="projeListController">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      <div class="box-tools pull-right">
       @if(Auth::user()->rolename!='Müşteri')
       <button class="btn btn-primary btn-xs" ng-click="ekle()">Yeni Proje Ekle</button>
       @endif
     </div>

     <i class="fa fa-plus-square">
      {{ $page_title or "Page Title" }}
    </i>

  </div>
  <!-- /.box-header -->
  <div class="panel-body" id="frmUsersList">
    <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Firma Adı</th>
          <th>Proje Adı</th>
          <th>Proje İcerik</th>
          <th>Proje Kisiler</th>
          <th>Proje Süresi</th>
          <th>Dosya Adi</th>
          <th>Proje Durumu</th>
          <th>Proje Başlangıç Tarihi</th>
          <th>Proje Bitiş Tarihi</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
       <tr ng-repeat="proje in projes">
        <td ng-bind="proje.id"></td>
        <td ng-bind="proje.FirmaAdi"></td>
        <td ng-bind="proje.ProjeAdi"></td>
        <td ng-bind="proje.Icerik"></td>
        <td ng-bind="proje.Kisiler"></td>
        <td ng-bind="proje.Sure"></td>
        <td ng-bind="proje.DosyaAdi"></td>
        <td >
          <div class="progress progress-xs">
            <div class="progress-bar progress-bar-aqua" style="width: @{{proje.Durumu}}%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <span class="badge bg-aqua" >@{{proje.Durumu}}% </span>
        </td>
        <td ng-bind="proje.BaslangicTarihi"></td>
        <td ng-bind="proje.BitisTarihi"></td>
        <td>
          @if(Auth::user()->rolename!='Müşteri')
          <button class="btn btn-warning" ng-click="duzenle(proje.id)">Düzenle</button>
          <button class="btn btn-danger " ng-click="sil(proje.id)">Sil</button>
          @endif
          </td>
        </tr>
      </tbody>
    </table>
    <div align="center">
     <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true">
     </dir-pagination-controls>
   </div>
 </div>

 <!--Proje Detay Ekle ve Güncelle-->
 <div class="panel-body" id="frmUsers" style="display: none;">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title" ng-bind="page_title" ></h3>
      </div>
      <!-- /.box-header -->
      <div class="alert alert-danger none" style="display: none;"><p></p></div>
      <div class="alert alert-success none" style="display: none;"><p></p></div>
      <div class="alert alert-warning " style="display: none;" ng-if="errors.length > 0">
        <ul>
          <li ng-repeat="error in errors track by $index">@{{ error }}</li>
        </ul>
      </div>
      <div class="alert alert-warning " ng-if="errors.length > 0">
        <ul>
          <li ng-repeat="error in errors track by $index">@{{ error }}</li>
        </ul>
      </div>
      <!-- form start -->
      <form name="frmProje" class="form-horizontal" novalidate="">


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Firma Adi</label>
          <div class="col-sm-9">
            <select name="FirmaAdi" class="form-control select2" data-placeholder="Select a State"
                        style="width: 100%;" ng-model="proje.FirmaAdi">
                    <option ng-repeat="firma in firmalar" value="@{{firma.FirmaAdi}}" ng-bind="firma.FirmaAdi"></option>
                  </select>
            <span class="help-inline" 
            ng-show="frmProje.FirmaAdi.$invalid && frmProje.FirmaAdi.$touched">Firma Adi gereklidir.</span>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Proje Adi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="ProjeAdi" name="ProjeAdi" placeholder="Proje Adi" value="@{{ProjeAdi}}" 
            ng-model="proje.ProjeAdi" ng-required="true">
            <span class="help-inline" 
            ng-show="frmProje.ProjeAdi.$invalid && frmProje.ProjeAdi.$touched">Proje Adi gereklidir.</span>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Proje Icerik</label>
          <div class="col-sm-9">
           <textarea  class="textarea" id="Icerik" name="Icerik" placeholder="Proje Icerik" value="@{{Icerik}}" ng-model="proje.Icerik"
           style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" ng-required="true"></textarea>
           <span class="help-inline" 
           ng-show="frmProje.Icerik.$invalid && frmProje.Icerik.$touched">Proje Icerik gereklidir.</span>
         </div>
       </div>

       <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Proje Kisiler</label>
        <div class="col-sm-9">
           <select name="Kisiler" class="form-control select2" data-placeholder="Select a State"
                        style="width: 100%;" ng-model="proje.Kisiler">
                    <option ng-repeat="kullanici in kullanicilar" value="@{{kullanici.id}}" ng-bind="kullanici.name"></option>
                  </select>
          <span class="help-inline" 
          ng-show="frmProje.projekisiler.$invalid && frmProje.projekisiler.$touched">Proje Kisiler gereklidir.</span>
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Proje Süresi</label>
        <div class="col-sm-9">
          <input type="text"  min="0" max="5" class="form-control" id="Sure" name="Sure" placeholder="Proje Süresi" value="@{{Sure}}" ng-model="proje.Sure" ng-required="true">
          <span class="help-inline" 
          ng-show="frmProje.Sure.$invalid && frmProje.Sure.$touched">Proje Süresi gereklidir.</span>
        </div>
      </div>



      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Proje Durumu</label>
        <div class="col-sm-9">
          <input type="text" min="0" max="100" class="form-control" id="Durumu" name="Durumu" placeholder="Proje Durumu" value="@{{Durumu}}" ng-model="proje.Durumu" ng-required="true" />
          <span class="help-inline" 
          ng-show="frmProje.Durumu.$invalid && frmProje.Durumu.$touched">Proje Durumu 0-100 arasında olmalıdır</span>
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Proje Başlangıç Tarihi</label>
        <div class="col-sm-9">
          <input type="text" id="baslangictarihi" name="BaslangicTarihi" ng-model="proje.BaslangicTarihi" placeholder="Başlangıç Tarihi" class="form-control" required >
          <span class="help-inline" 
          ng-show="frmProje.BaslangicTarihi.$invalid && frmProje.BaslangicTarihi.$touched">Proje Başlangç Tarihi olmalıdır</span>
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Proje Bitiş Tarihi</label>
        <div class="col-sm-9 ">
          <input type="text" id="bitistarihi" name="BitisTarihi" ng-model="proje.BitisTarihi" placeholder="Bitiş Tarihi" class="form-control" required >
          <span class="help-inline" 
          ng-show="frmProje.BitisTarihi.$invalid && frmProje.BitisTarihi.$touched">Proje Bitiş Tarihi olmalıdır</span>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
         <button type="button" class="btn btn-primary" id="btn-save" ng-click="addUser(modalstate, id) " >Kaydet</button>

         <a class="btn btn-link" ng-click="iptal()">
          İptal Et
        </a>
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