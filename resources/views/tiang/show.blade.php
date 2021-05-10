@extends('layouts.template')

@section('title')
Data Tiang
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="{{ route('tiang.index') }}" class="btn btn-success">Back</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered">

                </table>
            </div>
          </div>
        </div>
</div>
@endsection
