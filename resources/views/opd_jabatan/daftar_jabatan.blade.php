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
          <input type="text" id="id_bidang" name="id_bidang" hidden >
          <div class="form-group">
            <label for="exampleFormControlSelect1">Nama Jabatan</label>
            <select name="jabatan" class="form-control" id="exampleFormControlSelect1">
              <option value="0">Pilih Jabatan</option>
              @foreach ($jabatan_real as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
            </select>
          </div>           

          <div class="form-group">
            <label for="exampleFormControlSelect1">Nama Bidang</label>
            <select name="bidang" id='bidang' class="form-control" onchange="select_bidang()" id="exampleFormControlSelect1">
              <option value="0">Pilih Bidang</option>
              @foreach ($data_bidang as $data)
              <option value="{{$data['id']}}">{{$data['nama_bidang']}}</option>
              @endforeach
            </select>
          </div>           
          <div class="form-group">
            <label for="exampleFormControlSelect1">Nama Sub Bidang</label>
            <select name="sub_bidang" id="sub_bidang" class="form-control" id="exampleFormControlSelect1">
              <option value="0">Pilih Sub Bidang</option>
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
    <h3 class="card-title">Data Admin </h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <button type="button" data-toggle="modal" data-target="#modal_tambah_jabatan">Tambah Jabatan</button>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Jabatan</th>
          <th>Bidang</th>
          <th>Sub Bidang</th>
        </tr>
      </thead>
      <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($data_jabatan as $data)
        <tr>
          <td>{{$no++}}</td>
          <td>{{$data['nama_jabatan']}}</td>
          <td>{{$data['nama_bidang']}}</td>
          <td>{{$data['nama_sub_bidang']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
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

  function select_bidang(){
    var id_bidang = $("#bidang").val();
    $.ajax({
      type:'POST',
      url:"/bidang/select_bidang",
      data:{id_bidang:id_bidang},
      success:function(response){
        $("#sub_bidang").html(response);
      },
    });      
  }
</script>

@endsection