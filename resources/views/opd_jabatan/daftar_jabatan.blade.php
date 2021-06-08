@extends('layouts.admin_LTE_layout')

@section('header')
<!-- DataTables -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('modal')

<div class="modal fade" id="modal_tambah_jabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH JABATAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/post_opd_jabatan" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <input type="text" id="id_bidang" name="id_bidang" hidden>
          <input type="text" id="jenis" name="jenis" hidden>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Nama Jabatan</label>
            <select name="jabatan" class="form-control" id="exampleFormControlSelect1">
              <option value="0">Pilih Jabatan</option>
              @foreach ($jabatan_real as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
            </select>
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

@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Daftar Jabatan</h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="list-group">
      @foreach ($data_bidang as $data)
        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between align-items-center">
          {{$data['nama_bidang']}}
          <span onclick="modal_tambah_jabatan('bidang', '{{$data['id']}}')" class="badge badge-primary badge-pill">Tambah</span>
        </li>
        <ul class="list-group list-group-flush"b style="padding-left: 40px">
        @foreach ($data['jabatan'] as $jabatan)
          <li class="list-group-item">{{$jabatan->jabatan->nama}}
            <span onclick="hapus_jabatan('{{$jabatan->id}}')" class="badge badge-danger badge-pill">Hapus</span>
          </li>
        @endforeach
        </ul>
      @endforeach
      @foreach ($data_sub_bidang as $sub_bidang)
        <li class="list-group-item list-group-item-action list-group-item-secondary d-flex justify-content-between align-items-center">
          {{$sub_bidang['nama_sub_bidang']}}
          <span onclick="modal_tambah_jabatan('sub_bidang', '{{$sub_bidang['id']}}')" class="badge badge-primary badge-pill">Tambah</span>
        </li>
        <ul class="list-group list-group-flush"b style="padding-left: 40px">
          @foreach ($sub_bidang['jabatan'] as $jabatan)
            <li class="list-group-item">
              {{$jabatan->jabatan->nama}}
              <span onclick="hapus_jabatan('{{$jabatan->id}}')" class="badge badge-danger badge-pill">Hapus</span>
            </li>
          @endforeach
        </ul>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function modal_tambah_jabatan(jenis, id){
    $('#id_bidang').val(id);
    $('#jenis').val(jenis);
    $('#modal_tambah_jabatan').modal('show');
  }

  function hapus_jabatan(id){
    location.href = "/hapus_opd_jabatan/"+id;
  }
</script>

@endsection