<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jalan;
Use App\Jaringan;
use App\Lampu;
Use App\kategori_lampu;
use App\Marker1;
use App\Panel;
use App\Tiang;
use App\Travo;
use Validator;
use Storage;
use App\Imports\ImportLampu;
use DataTables;
use Excel;

class LampuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->ajax()) {
        $lampu = Lampu::latest()->get();
        return DataTables::of($lampu)
         ->addIndexColumn()
         ->addColumn('kt_lampu', function($lam){
           return $lam->kategori->nama_lampu;
         })
         ->addColumn('kt_lampu1', function($lam){
           return $lam->kategori->kt;
         })
         ->addColumn('kd_panel', function($lam){
           return $lam->panel->no_panel;
         })
         ->addColumn('kd_travo', function($lam){
           return $lam->travo->nama_travo;
         })
         ->addColumn('kd_jalan', function($lam){
           return $lam->jalan->nama_jalan;
         })
         ->addColumn('kd_tiang', function($lam){
           return $lam->tiang->nm;
         })
         ->addColumn('kd_jaringan', function($lam){
           return $lam->jaringan->nama_jaringan;
         })
         ->addColumn('action', function($lam){
           $editUrl  =  route('lampu.edit',[$lam->kd_lampu]);
           $button   = '<a class="btn btn-sm btn-warning" href="'.$editUrl.'">Edit</a>';
          //  $editUrl2 = route('lampu.show',[$lam->kd_lampu]);
          //  $button   = '<a class="btn btn-sm btn-info" href="'.$editUrl2.'">Info</a>';
           $button  .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                       id="'.$lam->kd_lampu.'" class="delete btn-sm btn btn-danger btn-sm deleteLampu">
                       Delete</button>';
           return $button;
         })
         ->rawColumns(['kt_lampu', 'kt_lampu1 ', 'kd_panel', 'kd_travo', 'kd_jalan', 'kd_tiang', 'kd_jaringan', 'action' ])
         ->tojson();
      }
      return view('lampu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $jalan = Jalan::all();
          $jaringan = Jaringan::all();
          $kategori = kategori_lampu::all();
          $panel = Panel::all();
          $tiang = Tiang::all();
          $travo = Travo::all();
          return view('lampu.create',compact('jalan','jaringan','kategori','panel','tiang','travo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $input = $request->all();
       // dd($input);
      $validator = Validator::make($input,[
        'no_lampu' => 'required|max:255',
        'kt_lampu' => 'required',
        'kd_panel' => 'required',
        'kd_travo' => 'required',
        'kd_jalan' => 'required',
        'kd_tiang' => 'required',
        'kd_jalan' => 'required',
        'latitude' => 'required|numeric|unique:lampu',
        'longitude' => 'required|numeric|unique:lampu',
        'ket' => 'required',
        'gambar_lampu' => 'required|image|mimes:jpeg,jpg,png|max:2048'
      ]);

      if ($validator->fails()) {
        return redirect()->route('lampu.create')->withErrors($validator)->withInput();
      }

      $gambar_lampu = $request->file('gambar_lampu');
      $extention = $gambar_lampu->getClientOriginalExtension();

      if ($request->file('gambar_lampu')->isValid()) {

          $namaFoto = "lampu/".date('YmdHis').".".$extention;
          $upload_path = 'public/uploads/lampu';
          $request->file('gambar_lampu')->move($upload_path,$namaFoto);
          $input['gambar_lampu'] = $namaFoto;
      }

      Lampu::create($input);
      return redirect()->route('lampu.index')->with('status', 'Lampu Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $jalan = Jalan::all();
      $jaringan = Jaringan::all();
      $kategori = kategori_lampu::all();
      $panel = Panel::all();
      $tiang = Tiang::all();
      $travo = Travo::all();
      $lampu = Lampu::findOrFail($id);
      return view('lampu.show',compact('lampu','jalan','jaringan','kategori','panel','tiang','travo'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $jalan = Jalan::all();
      $jaringan = Jaringan::all();
      $kategori = kategori_lampu::all();
      $panel = Panel::all();
      $tiang = Tiang::all();
      $travo = Travo::all();
      $lampu = Lampu::findOrFail($id);

      $hasil_lat_long = json_encode($lampu);
      return view('lampu.edit',compact('hasil_lat_long','lampu','jalan','jaringan','kategori','panel','tiang','travo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $lampu = Lampu::findOrFail($id);
      $input = $request->all();

      $validator = Validator::make($input,[
        'no_lampu' => 'required|max:255',
        'kt_lampu' => 'required',
        'kd_panel' => 'required',
        'kd_travo' => 'required',
        'kd_jalan' => 'required',
        'kd_tiang' => 'required',
        'kd_jalan' => 'required',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'ket' => 'required',
        'gambar_lampu' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
      ]);

      if ($validator->fails()) {
        return redirect()->route('lampu.edit',[$id])->withErrors($validator)->withInput();
      }

      if ($request->hasfile('gambar_lampu')) {
          if ($request->file('gambar_lampu')->isValid()) {
              Storage::disk('upload')->delete($lampu->gambar_lampu);

              $gambar_lampu = $request->file('gambar_lampu');
              $extention = $gambar_lampu->getClientOriginalExtension();
              $namaFoto = "lampu/".date('YmdHis').".".$extention;
              $upload_path = 'uploads/lampu';
              $request->file('gambar_lampu')->move($upload_path,$namaFoto);
              $input['gambar_lampu'] = $namaFoto;
          }
      }

      $lampu->update($input);
      return redirect()->route('lampu.index')->with('status', 'Lampu Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lampu = Lampu::findOrFail($id);
        $lampu->delete();
        Storage::disk('upload')->delete($lampu->gambar_lampu);
        return redirect()->route('lampu.index')->with('status', 'Data Lampu Berhasil dihapus');
    }

    public function koordinat()

    {
        $lampu = Lampu::all();
        $hasil_lat_long = json_encode($lampu);

        $lokasi = Marker1::first();
        return view('lampu.koordinat',compact('hasil_lat_long','lampu'));
    }

    public function update_kor(Request $request, $id)
    {
        $input = $request->all();
        $lampu = Lampu::find($id);
        $marker = Marker1::findOrFail($id);

        return response()->json($input);

    }
    // public function import_lampu(Request $request)
    // {
    //    // dd($request->all());

    //   Excel::import( new ImportLampu, $request->file('data_lampu'));

    // }

}
