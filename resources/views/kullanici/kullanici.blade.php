@extends('adminlte::page')

@section('title', 'AdminLTE')



@section('content')

<div class="row" ng-app="kullaniciRecords" ng-controller="kullaniciController">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
       <!--<div class="box-tools pull-right">
        <div class="input-group input-group-sm" style="width: 150px;">
          <select name="example1_length" aria-controls="example1" ng-model="satirSayisi" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>
        </div>
      </div>-->
      <div class="box-tools pull-right">
       <button class="btn btn-primary btn-xs" ng-click="ekle()">Kullanıcı Ekle</button>
     </div>

     <i class="fa fa-users">
      {{ $page_alt_title or "Page Title" }}
    </i>

  </div>

  <div class="alert alert-danger none" style="display: none;"><p></p></div>
  <div class="alert alert-success none" style="display: none;"><p></p></div>
<div class="panel-body" id="frmUsersList">
    <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Adi Soyadi</th>
          <th>Telefon No</th>
          <th>Email</th>
          <th>Düzenle</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="user in users">
          <td ng-bind="user.name"></td>
          <td ng-bind="user.rolename"></td>
          <td ng-bind="user.email"></td>
          <td >
            <button class="btn btn-default btn-xs btn-detail" ng-click="duzenle(user.id)">{{ trans('adminlte.Edit') }}</button>
               <button class="btn btn-danger btn-xs btn-delete" ng-click="sil(user.id)">{{ trans('adminlte.Delete') }}</button>
               
          </td>
        </tr>
      </tbody>
    </table>



  </div>
 <div class="panel-body" id="frmUsers" style="display: none;">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title" ng-bind="page_title" ></h3>
      </div>
      <!-- /.box-header -->
      <div class="alert alert-warning " ng-if="errors.length > 0">
        <ul>
          <li ng-repeat="error in errors track by $index">@{{ error }}</li>
        </ul>
      </div>
      <!-- form start -->
      <form class="form-horizontal" name="frmUsers">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="name" class="col-md-4 control-label">Kullanıcı Adı:</label>
          <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="@{{name}}" 
            ng-model="user.name" ng-required="true">
            <span class="help-inline" 
            ng-show="frmUsers.name.$invalid && frmUsers.name.$touched && frmUsers.name.$error">Kullanıcı Adı Gereklidir.</span>
          </div>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">Kullanıcı Email:</label>
          <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="@{{email}}" 
            ng-model="user.email" ng-required="true">
            <span class="help-inline" 
            ng-show="frmUsers.email.$invalid && frmUsers.email.$touched && frmUsers.email.$error">Kullanıcı Email Gereklidir.</span>
          </div>
        </div>


        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Şifre:</label>
          <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" ng-model="user.password"  value="@{{password}}">
            <span class="help-inline" 
            ng-show="frmUsers.password.$error &&  frmUsers.password.$invalid">Şifre Gereklidir.</span>
          </div>
        </div>


        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
          <label for="roles" class="col-md-4 control-label">Kullanıcı Rolü:</label>
          <div class="col-md-6">
           <select name="rolename" ng-model="user.rolename">
            <option ng-repeat="x in roles" value="@{{x.rolename}}">@{{x.rolename}}</option>
          </select>

          <span class="help-inline" 
          ng-show="frmUsers.rolename.$invalid && frmUsers.rolename.$touched && frmUsers.rolename.$error">Kullanıcı Rol gereklidir.</span>
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
<!-- /.box -->
  
</div>
</div>

</div>
</div>
</div>
@stop