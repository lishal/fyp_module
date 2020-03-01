@extends('layouts.mainlayout')
@section('content-header')
<h2>Update profile </h2>
@endsection
@section('content')
@include('validation.messages')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="/uploads/avatars/{{ $user->avatar }}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;">
                    <h2 style="margin-top:5px;">{{ $user->first_name }}'s Profile</h2></div>
                <div class="panel-body">

                    <br>
                    <form class="form-horizontal" enctype="multipart/form-data" action="/profile" method="POST">
                        @csrf
                        <div class="form-group first_name">
                            <label class="col-md-2 control-label">First Name*</label>
    
                            <div class="col-md-7">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name')? old('first_name'): ($user->first_name? $user->first_name: '') }}">
                            </div>
                        </div>
                        <div class="form-group last_name">
                            <label class="col-md-2 control-label">Last Name*</label>
    
                            <div class="col-md-7">
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name')? old('last_name'): ($user->last_name? $user->last_name: '') }}">
                            </div>
                        </div>
                        <div class="form-group email">
                            <label class="col-md-2 control-label">Email Address*</label>
    
                            <div class="col-md-7">
                                <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{ old('email')? old('email'): ($user->email? $user->email: '') }}">
                            </div>
                        </div>
                        <div class="form-group avatar">
                            <label class="col-md-2 control-label">Avatar</label>
                            <div class="col-md-7">
                                <input type="file" name="avatar" class="form-control">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </div>
                        
                        <div class="form-group bi-form-controls">
                            <div class="col-md-9 text-left">
                                <button type="submit" class="btn btn-default pull-right">UPDATE</button>
                            </div>
                        </div>
                    </form>
                    <div class="panel-heading">
                        <h3>CHANGE PASSWORD</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/update_password">
                            @csrf

                            <div class="form-group old_password">
                                <label class="col-md-2 control-label">Old Password*</label>
        
                                <div class="col-md-7">
                                    <input type="password" class="form-control" placeholder="Old Password" name="old_password" value="">
                                </div>
                            </div>

                            <div class="form-group new_password">
                                <label class="col-md-2 control-label">New Password*</label>
        
                                <div class="col-md-7">
                                    <input type="password" class="form-control" placeholder="New Password" name="new_password" value="">
                                </div>
                            </div>
        
                            <div class="form-group confirm_password">
                                <label class="col-md-2 control-label">Confirm New Password*</label>
        
                                <div class="col-md-7">
                                    <input type="password" class="form-control" placeholder="Confirm New Password" name="new_password_confirmation" value="">
                                </div>
                            </div>
        
                            <div class="form-group bi-form-controls">
                                <div class="col-md-9 text-left">
                                    <button type="submit" class="btn btn-default pull-right">CHANGE PASSWORD</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection




