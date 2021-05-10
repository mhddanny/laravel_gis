@extends('layouts.template')

@section('title')
  Data Jaringan
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

              @if (Request::get('keyword'))
                <a class="btn btn-success" href="{{ route('jaringan.index') }}"> Back </a>
              @else
                <a class="btn btn-success" href="{{ route('jaringan.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
              @endif

              <form method="get" action="{{route('jaringan.index')}}">
                {{-- <div class="form-group">
                  <label for="keyword" class="col-sm-2 control-label">Search By Name</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                  </div>
                </div> --}}
              </form>

            </div>
            <div class="box-body">

              @if (Request::get('keyword'))
                  <div class="alert alert-success alert-block">
                    Hasil Pencarian dengan keyword : <b>{{ Request::get('keyword') }}</b>
                  </div>
              @endif
              @include('alert.succes')
                <table class="table table-bordered" id="datatable">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Nama Jaringan</th>
                      <th>Jernis Jaringan</th>
                      <th>Luas Penampang</th>
                      <th>Gambar Jaringan</th>
                      <th width="30%">Ation</th>
                    </tr>
                    <tbody>
                        @foreach ($jaringan as $row)
                            <tr>
                              <td>{{ $loop->iteration + ($jaringan->perpage() * ($jaringan->currentPage() - 1 )) }}</td>
                              <td>{{ $row->nama_jaringan }}</td>
                              <td>{{ $row->jr }}</td>
                              <td>{{ $row->luas_penapang }}</td>
                              <td><img src="{{ asset('uploads/'.$row->gambar_jaringan) }}" width="80px"></td>
                              <td>
                                <form class="" action="{{ route('jaringan.destroy',[$row->kd_jaringan]) }}" method="post"
                                  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                  @csrf
                                  {{ method_field('Delete') }}
                                  <a class="btn btn-warning" href="{{ route('jaringan.edit',[$row->kd_jaringan]) }}">Edit</a>
                                  <button type="submit" name="button" class="btn btn-danger">Delete</button>
                                </form>
                              </td>
                           </tr>
                        @endforeach
                    </tbody>
                  </thead>
                </table>
                {{-- {{ $jaringan->appends(Request::all())->links() }} --}}
            </div>
          </div>
        </div>
</div>
@endsection
@section('footer')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#datatable').DataTable();
    });
  </script>
@endsection
