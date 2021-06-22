@extends('layouts.admin_LTE_layout')

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('modal')

{{-- modal tambah admin --}}
<!-- Tambah Bidang -->
<div class="modal fade" id="modal_tambah_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH BIDANG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=url('/')?>/jabatan/store" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Nama</label>
            <input name="nama" type="text" class="form-control" id="inputEmail3" placeholder="Nama" required>
          </div>    
          <div class="form-group">
            <label>Ikhtisar</label>
            <textarea name="ikhtisar" type="text" class="form-control" required placeholder="" rows="4"></textarea>
          </div>    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Modal ubah jabatan -->
<div class="modal fade" id="modal_ubah_jabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH BIDANG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=url('/')?>/jabatan/update" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="id_jabatan" id="ubah_id_jabatan" hidden>
            <input name="nama" type="text" class="form-control" id="ubah_nama_jabatan" placeholder="Nama" required>
          </div>    
          <div class="form-group">
            <label>Ikhtisar</label>
            <textarea name="ikhtisar" type="text" class="form-control" id="ubah_ikhtisar_jabatan" placeholder="Nama" required></textarea>
          </div>    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Modal hapus jabatan -->
<div class="modal fade" id="modal_hapus_jabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?=url('/')?>/jabatan/delete" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div style="text-align: center;">
            <input type="text" name="id" id="hapus_id_jabatan" hidden>
            <i class="fa fa-trash" style="font-size: 5em; color: #dc3545;"></i>
            <h4 style="margin-top: 0.5em;">Apakah anda yakin ingin menghapus data?</h4>
            <div style="margin-top: 0.5em;"></div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary">Hapus</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" style=" background: #dc3545; border: 1px solid #dc3545;">Batal</button>
        </div>
      </form>
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_tambah_admin">Tambah Jabatan</button>
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
              {{$data->jabatan_tugas->count()}} Tugas
            </a>
            <button onclick="ubah_jabatan('{{$data->id}}', '{{$data->nama}}', '{{$data->ikhtisar}}')" class="btn btn-warning">Ubah</button>
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
    $('#hapus_id_jabatan').val(id_jabatan);
    $('#modal_hapus_jabatan').modal('show');
    // swal({
    //   title: "Are you sure?",
    //   text: "Once deleted, you will not be able to recover this imaginary file!",
    //   icon: "warning",
    //   buttons: true,
    //   dangerMode: true,
    // })
    // .then((willDelete) => {
    //   if (willDelete) {
    //     window.location.href = "/hapus_jabatan/"+id_jabatan;
    //   } else {
    //     swal("Your imaginary file is safe!");
    //   }
    // });
  }

  function ubah_jabatan(id_jabatan, nama, ikhtisar){
    $('#ubah_id_jabatan').val(id_jabatan);
    $('#ubah_nama_jabatan').val(nama);
    $('#ubah_ikhtisar_jabatan').val(ikhtisar);
    $('#modal_ubah_jabatan').modal('show');
  }
</script>

@endsection