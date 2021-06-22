@extends('layouts.admin_LTE_layout')

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection


@section('modal')
<!-- Bidang -->
<!-- Tambah Bidang -->
<div class="modal fade" id="modal_tambah_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH BIDANG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=url('/')?>/struktur/post-tambah-bidang" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="text" name="opd_id" hidden value="{{$opd_id}}">
            <label>Nama Bidang</label>
            <input name="nama_bidang" type="text" class="form-control" id="inputEmail3" placeholder="Masukan nama bidang" required>
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
<!-- Ubah Bidang -->
<div class="modal fade" id="modal_ubah_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UBAH BIDANG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=url('/')?>/struktur/post-ubah-bidang" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="text" id="ubah_id_bidang" name="id_bidang" hidden>            
            <label>Nama Bidang</label>
            <input name="nama_bidang" id="ubah_nama_bidang" type="text" class="form-control" id="inputEmail3" placeholder="Masukan nama bidang" required>
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
<!-- Hapus Bidang -->
<div class="modal fade" id="modal_hapus_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?=url('/')?>/struktur/post-delete-bidang" method="post">

        <div class="modal-body">
          {{ csrf_field() }}
          <div style="text-align: center;">
            <input type="text" name="id" id="hapus_id_bidang" hidden>
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

<!-- Sub Bidang -->
<!-- Tambah Sub Bidang -->
<div class="modal fade" id="modal_tambah_sub_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH SUB BAGIAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=url('/')?>/struktur/post-tambah-sub-bidang" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="text" id="id_bidang_tambah_sub_bidang" name="id_bidang" hidden >
            <label>Nama Bidang</label>
            <input type="text" class="form-control" id="nama_bidang_tambah_sub_bidang" placeholder="Sub Bidang" disabled>
          </div>    
          <div class="form-group">
            <label>Nama Sub Bidang</label>
            <input name="sub_bidang" type="text" class="form-control" id="inputEmail3" placeholder="Masukan nama Sub Bidang" required>
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
<!-- Ubah Sub Bidang -->
<div class="modal fade" id="modal_ubah_sub_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UBAH SUB BAGIAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=url('/')?>/struktur/post-ubah-sub-bidang" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Nama Bidang</label>
            <input type="text" class="form-control" id="nama_bidang_ubah_sub_bidang" placeholder="Sub Bidang" disabled>
          </div>    
          <div class="form-group">
            <label>Nama Sub Bidang</label>
            <input type="text" id="ubah_id_sub_bidang" name="id_sub_bidang" hidden>
            <input name="sub_bidang" type="text" class="form-control" id="ubah_nama_sub_bidang" placeholder="Masukan nama Sub Bidang" required>
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
<!-- Hapus Sub Bidang -->
<div class="modal fade" id="modal_hapus_sub_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?=url('/')?>/struktur/post-delete-sub-bidang" method="post">

        <div class="modal-body">
          {{ csrf_field() }}
          <div style="text-align: center;">
            <input type="text" name="id" id="hapus_id_sub_bidang" hidden>
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
    <h3 class="card-title">Struktur OPD</h3>
    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_tambah_bidang">Tambah Bidang</button>
      </div>
    </div>
  </div>

  <!-- /.card-header -->
  <div class="card-body p-0">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Bidang</th>
          <!-- <th>Action</th> -->
        </tr>
      </thead>
      <tbody>
        @php
        $no =1;
        @endphp
        @foreach ($bidang as $data)
        <tr>
          <td>{{$no++}}</td>
          <td>
            <div style="display: flex; justify-content: space-between; ">
              <div>{{$data->nama_bidang}}</div>
              <div style="padding: 0.5em 1em;">        
                <i class="fas fa-pencil-alt" onclick="ubah_bidang('{{$data->id}}', '{{$data->nama_bidang}}')" style="color: #007bff; margin-left: 1em;"></i> 
                <i class="fas fa-trash" onclick="hapus_bidang('{{$data->id}}')" style="color: #bd0101; margin-left: 1em;"></i> 
              </div>
            </div>
            <div style="margin-top: 1em;">
              <label>Sub Bidang</label>
            </div>
            @foreach ($data->sub_bidang as $sub_bidang)
            <div style="padding: 0.5em 1em;display: flex; justify-content: space-between; border-bottom: 1px solid black;">
              <div>{{$sub_bidang->nama_sub_bidang}}</div>
              <div>
                <i class="fas fa-pencil-alt" onclick="ubah_sub_bidang('{{$data->nama_bidang}}', '{{$sub_bidang->id}}', '{{$sub_bidang->nama_sub_bidang}}', )" style="color: #007bff;">
                </i> 
                <i class="fas fa-trash" onclick="hapus_sub_bidang('{{$sub_bidang->id}}')" style="color: #bd0101; margin-left: 1em;"></i> <br>
              </div>
            </div>
            @endforeach
            <button class="btn btn-success" onclick="modal_tambah_sub_bagian('{{$data->id}}', '{{$data->nama_bidang}}')" style="@if (count($data->sub_bidang) > 0) margin-top: 1em; @endif"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Sub Bidang</button>
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
  function hapus_sub_bidang(id_sub_bidang){
    $("#hapus_id_sub_bidang").val(id_sub_bidang);
    $("#modal_hapus_sub_bidang").modal('show');
  }

  function hapus_bidang(id_bidang){
    $("#hapus_id_bidang").val(id_bidang);
    $("#modal_hapus_bidang").modal('show');
  }

  function ubah_sub_bidang(nama_bidang, id_sub_bidang, nama_sub_bidang){
    $("#nama_bidang_ubah_sub_bidang").val(nama_bidang);
    $('#ubah_id_sub_bidang').val(id_sub_bidang);
    $("#ubah_nama_sub_bidang").val(nama_sub_bidang);
    $('#modal_ubah_sub_bidang').modal('show');
  }

  function ubah_bidang(id_bidang, nama_bidang){
    $('#ubah_id_bidang').val(id_bidang);
    $('#ubah_nama_bidang').val(nama_bidang);
    $('#modal_ubah_bidang').modal('show');
  }

  function modal_tambah_sub_bagian(id_bidang, nama_bidang){
    $('#nama_bidang_tambah_sub_bidang').val(nama_bidang);
    $('#id_bidang_tambah_sub_bidang').val(id_bidang);
    $('#modal_tambah_sub_bidang').modal('show');
  }
</script>
@endsection