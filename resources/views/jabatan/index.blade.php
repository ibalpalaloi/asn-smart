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
      <form action="/jabatan/store" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input name="nama" type="text" class="form-control" id="inputEmail3" placeholder="Nama" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Ikhtisar</label>
            <div class="col-sm-10">
              <textarea name="ikhtisar" type="text" class="form-control" id="inputEmail3" placeholder="Nama" required></textarea>
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

{{-- modal ubah jabatan --}}

<div class="modal fade" id="modal_ubah_jabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UBAH ADMIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/ubah_jabatan" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <input type="text" name="id_jabatan" id="id_jabatan" hidden>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input name="nama" type="text" class="form-control" id="nama_jabatan" placeholder="Nama" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Ikhtisar</label>
            <div class="col-sm-10">
              <textarea name="ikhtisar" type="text" class="form-control" id="ikhtisar_jabatan" placeholder="Nama" required></textarea>
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

{{-- end modal ubah jabatan --}}

@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Admin </h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <button type="button" data-toggle="modal" data-target="#modal_tambah_admin">Tambah Jabatan</button>
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
          <th>Ikhtisar</th>
          <th>Tugas Jabatan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($jabatan as $data)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$data->nama}}</td>
          <td>{{$data->ikhtisar}}</td>
          <td>
            <a href="/jabatan/{{$data->id}}/tugas" class="btn btn-primary">
              {{$data->tugas_jabatan}} Tugas
            </a>
            <button onclick="modal_ubah_jabatan('{{$data->id}}')" class="btn btn-warning">Ubah</button>
            <button onclick="hapus_jabatan('{{$data->id}}')" class="btn btn-danger">Hapus</button>
          </td>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<script>
  function hapus_jabatan(id_jabatan){
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = "/hapus_jabatan/"+id_jabatan;
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  }

  function modal_ubah_jabatan(id_jabatan){
    $.ajax({
      type: 'GET',
      url: '/jabatan/'+id_jabatan,
      success:function(data){
        console.log(data.jabatan);
        $('#id_jabatan').val(id_jabatan);
        $('#nama_jabatan').val(data.jabatan['nama']);
        $('#ikhtisar_jabatan').val(data.jabatan['ikhtisar']);
        $('#modal_ubah_jabatan').modal('show');
      }
    })
  }
</script>

@endsection