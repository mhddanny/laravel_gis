<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travo;
use App\Jalan;
use DataTables;
use Validator,Redirect,Response;
use Storage;

class TravoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if ($request->ajax()) {
          $travo = Travo::latest()->get();
          return DataTables::Of($travo)
          ->addIndexColumn()
          ->addColumn('kd_jalan', function($tra){
            return $tra->jalan->nama_jalan;
          })
          ->addColumn('action', function($tra){
            $editUrl =  route('travo.edit',[$tra->kd_travo]);
            $button  = '<a class="btn btn-sm btn-warning" href="'.$editUrl.'">Edit</a>';
            $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                        id="'.$tra->kd_travo.'" class="delete btn-sm btn btn-danger btn-sm deleteTravo">
                        Delete</button>';
            return $button;
          })
          ->rawColumns(['action', 'kd_jalan'])
          ->tojson();
      }

      return view('travo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $travo = Travo::all();
        $jalan = Jalan::all();

        return view('travo.create', compact('travo','jalan'));
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
        'nama_travo' => 'required|max:255|unique:travo',
        'kd_jalan' => 'required',
        'latitude' => 'required|numeric|unique:travo',
        'longitude' => 'required|numeric|unique:travo',
        'rayon' => 'required',
        // 'gambar_travo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
      ]);

      if ($validator->fails()) {
        return redirect()->route('travo.create')->withErrors($validator)->withInput();
      }

      // $gambar_travo = $request->file('gambar_travo');
      // $extention = $gambar_travo->getClientOriginalExtension();

      // if ($request->file('gambar_travo')->isValid()) {
      //     $namaFoto = "travo/".date('YmdHis').".".$extention;
      //     $upload_path = 'public/uploads/travo';
      //     $request->file('gambar_travo')->move($upload_path,$namaFoto);
      //     $input['gambar_travo'] = $namaFoto;
      // }

      Travo::create($input);
      return redirect()->route('travo.index')->with('status', 'Data Travo Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data_travo = Travo::all();
      $x = 0;
      foreach ($data_travo as $row) {
          $hasil[$x]['0'] = $row->nama_travo;
          $hasil[$x]['1'] = $row->latitude;
          $hasil[$x]['2'] = $row->longitude;
          $x++;
      }

      $hasil_lat_long = json_encode($hasil);

      $lokasi = Travo::first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $travo = Travo::findOrFail($id);
      $jalan = Jalan::all();

      $hasil_lat_long = json_encode($travo);
      // $lokasi = Panel::first();
      return view('travo.edit', compact('hasil_lat_long','jalan','travo'));
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
        $travo = Travo::findOrFail($id);

        $input = $request->all();
        $validator = Validator::make($input,[
          'nama_travo' => 'required|max:255',
          'kd_jalan' => 'required',
          'latitude' => 'required|numeric',
          'longitude' => 'required|numeric',
          'rayon' => 'required',
          'gambar_travo' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
          return redirect()->route('travo.edit',[$id])->withErrors($validator)->withInput();
        }

        if ($request->hasfile('gambar_travo')) {
          if ($request->file('gambar_travo')->isValid()) {
            Storage::disk('upload')->delete($panel->gambar_travo);

              $gambar_travo = $request->file('gambar_travo');
              $extention = $gambar_travo->getClientOriginalExtension();
              $namaFoto = "travo/".date('YmdHis').".".$extention;
              $upload_path = 'public/uploads/travo';
              $request->file('gambar_travo')->move($upload_path,$namaFoto);
              $input['gambar_travo'] = $namaFoto;
          }
        }
        $travo->update($input);
        return redirect()->route('travo.index')->with('status', 'Data Travo Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travo = Travo::findOrFail($id);
        $travo->delete();
        Storage::disk('upload')->delete($travo->gambar_travo);
        return redirect()->route('travo.index')->with('status', 'Data travo Berhasil dihapus');
    }

    public function kordinat(){
      $travo = Travo::all();
      $hasil_lat_long = json_encode($travo);
      return view('travo.kordinat',compact('travo','hasil_lat_long'));
    }
}
