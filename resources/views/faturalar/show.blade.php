@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-calendar">
        </i>
      </div>

      <div class="box-body">

        <div class="row" >
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
             <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Ödeme Yap
             </button>
             <a href="#" class="btn btn-primary pull-right" onclick="HTMLtoPDF()" ><i class="fa fa-print"></i></a>

           </div>
         </div>

         <div class="panel-body">

          <section class="invoice">

            <!-- title row -->
            <div class="row"  >
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fa fa-globe"></i> {{$fatura->faturamusteri}}
                  <small class="pull-right">Date: {{$fatura->faturatarih}}</small>
                </h2>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info"  id="HTMLtoPDF">
              <div class="col-sm-4 invoice-col">
                Müşteri
                <address>
                  <strong>{{$fatura->faturamusteri}}</strong><br>
                  {{$fatura->faturamusteri}}<br>
                  {{$fatura->faturaadres}}<br>
                  Phone: {{$fatura->telefon}}<br>
                  Web: {{$fatura->webadresi}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Gönderen Yetkili
                <address>

                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Fatura numarası: {{$fatura->faturano}}</b><br>
                <br>
                <b>Sayfa Id:</b> 4F3S8J<br>
                <b>Ödeme Tarihi:</b> {{$fatura->faturatarih}}<br>
                <b>Hesap Numarası:</b> 968-34567
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Firma Adı</th>
                      <th>Proje Adı</th>
                      <th>Proje İcerik</th>
                      <th>Proje Süresi</th>
                      <th>Proje Durumu</th>
                      <th>P.Başlangıç Tarihi</th>
                      <th>P.Bitiş Tarihi</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr >
                      <td >{{$projeler->id}}</td>
                      <td >{{$projeler->FirmaAdi}}</td>
                      <td >{{$projeler->ProjeAdi}}</td>
                      <td >{{$projeler->Icerik}}</td>
                      <td >{{$projeler->Sure}}</td>
                      <td >{{$projeler->Durumu}}</td>
                      <td >{{$projeler->BaslangicTarihi}}</td>
                      <td >{{$projeler->BitisTarihi}}</td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-xs-6">
                <p class="lead">Ödeme Metodu:</p>
                <img src="{{ asset('/bower_components/admin-lte/dist/img/credit/visa.png') }}" alt="Visa">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/credit/american-express.png') }}" alt="American Express">
                <img src="{{ asset('/bower_components/admin-lte/dist/img/credit/paypal2.png') }}" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                 {{$fatura->faturaodeme}}
               </p>
             </div>
             <!-- /.col -->
             <div class="col-xs-6">
              <p class="lead"></p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Total:</th>
                    <td>TL{{$fatura->faturatotal}}</td>
                  </tr>
                  <tr>
                    <th>Vergi (%)</th>
                    <td>%{{$fatura->faturavergi}}</td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@stop