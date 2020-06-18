@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-image (alias)"></i>
        <h3 class="box-title">Resim Yükle</h3>
        
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>

      <!-- /.box-header -->
      <div class="box-body table-responsive" ng-app="App" ng-controller="FileUploadController">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
              <div class="alert alert-danger" style="display: none;">
                      <p>
                        <ul   ng-if="errors.length > 0">
                            <li ng-repeat="error in errors">
                             <h1 ng-bind="error"></h1>
                           </li>
                         </ul>
                      </p>
                    </div>
              <label for="files">{{ trans('adminlte.SelectImg') }}</label>
              <input type="file" ng-files="setTheFiles($files)" name="image_file[]" id="image_file" multiple  class="form-control"/>
              <br>
              <button ng-click="uploadFile()" class="">Resim Dosyası Yükle</button>
              <div class="modal fade" id="myModal" ng-click="close($files)" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="modal-title" id="myModalLabel">@{{form_title}}</h4>
                    </div>
                    
                    <div class="modal-body">
                     <img id="temp_image" width="500" height="250" ></img>
                   </div>
                   <div id="buton" class="form-group">
                    <button ng-click="uploadFile()" class="">Resim Dosyası Yükle</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="alert alert-success" style="display: none;"><p></p></div>
            
            

         </div>
       </div>
     </div>

     <div class="row">
      <div class="col-md-12">
        <h4>{{ trans('adminlte.UploadFiles') }}</h4>
        <!--<table ng-if="files.length > 0" class="table table-bordered table-striped">
          <tr>
            <th>Resim</th>
            <th>{{ trans('adminlte::adminlte.ID') }}</th>
            <th>{{ trans('adminlte::adminlte.ImgName') }}</th>
            <th>{{ trans('adminlte::adminlte.Size') }}</th>
            <th>{{ trans('adminlte::adminlte.Type') }}</th>
            <th>{{ trans('adminlte::adminlte.UploadedDate') }}</th>
            <th></th>
          </tr>
          <tr ng-repeat="file in files">
            <td><img ng-src="{{ asset('image_uploads') }}/@{{file.src}}" id="temp_image"  height="42" width="42" ></td>
            <td ng-bind="$index + 1"></td>
            <td ng-bind="file.name"></td>
            <td ng-bind="file.size"></td>
            <td ng-bind="file.type"></td>
            <th ng-bind="file.created_at">

            </th>
            <td>
              <button ng-click="deleteFile($index)" class="btn btn-danger">{{ trans('adminlte::adminlte.Delete') }}</button>
            </td>
          </tr>
        </table>-->
        <div class="alert alert-info" style="display: none;" ng-if="files.length == 0">
          Dosya Bulunamadı,Lütfen Dosyaları Yükleyiniz.
        </div>
        <div class="spinner" ng-hide="loaded"></div>
        <div class="col-md-2" ng-repeat="file in files" ng-cloak="" ng-show="loaded">
        <!-- Profile Image -->
        
        <div class="box box-primary" >
          <div class="box-body box-profile">
            <a href="" ng-click="showImage(file.id)" id="image_file" >
              <img  class="profile-user-img" height="80" width="120" ng-src="/image_uploads/@{{file.src}}" alt="@{{file.name}}">
            </a>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>File Type</b> <a class="pull-right">@{{file.src}}</a>
              </li>
              <li class="list-group-item">
                <b>File Size</b> <a class="pull-right">@{{file.size}}</a>
              </li>
            </ul>
            <div class="col-md-7">
             <a href="/image_uploads/@{{file.src}}" class="btn btn-primary" download>{{ trans('adminlte.Download') }}</a>
            </div>
             <div class="col-md-5">
              <button ng-click="deleteFile($index)" class="btn btn-primary">{{ trans('adminlte.Delete') }}</button>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
        
      </div>
    </div>
    


  </div>
</div>
</div>
</div>

@stop