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
        <div class="row" id="mesajlar" >
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
                  <li class="active"><a href="" ng-click="inbox()"><i class="fa fa-inbox"></i> Gelen Kutusu
                    <span class="label label-primary pull-right" ng-bind="gelenmesajlar.length"></span></a></li>
                    <li><a href="" ng-click="sendbox()"><i class="fa fa-envelope-o"></i> Gönderilen Kutusu</a></li>
                  </ul>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9" id="">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Gelen Kutusu</h3>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="table-responsive mailbox-messages">
                    <table width="100%" datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <td>Mesaj Durumu</td>
                          <td>Gönderen</td>
                          <td>Mesaj</td>
                          <td>Dosya</td>
                          <td>Zaman</td>
                           <td></td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="mesaj in gelenmesajlar">
                          <td><a class="" ng-if="mesaj.onaydurumu=='1'"><i class="fa fa-star text-yellow"></i></i> </a>
                            <a class="" ng-if="mesaj.onaydurumu=='0'"><i class="fa fa-circle text-danger"></i> </a></td>
                            <td class="mailbox-name"><a href="" ng-click="mesajOku(mesaj.id)"> <b ng-bind="mesaj.gonderen_kisi"></b></a></td>
                            <td class="mailbox-subject"><b ng-bind="mesaj.mesajdetayi"></b> 
                            </td>
                            <td class="mailbox-attachment"></td>
                            <td class="mailbox-date" ng-bind="mesaj.created_at"></td>
                            <td><button class="btn btn-danger btn-xs" ng-click="sil(mesaj.id)">Sil</button></td>
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
            <div class="row" id="sendbox" style="display: none;" >
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

                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <div class="table-responsive mailbox-messages">
                        <table width="100%" datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <td>Mesaj Durumu</td>
                              <td>Gönderilen</td>
                              <td>Mesaj</td>
                              <td>Dosya</td>
                              <td>Zaman</td>
                              <td></td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr ng-repeat="mesaj in gidenmesajlar">
                              <td><a class="" ng-if="mesaj.onaydurumu=='1'"><i class="fa fa-star text-yellow"></i> </a>
                                <a class="" ng-if="mesaj.onaydurumu=='0'"><i class="fa fa-circle text-danger"></i> </a></td>
                                <td class="mailbox-name"><a href="" ng-click="mesajOku(mesaj.id)"> <b ng-bind="mesaj.gonderen_kisi"></b></a></td>
                                <td class="mailbox-subject"><b ng-bind="mesaj.mesajdetayi"></b> 
                                </td>
                                <td class="mailbox-attachment"></td>
                                <td class="mailbox-date" ng-bind="mesaj.created_at"></td>
                                <td><button class="btn btn-danger btn-xs" ng-click="sil(mesaj.id)">Sil</button></td>
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

                <div class="row" id="mesajyaz" style="display: none;">
                  <div class="col-md-3">
                    <a ng-click="mesajGeriDon()" class="btn btn-primary btn-block margin-bottom">Gelen Kutusuna Dön</a>

                    <div class="box box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                          <li><a href="" ng-click="inbox()"><i class="fa fa-inbox"></i> Gelen Kutusu
                            <span class="label label-primary pull-right"></span></a></li>
                            <li><a href="" ng-click="sendbox()"><i class="fa fa-envelope-o"></i> Gönderilen Kutusu</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <form name="mesajYazGonder">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title">Yeni Mesaj</h3>
                          </div>
                          <div class="box-body">
                            <div class="form-group">
                            <select name="kullanici_adi" class="form-control select2" ng-model="mesajs.kullanici_adi" placeholder="Kullanici"
                            style="width: 100%;" >
                             <option ng-repeat="kullanici in kullanicilar" value="@{{kullanici.email}}" ng-bind="kullanici.email"></option>
                            </select>
                            </div>
                            <div class="form-group">
                              <input type="text" name="onemdurumu" class="form-control" placeholder="Subject:" ng-model="mesajs.onemdurumu" >
                            </div>
                            <div class="form-group">
                              <textarea type="text"  name="mesajdetayi" ng-model="mesajs.mesajdetayi" class="form-control" style="height: 300px">

                              </textarea>
                            </div>
                            <div class="form-group">
                              <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Dosya Ekle
                                <form action="{{ route('proje.upload') }}" class="dropzone" id="file">
                                      {!! csrf_field() !!}
                                      <input type="file" name="attachment">
                                    </form>
                              </div>
                              <p class="help-block"></p>
                            </div>
                          </form>
                        </div>
                        <div class="box-footer">
                          <div class="pull-right">
                            <a   ng-click="save()" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Gönder</a>
                          </div>
                          <button ng-click="mesajGeriDon()" type="reset" class="btn btn-default"><i class="fa fa-times"></i> Vazgeç</button>
                        </div>
                        <!-- /.box-footer -->
                      </div>
                      <!-- /. box -->
                    </div>
                    <!-- /.col -->
                  </div>

                  <div class="row" id="cevapla" style="display: none;">
                  <div class="col-md-3">
                    <a ng-click="mesajGeriDon()" class="btn btn-primary btn-block margin-bottom">Gelen Kutusuna Dön</a>

                    <div class="box box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                          <li><a href="" ng-click="inbox()"><i class="fa fa-inbox"></i> Gelen Kutusu
                            <span class="label label-primary pull-right"></span></a></li>
                            <li><a href="" ng-click="sendbox()"><i class="fa fa-envelope-o"></i> Gönderilen Kutusu</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <form name="mesajCevaplaGonder">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title">Cevapla</h3>
                          </div>
                          <div class="box-body">
                            <div class="form-group">
                              <select name="gonderen_kisi"  class="form-control select2" ng-model="mesajs.gonderen_kisi" placeholder="Kullanici"
                            style="width: 100%;" >
                             <option ng-repeat="kullanici in kullanicilar" value="@{{kullanici.email}}" ng-bind="kullanici.email"></option>
                            </select>
                            </div>
                            <div class="form-group">
                              <input type="text" name="onemdurumu" class="form-control" placeholder="Subject:" ng-model="mesajs.onemdurumu" >
                            </div>
                            <div class="form-group">
                              <textarea type="text"  name="mesajdetayi" ng-model="mesajs.mesajdetayi" class="form-control" style="height: 300px">

                              </textarea>
                            </div>
                            <div class="form-group">
                              <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Dosya Ekle
                                <form action="{{ route('proje.upload') }}" class="dropzone" id="file">
                                      {!! csrf_field() !!}
                                      <input type="file" name="attachment">
                                    </form>
                              </div>
                              <p class="help-block"></p>
                            </div>
                          </form>
                        </div>
                        <div class="box-footer">
                          <div class="pull-right">
                            <a   ng-click="save()" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Gönder</a>
                          </div>
                          <button ng-click="mesajGeriDon()" type="reset" class="btn btn-default"><i class="fa fa-times"></i> Vazgeç</button>
                        </div>
                        <!-- /.box-footer -->
                      </div>
                      <!-- /. box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  

                  <div class="row" id="mesajoku" style="display: none;">
                    <div class="col-md-3" >
                      <a ng-click="mesajGeriDon()" class="btn btn-primary btn-block margin-bottom">Mesajlara Dön</a>

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
                            <li><a href="" ng-click="inbox()"><i class="fa fa-inbox"></i> Gelen Kutusu
                              <span class="label label-primary pull-right"></span></a></li>
                              <li><a href="#"><i class="fa fa-envelope-o"></i> Gönderilen Kutusu</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title">Mesaj Oku</h3>

                            <div class="box-tools pull-right">
                              <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                              <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                            </div>
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                              <h3 ng-bind="mesaj.kullanici_adi"></h3>
                              <h5 ng-bind="mesaj.gonderen_kisi">
                                <span class="mailbox-read-time pull-right" ng-bind="mesaj.created_at"></span></h5>
                              </div>
                              <!-- /.mailbox-read-info -->
                              <div class="mailbox-controls with-border text-center">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                                    <i class="fa fa-trash-o"></i></button>
                                    <button type="button" ng-click="mesajGeriDon()" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                                      <i class="fa fa-reply"></i></button>
                                      <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                                        <i class="fa fa-share"></i></button>
                                      </div>
                                      <!-- /.btn-group -->
                                      <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                                        <i class="fa fa-print"></i></button>
                                      </div>
                                      <!-- /.mailbox-controls -->
                                      <div class="mailbox-read-message">
                                        <p ng-bind="mesaj.mesajdetayi"></p>
                                      </div>
                                      <!-- /.mailbox-read-message -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                    </div>
                                    <!-- /.box-footer -->
                                    <div class="box-footer">
                                      <div class="pull-right">
                                        <button type="button" ng-click="cevapla(mesaj.id)" class="btn btn-default"><i class="fa fa-reply"></i> Cevapla</button>
                                        <button ng-click="ilet(mesaj.id)" type="button" class="btn btn-default"><i class="fa fa-share"></i> İlet</button>
                                      </div>
                                      <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Sil</button>
                                      <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Yazdır</button>
                                    </div>
                                    <!-- /.box-footer -->
                                  </div>
                                  <!-- /. box -->
                                </div>
                                <!-- /.col -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            @stop