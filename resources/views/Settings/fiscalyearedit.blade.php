@extends('layouts.mainlayout')
@section('content-header')
<h2>Add Fiscal Year</h2>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default panel-default-equal">
            <div class="panel-heading">
                <h5>Fiscal Year Detail</h5>
            </div>
            <div class="panel-body">
                @include('validation.messages')
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/fiscalyear/save') }}" enctype="multipart/form-data">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
