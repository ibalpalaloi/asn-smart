@extends('layouts.admin_LTE_layout')

@section('header')
    <!-- DataTables -->
  <link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('modal')
{{-- modal --}}
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <br><br>
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col">

            </div>
        </div>
        <br><br>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Admin </h3>

      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <a href="/tambah_asn" type="button" class="btn btn-primary">Tambah ASN</a>
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Nip</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Lahir</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @php
              $no = 1;
          @endphp
          @foreach ($data_asn as $data)
              <td>{{$no++}}</td>
              <td>{{$data['nama']}}</td>
              <td>{{$data['nip']}}</td>
              <td>{{$data['jenis_kelamin']}}</td>
              <td>{{$data['tgl_lahir']}}</td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Lihat</button></td>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection

@section('footer')

<!-- DataTables -->
<script src="<?=url('/')?>/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

@endsection