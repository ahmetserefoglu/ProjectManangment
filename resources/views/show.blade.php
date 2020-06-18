<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head> 
<style type="text/css">
body {
  font-family: DejaVu Sans;
}
</style>
<body>     
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th>Id</th>
            <th>F.No </th>
            <th>F.Müşteri</th>
            <th>F.Detay</th>
            <th>F.Tarih</th>
            <th>F.Total</th>
            <th>F.Vergi</th>
            <th>F.Odeme</th>
            <th>F.Adres</th>
            <th>F.Proje</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $fatura)
          <tr role="row" class="odd">
            <td></td>
            <td>{{ $fatura->id }}</td>
            <td>{{ $fatura->faturano }}</td>
            <td>{{ $fatura->faturamusteri }}</td>
            <td>{{ $fatura->faturadetay }}</td>
            <td>{{ $fatura->faturatarih }}</td>
            <td>{{ $fatura->faturatotal }}</td>
            <td>{{ $fatura->faturavergi }}</td>
            <td>{{ $fatura->faturaodeme }}</td>
            <td>{{ $fatura->faturaadres }}</td>

            <td>{{ $fatura->proje_id }}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</body>
</html>