@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="row" ng-app="rolesRecords" ng-controller="rolesListController">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="box-tools pull-right">
          <div class="input-group input-group-sm" style="width: 150px;">
            <a class="btn btn-primary btn-xs" ng-click="ekle()">Rol Ekle</a>
          </div>
        </div>
        <i class="fa fa-users">
          {{ $page_alt_title or "Page Title" }}
        </i>
      </div>

      <div class="alert alert-danger none" style="display: none;"><p></p></div>
      <div class="alert alert-success none" style="display: none;"><p></p></div>
      
       <div class="panel-body" id="frmRoleList">
        <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Adi</th>
              <th>Açıklaması</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="role in roles">
              <td ng-bind="role.roleid"></td>
              <td ng-bind="role.rolename"></td>
              <td ng-bind="role.role_description"></td>
              <td >
                <button class="btn btn-default btn-xs btn-detail" ng-click="duzenle(role.roleid)">{{ trans('adminlte.Edit') }}</button>
                <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(role.roleid)">{{ trans('adminlte.Delete') }}</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="panel-body" id="frmRole"  style="display: none;">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" ng-bind="page_title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="alert alert-warning " ng-if="errors.length > 0">
              <ul>
                <li ng-repeat="error in errors track by $index">@{{ error }}</li>
              </ul>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <form class="form-horizontal" name="frmRoles" role="form" >
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('rolename') ? ' has-error' : '' }}">
                <label for="rolename" class="col-md-4 control-label">Rol Adı:</label>
                <div class="col-md-6">
                  <input id="rolename" type="text" class="form-control" name="rolename" value="@{{rolename}}" 
                  ng-model="role.rolename" ng-required="true">
                  <span class="help-inline" 
                  ng-show="frmRoles.rolename.$invalid && frmRoles.rolename.$touched && frmRoles.rolename.$error">Rol Adı Gereklidir.</span>
                </div>
              </div>
              <div class="form-group{{ $errors->has('role_display_name') ? ' has-error' : '' }}">
                <label for="role_display_name" class="col-md-4 control-label">Görüntülenecek Adı:</label>
                <div class="col-md-6">
                  <input id="role_display_name" type="text" class="form-control" name="role_display_name" value="@{{role_display_name}}" 
                  ng-model="role.role_display_name" ng-required="true">
                  <span class="help-inline" 
                  ng-show="frmRoles.role_display_name.$invalid && frmRoles.role_display_name.$touched && frmRoles.role_display_name.$error">Görüntülenecek Adi Gereklidir.</span>
                </div>
              </div>


              <div class="form-group{{ $errors->has('role_description') ? ' has-error' : '' }}">
                <label for="role_description" class="col-md-4 control-label">Açıklama:</label>
                <div class="col-md-6">
                  <input id="role_description" type="text" class="form-control" name="role_description" ng-model="role.role_description"  value="@{{role_description}}">
                  <span class="help-inline" 
                  ng-show="frmRoles.role_description.$error &&  frmRoles.role_description.$invalid">Açıklama Gereklidir.</span>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)">Kayıt Et</button>
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
</div>
@stop