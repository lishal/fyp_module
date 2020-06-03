@extends('layouts.mainlayout')

@section('content-header')
<h2>Dashboard <small>To be decided what to show in dashboard</small></h2>
@endsection
@section('content')
<style>
    .column {
        float: left;
        width: 25%;
        padding: 0 20px;
        margin-left: 6%;
        margin-top:5%;

    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        text-align: center;
        border-bottom-width: 10px;
        border-radius: 10px;
        background-color: #f1f1f1;
        border-bottom-style: solid;

    }
    .card p {
        font-weight: bold;
        font-size: 2em;
}
</style>

<div class="column ">
    <div class="card" style="border-bottom-color: #3c8dbc;">
      <h3>Total Company</h3>
      <p>{{$company}}</p>
      <a href="{{ url('/companies') }}"><button class="btn" style="background-color:#3c8dbc; color:white; border-radius:10px;">View Company</button></a>
    </div>
  </div>
  <div class="column ">
    <div class="card" style="border-bottom-color: #3c8dbc;">
      <h3>Total Account Type</h3>
      <p>{{$type}}</p>
      <a href="{{ url('/type') }}"><button class="btn" style="background-color:#3c8dbc; color:white; border-radius:10px;">View Account Type</button></a>
    </div>
  </div>



@endsection
