@extends('layouts.admin_LTE_layout')

@section('header')
<!-- DataTables -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('modal')

@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Tambah Data ASN</h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                  <option>Pria</option>
                  <option>Wanita</option>
                </select>
              </div>
        </div>
        <div class="col-md-6"></div>
    </div>
  </div>
</div>
@endsection

@section('footer')

@endsection