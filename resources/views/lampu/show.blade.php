@extends('layouts.template')

@section('title')
Data User
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="{{ route('lampu.index') }}" class="btn btn-success">Back</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                  <tr>
                    <td>NO Lampu</td>
                    <td>:</td>
                    <td>{{ $lampu->no_lampu}}</td>
                  </tr>
                  <tr>
                    <td>Merk Lampu</td>
                    <td>:</td>
                    <td>{{ $lampu->kategori->nama_lampu}}</td>
                  </tr>
                  <tr>
                    <td>Jenis Lampu</td>
                    <td>:</td>
                    <td>{{ $lampu->kategori->kt}}</td>
                  </tr>
                  <tr>
                    <td>Daya Lampu</td>
                    <td>:</td>
                    <td>{{ $lampu->kategori->daya}}</td>
                  </tr>
                  <tr>
                    <td>Posisi Lampu</td>
                    <td>:</td>
                    <td>{{ $lampu->jalan->nama_jalan}}</td>
                    <td>
                      <form class="" action="" method="post"
                        onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                        @csrf
                        {{ method_field('Delete') }}
                        <a class="btn btn-warning" href="">Edit</a>
                        <button type="submit" name="button" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td>Gambar Lampu</td>
                    <td>:</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$lampu->gambar_lampu) }}" width="100px"></td>
                  </tr>
                  <tr>
                    <td>No Panel</td>
                    <td>:</td>
                    <td>{{ $lampu->panel->no_panel}}</td>
                  </tr>
                  <tr>
                    <td>Id Pel</td>
                    <td>:</td>
                    <td>{{ $lampu->panel->id_pel}}</td>
                  </tr>
                  <tr>
                    <td>Daya Kwh</td>
                    <td>:</td>
                    <td>{{ $lampu->panel->daya_kwh}}</td>
                  </tr>
                  <tr>
                    <td>Gambar Panel</td>
                    <td>:</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$lampu->panel->gambar_panel) }}" width="100px"></td>
                  </tr>
                  <tr>
                    <td>Posisi Panel</td>
                    <td>:</td>
                    <td>{{ $lampu->panel->jalan->nama_jalan}}</td>
                    <td>
                      <form class="" action="" method="post"
                        onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                        @csrf
                        <a class="btn btn-primary" href="">Show</a>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td>No Travo</td>
                    <td>:</td>
                    <td>{{ $lampu->travo->nama_travo}}</td>
                  </tr>
                  <tr>
                    <td>Posisi Travo</td>
                    <td>:</td>
                    <td>{{ $lampu->travo->jalan->nama_jalan}}</td>
                    <td>
                      <form class="" action="" method="post"
                        onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                        @csrf
                        <a class="btn btn-primary" href="">Show</a>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td>Gambar Travo</td>
                    <td>:</td>
                    <td><img class="img-thumbnail" src="{{ asset('uploads/'.$lampu->travo->gambar_travo) }}" width="100px"></td>
                  </tr>
                  <tr>
                    <td>Status Tiang</td>
                    <td>:</td>
                    <td>{{ $lampu->tiang->nm }}</td>
                  </tr>
                  <tr>
                    <td>Jenis Tiang</td>
                    <td>:</td>
                    <td>{{ $lampu->tiang->jns }}</td>
                  </tr>
                  <tr>
                    <td>Model Tiang</td>
                    <td>:</td>
                    <td>{{ $lampu->tiang->knt }}</td>
                  </tr>
                  <tr>
                    <td>Panjanng Tiang</td>
                    <td>:</td>
                    <td>{{ $lampu->tiang->panjang }}</td>
                  </tr>
                  {{-- jika ada klem --}}
                  <tr>
                    <td>Klem stang</td>
                    <td>:</td>
                    <td>{{ $lampu->tiang->diameter }}</td>
                  </tr>
                  <tr>
                    <td>Jenis Jaringan</td>
                    <td>:</td>
                    <td>{{ $lampu->jaringan->nama_jaringan}}</td>
                  </tr>
                  <tr>
                    <td>Luas Penampang</td>
                    <td>:</td>
                    <td>{{ $lampu->jaringan->luas_penapang }}</td>
                  </tr>
                </table>
            </div>
          </div>
        </div>
</div>
@endsection
