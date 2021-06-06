@extends('layouts.admin_LTE_layout')

@section('header')
    <!-- DataTables -->
  <link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection


@section('modal')
{{-- modal tambah bidang --}}

<div class="modal fade" id="modal_tambah_sub_bagian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH BIDANG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/post_tambah_bidang" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <input type="text" id="id_bidang" name="id_bidang" hidden >
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Bidang</label>
            <div class="col-sm-10">
              <input name="nama_bidang" type="text" class="form-control" id="inputEmail3" placeholder="NAMA BIDANG" required>
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

{{-- end modal tambah bidang --}}

{{-- modal sub bagian --}}

<div class="modal fade" id="modal_tambah_sub_bagian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">TAMBAH SUB BAGIAN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/post_tambah_sub_bidang" method="post">
          <div class="modal-body">
            {{ csrf_field() }}
            <input type="text" id="id_bidang" name="id_bidang" hidden >
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input name="sub_bidang" type="text" class="form-control" id="inputEmail3" placeholder="Sub Bidang" required>
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
  
  {{-- end modal tambah sub bagian --}}

  {{-- modal ubah bidang --}}

<div class="modal fade" id="modal_ubah_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">UBAH BIDANG</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/post_ubah_bidang" method="post">
          <div class="modal-body">
            {{ csrf_field() }}
            <input type="text" id="id_bidang_ubah_bidang" name="id_bidang" hidden>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input name="bidang" type="text" class="form-control" id="nama_bidang" placeholder="Sub Bidang" required>
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
  
  {{-- end modal ubah bidang --}}

  {{-- modal ubah sub bidang --}}

<div class="modal fade bd-example-modal-lg" id="modal_ubah_sub_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">UBAH BIDANG</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/post_ubah_sub_bidang" method="post">
          <div class="modal-body">
            {{ csrf_field() }}
            <input type="text" id="id_sub_bidang_ubah" name="id_sub_bidang" hidden>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Bidang</label>
                <div class="col-sm-10">
                  <input name="" type="text" class="form-control" id="nama_bidang_ubah" placeholder="" required readonly>
                </div>
              </div>  
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Sub Bidang</label>
              <div class="col-sm-10">
                <input name="sub_bidang" type="text" class="form-control" id="nama_sub_bidang" placeholder="" required>
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
  
  {{-- end modal ubah sub bidang --}}
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Struktur OPD</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <button type="button" data-toggle="modal" data-target="#modal_tambah_admin">Tambah Bidang</button>
          </div>
        </div>
    </div>
    
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                <th>#</th>
                <th>Bidang</th>
                <th>Sub Bidang</th>
                <th>Label</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no =1;
                @endphp
                @foreach ($bidang as $data)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$data->nama_bidang}} <i class="fas fa-pencil-alt" onclick="ubah_bidang('{{$data->id}}', '{{$data->nama_bidang}}')"></i> <i class="fas fa-trash" onclick="hapus_bidang('{{$data->id}}')"></i> </td>
                        <td>
                            @foreach ($data->sub_bidang as $sub_bidang)
                                {{$sub_bidang->nama_sub_bidang}} <i class="fas fa-pencil-alt" onclick="ubah_sub_bidang('{{$sub_bidang->id}}', '{{$sub_bidang->nama_sub_bidang}}', '{{$data->nama_bidang}}')"></i> <i class="fas fa-trash" onclick="hapus_sub_bidang('{{$sub_bidang->id}}')"></i> <br>
                            @endforeach
                        </td>
                        <td>
                            <button onclick="modal_tambah_sub_bagian('{{$data->id}}', '{{$data->nama_bidang}}')">Tambah Sub Bidang</button>
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
        location.replace("/hapus_sub_bidang/"+id_sub_bidang);
    }

    function hapus_bidang(id_bidang){
        location.replace("/hapus_bidang/"+id_bidang);
    }

    function ubah_sub_bidang(id_bidang, nama_sub_bidang, nama_bidang){
        $('#modal_ubah_sub_bidang').modal('show');
        $('#id_sub_bidang_ubah').val(id_bidang);
        $('#nama_sub_bidang').val(nama_sub_bidang);
        $('#nama_bidang_ubah').val(nama_bidang);
        $('#modal_ubah_sub_bidang').modal('show');
    }

    function ubah_bidang(id_bidang, nama_bidang){
        $('#id_bidang_ubah_bidang').val(id_bidang);
        $('#nama_bidang').val(nama_bidang);
        $('#modal_ubah_bidang').modal('show');
    }

    function modal_tambah_sub_bagian(id_bidang, nama_bidang){
        $('#id_bidang').val(id_bidang);
        $('#modal_tambah_sub_bagian').modal('show');
    }
</script>
@endsection