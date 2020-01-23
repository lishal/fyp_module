<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Book Keeping</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ url("bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="{{ url("bower_components/font-awesome/css/font-awesome.min.css") }}">
  <link rel="stylesheet" href="{{ url("bower_components/Ionicons/css/ionicons.min.css") }}">
  <link rel="stylesheet" href="{{ url("bower_components/admin-lte/dist/css/AdminLTE.min.css") }}">

  <link rel="stylesheet" href="{{ url("bower_components/admin-lte/dist/css/skins/skin-blue.min.css") }}">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  @include('admin/header')
  <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <br>
            <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }}'s Profile</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>

</body>
</html>





