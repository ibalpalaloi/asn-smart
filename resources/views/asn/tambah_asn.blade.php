@extends('layouts.admin_LTE_layout')

@section('header')
<!-- DataTables -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=url('/')?>/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet"/>


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
    <form action="<?=url('/')?>/post_tambah_asn" method="POST">
      {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
          <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" required>
          </div>
          <div class="form-group">
          
          <div class="form-group">
            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
            <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin" required>
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
            </select>
          </div>
          <div class="form-group">
            <label>Tempat Lahit</label>
            <input type="text" class="form-control" name="tempat_lahir" required>
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="text" class="form-control" id="datepicker" name="tgl_lahir" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required id="" cols="4" rows="2" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Kelurahan</label>
            <input type="text" class="form-control" name="kelurahan" required>
          </div>
          <div class="form-group">
            <label>Kecamatan</label>
            <input type="text" class="form-control" name="kecamatan" required>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">RT</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="rt" required>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">RW</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="rw" required>
                </div>
              </div>
            </div>
          </div>
            <div class="form-group">
              <label>Nomor Telp</label>
              <input type="text" class="form-control" name="no_hp" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label>Agama</label>
              <input type="text" class="form-control" name="agama" required>
            </div>
            <div class="form-group">
              <label>Golongan Darah</label>
              <input type="text" class="form-control" name="gol_darah" required>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Bidang</label>
            <select class="form-control" id="select_bidang" name="bidang">
              <option value="Pria">bidang</option>
              @foreach ($bidang as $data)
                <option value="{{$data->id}}">{{$data->nama_bidang}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Sub Bidang</label>
            <select class="form-control" id="select_sub_bidang" name="sub_bidang">
              <option value="Pria">sub bidang</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Jabatan</label>
            <select class="form-control" id="select_jabatan" name="jabatan">
              <option value="Pria">jabatan</option>
            </select>
          </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script>
  $("#select_bidang").change(function(){
    var id_bidang = $(this).val();
    $('#select_sub_bidang').empty();
    $('#select_sub_bidang').append($('<option>',{
          value: "-",
          text: 'Memuat.......'
        }));
    $.ajax({
      url: "<?=url('/')?>/get_sub_bidang/"+id_bidang,
      type: "GET",
      success: function(data){
        var sub_bidang = data.sub_bidang;
        console.log(sub_bidang);
        $('#select_sub_bidang').empty();
        $('#select_sub_bidang').append($('<option>',{
              value: "-",
              text: "Pilih Sub Bidang"
            }));
        for(i=0; i<sub_bidang.length; i++){
            $('#select_sub_bidang').append($('<option>',{
              value: sub_bidang[i]['id'],
              text: sub_bidang[i]['nama_sub_bidang']
            }));
        }
      }
    });


  });

  $('#select_sub_bidang').change(function(){
    var id_sub_bidang = $(this).val();
    $('#select_jabatan').empty();
    $('#select_jabatan').append($('<option>',{
          value: "-",
          text: 'Memuat.......'
        }));

    $.ajax({
      url: "<?=url('/')?>/get_jabatan_sub_bidang/"+id_sub_bidang,
      type: "GET",
      success: function(data){
        console.log(data.data_jabatan);
        $('#select_jabatan').empty();
        var jabatan = data.data_jabatan;
        for(i=0; i<jabatan.length; i++){
          $('#select_jabatan').append($('<option>',{
              value: jabatan[i]['id'],
              text: jabatan[i]['nama_jabatan']
            }));
        }
      }
    })
  })
</script>
<script>
  $('#datepicker').datepicker({
    format: 'yyyy-mm-dd',
  });
</script>
@endsection