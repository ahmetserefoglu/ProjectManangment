
@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ $page_title or "Page Title" }}
      </div>

      <div class="panel-body">
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
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('/bower_components/admin-lte/dist/img/user1-128x128.jpg') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">{{$user->rolename}}</p>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-9">
          <!-- form start -->
          <form class="form-horizontal" role="form" method="POST" action="/profile/{{$user->id}}/update">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Kullanıcı Adı:</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" 
                ng-model="user.name" ng-required="true">
              </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Kullanıcı Email:</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" 
                ng-model="user.email" ng-required="true">
              </div>
            </div>


            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Şifre:</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" ng-model="user.password"  value="{{$user->password}}">
              </div>
            </div>


            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
              <label for="roles" class="col-md-4 control-label">Kullanıcı Rolü:</label>
              <div class="col-md-6">
                <select name="rolename" ng-model="user.rolename">
                  <option  value="{{$user->rolename}}">{{$user->rolename}}</option>
                  @foreach($roles as $role)
                  <option  value="{{$role->rolename}}">{{$role->rolename}}</option>
                  @endforeach
                </select>
              </div>
            </div>



            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Güncelle
                </button>
                <a href="/" class="btn btn-primary">Geri Al</a>
              </div>
            </div>
          </form>
        </div>
      </div> <!-- container / end -->

    </div>
  </div>
</div>

@stop