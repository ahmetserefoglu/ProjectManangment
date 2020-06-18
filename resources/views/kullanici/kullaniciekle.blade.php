@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button class="btn btn-warning btn-xs pull-right" ng-click="initTask()">Duyuru Ekle</button>
        <i class="fa fa-bullhorn">
          {{ $page_title or "Page Title" }}
        </i>

      </div>

      <div class="panel-body">

        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="callout callout-warning">
              <h4>Lütfen Dikkat!</h4>
              <p><b>Değerli Öğretmenler;</b> Buradan yapacağınız duyurular, velilerimizin bildirim ekranlarına yansıyacaktır. </p>
            </div>
            <div class="form-group ">       
              <label>* Öğretmen Seçiniz</label>
              <select name="teacherID" id="teacherID" class="form-control select2 select2-hidden-accessible" data-placeholder="Seçiniz" onchange="this.form.submit()" style="width:100%" tabindex="-1" aria-hidden="true">
                <option value="">Seçiniz</option>
                <option value="18" selected="selected">Ahmet Şerefoğlu</option>
              </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-teacherID-container"><span class="select2-selection__rendered" id="select2-teacherID-container" title="Ahmet Çelebi">Ahmet Şerefoğlu</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>                         </div>  
              <div class="form-group ">       
                <label>* Hangi Öğrenci(Veli) duyuru yapacaksınız?</label>
                <select name="studentID" id="studentID" class="form-control select2 select2-hidden-accessible" data-placeholder="Seçiniz" style="width:100%" tabindex="-1" aria-hidden="true">
                  <option value="" selected="selected">Seçiniz</option>
                  <option value="-1">Hepsi</option>
                  <option value="42">Ali Aslan</option>
                </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-studentID-container"><span class="select2-selection__rendered" id="select2-studentID-container" title="Hepsi">Hepsi</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>                          </div>    

                <div class="form-group ">
                  <label>* Duyuru Tarihi</label>
                  <input type="text" class="form-control" id="akttarih" name="duyurutarih" autocomplete="off">
                </div>

                <div class="form-group ">
                  <label>* Duyru Başlığınız</label>
                  <input type="text" class="form-control" id="duyurubaslik" name="duyurubaslik">
                </div>

                <div class="form-group ">
                  <label>* Duyuru Detayınızı Yazınız</label>
                  <textarea class="form-control" style="resize:none;" id="duyurudetay" name="duyurudetay"> </textarea>
                </div>



              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" name="duyurukaydet" class="btn  btn-success" value="Kaydet">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @stop


