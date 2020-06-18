@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-truck">
          {{ $page_title or "Page Title" }}
        </i>
      </div>

      <div class="box-body">
        <div class="row">
          <div class="panel-body">

           <div class="col-md-8" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">

            <h3 class="col-md-8 col-md-offset-4"  >Palet ve Konteyner Yükleme Programı</h3>

            <form class="form-horizontal" name="toplam" role="form">
              Palet Seçiniz
              <!--<div class="form-group">
                <div class="col-sm-12">
                  <select name="palet" id="palet" class="form-control" data-placeholder="Select a State"
                  style="width: 100%;" >
                  <option  value="0">Palet Seciniz</option>
                  <option  value="europalet">Euro Palet(mm)(800*1200)</option>
                  <option  value="standartpalet">Standart Palet(mm)(1000*1100)</option>
                  <option  value="custompalet">Custom Palet</option>
                </select>
              </div>
            </div>-->
            <div class="form-horizontal" id="custompaletx" style="display: none;">
             Custom Width(mm): <input class="form-control" type="number" id="customwidth">
             Custom Length(mm): <input class="form-control" type="number" id="customlength">
            </div>

            Box Width(mm): <input class="form-control" type="number" id="width">
            Box Length(mm): <input class="form-control" type="number" id="length">
            Box Height(mm): <input class="form-control" type="number" id="height">


            <!--Loading Height(mm): <input class="form-control" type="number" id="loadingheight">-->

            

            <!--Standart Palet Width(mm): <input class="form-control" type="number" id="standartwidth">
            Standart Palet Length(mm): <input class="form-control" type="number" id="standartlength">
            Standart Palet Height(mm): <input  class="form-control" type="number" id="standartheight">-->


            <input type="button" id="btnTopla" value="Hesapla">
          </form>
        </div>
        <div class="col-md-4" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;">
         <h3 class="col-md-8 col-md-offset-4"  >Sonuçlar</h3>
         <!--<div id="paletsize"></div>
         <div id="paketsize"></div>
         <div id="totalwight"></div>-->
         <div id="paket"></div>

         <div id="katman"></div>
         <div id="paketsayisi"></div>
         

       </div>


           <!-- Box Width(mm): <input class="form-control" type="number" ng-model="width">
            Box Length(mm): <input class="form-control" type="number" ng-model="length">
            Box Height(mm): <input class="form-control" type="number" ng-model="height">

            Euro Palet Width(mm): <input class="form-control" type="number" name="eurowidth">
            Euro Palet Length(mm): <input class="form-control" type="number" name="eurolength">
            Euro Palet Height(mm): <input class="form-control" type="number" name="euroheight">

            Standart Palet Width(mm): <input class="form-control" type="number" name="standartwidth">
            Standart Palet Length(mm): <input class="form-control" type="number" name="standartlength">
            Standart Palet Height(mm): <input  class="form-control" type="number" name="standartheight">-->


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



@stop

