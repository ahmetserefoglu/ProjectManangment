@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="box-tools pull-right">
      <button  type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-default">
                     Code Gönder
                   </button>
    </div>
    <i class="fa fa-phone">
      {{ $page_title }}
    </i>
  </div>

  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
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


      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
      @endif
      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
           <table id="example" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
               
                <th>Contact Number</th>
                <th>Code</th>
                <th>Pending</th>
                <th>Created At</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($smsverification as $sms)
              <tr role="row" class="odd">
                <td>{{ $sms->contact_number }}</td>
                <td>{{ $sms->code }}</td>
                <td>{{ $sms->status }}</td>
                <td>{{ $sms->created_at }}</td>
                <td>
                    
                 <button  type="button" class="btn btn-primary btn-xs" id="mail" data-toggle="modal" data-target="#modal-verify">
                     Verify
                   </button>
               </td>
             </tr>
             <div class="modal fade" id="modal-verify">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="{{ route('sms.verify',['contact_number' => $sms->contact_number]) }}" >
                    {!! csrf_field() !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Verify</h4>
                      </div>
                      <div class="modal-body">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" >
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">
                          Kontrol Et
                        </button>
                      </div>
                    </form>


                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
             
              @endforeach
            </tbody>
          </table>
          
        </div>
      </div>
 <!-- /.modal -->
             <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="{{ route('sms.send') }}" >
                    {!! csrf_field() !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Sms</h4>
                      </div>
                      <div class="modal-body">
                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" >
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">
                          Gönder
                        </button>
                      </div>
                    </form>


                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
    </div>
    
  </div>

</div>
</div>
</div>
</div>
</div>
@stop