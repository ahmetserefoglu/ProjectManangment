@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

<div class="row" ng-app="mesajlarRecords" ng-controller="mesajlarController">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-envelope">
        </i>
        {{ $page_title or "Page Title" }}
      </div>

      <div class="panel-body">
        <div class="row" id="sendbox"  >
          <div class="col-md-3">
            <a ng-click="mesajYaz()" class="btn btn-primary btn-block margin-bottom">Mesaj Gönder</a>

            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Dosyalar</h3>

                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li ><a href="" ng-click="inbox()"><i class="fa fa-inbox"></i> Gelen Kutusu
                    <span class="label label-primary pull-right" ng-bind="gelenmesajlar.length"></span></a></li>
                    <li class="active"><a href="" ng-click="sendbox()"><i class="fa fa-envelope-o" ></i><span class="label label-primary pull-right" ng-bind="gidenmesajlar.length"></span> Gönderilen Kutusu</a></li>
                  </ul>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9" >
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Gönderilen Kutusu</h3>

                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      
                    </div>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                    </button>
                    <!-- /.btn-group -->
                    <a ng-click="reload()" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                    <div class="pull-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div>
                      <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <td></td>
                          <td>Mesaj Durumu</td>
                          <td>Gönderen</td>
                          <td>Mesaj</td>
                          <td>Dosya</td>
                          <td>Zaman</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="mesaj in gidenmesajlar|filter:search">
                          <td><input type="checkbox"></td>
                          <td><a class="" ng-if="mesaj.onemdurumu=='1'"><i class="fa fa-star text-yellow"></i></i> </a>
                            <a class="" ng-if="mesaj.onemdurumu=='0'"><i class="fa fa-circle text-danger"></i> </a></td>
                            <td class="mailbox-name"><a href="" ng-click="mesajOku(mesaj.id)"> <b ng-bind="mesaj.gonderen_kisi"></b></a></td>
                            <td class="mailbox-subject"><b ng-bind="mesaj.mesajdetayi"></b> 
                            </td>
                            <td class="mailbox-attachment"></td>
                            <td class="mailbox-date" ng-bind="mesaj.created_at"></td>
                          </tr>
                        </tbody>
                      </table>
                      <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                  </div>
                </div>
                <!-- /. box -->
              </div>
              <!-- /.col -->
            </div>
@stop                