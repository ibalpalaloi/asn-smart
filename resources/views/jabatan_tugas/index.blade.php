@extends('layouts.admin_LTE_layout')

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('modal')

{{-- modal tambah admin --}}

<div class="modal fade" id="modal_tambah_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH ADMIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/jabatan/{{$jabatan->id}}/tugas/store" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group row">
            <input type="text" name="id_jabatan" value="{{$jabatan->id}}" hidden>
            <label for="inputEmail3" class="col-sm-2 col-form-label">Uraian</label>
            <div class="col-sm-10">
              <textarea name="uraian" type="text" class="form-control" id="inputEmail3" placeholder="Nama" required></textarea>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

{{-- end modal tambah admin --}}

@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Uraian Tugas {{$jabatan->nama}}</h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <button type="button" data-toggle="modal" data-target="#modal_tambah_admin">Tambah Admin</button>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Uraian</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($jabatan_tugas as $data)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$data->uraian}}</td>
        </tr>
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