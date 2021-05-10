<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Panel;
use App\Travo;
use App\Jalan;
use DataTables;
use Validator,Redirect,Response;
use Storage;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
        if ($request->ajax()) {
          $panel = Panel::latest()->get();
          return DataTables::of($panel)
          ->addIndexColumn()
          ->addColumn('kd_jalan', function($pa){
            return $pa->jalan->nama_jalan;
          })
          ->addColumn('kd_travo', function($pa){
            return $pa->travo->nama_travo;
          })
          ->addColumn('action', function($pa){
            $editUrl =  route('panel.edit',[$pa->kd_panel]);
            $button  = '<a class="btn btn-sm btn-warning" href="'.$editUrl.'">Edit</a>';
            $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                        id="'.$pa->kd_panel.'" class="delete btn-sm btn btn-danger btn-sm deletePanel">
                        Delete</button>';
            return $button;
          })
          ->rawColumns(['kd_jalan', 'kd_travo', 'action'])
          ->tojson();
        }
        return view('panel.index');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $panel = Panel::all();
      $jalan = Jalan::all();
      $travo = Travo::all();

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
      return view('panel.create_panel',compact('panel','hasil_lat_long','lokasi','jalan','travo'));

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
        'no_panel' => 'required|max:255|unique:panel',
        'kd_jalan' => 'required',
        'kd_travo' => 'required',
        'id_pel' => 'required|numeric|unique:panel',
        'daya_kwh' => 'required|max:255',
        'latitude' => 'required|numeric|unique:panel',
        'longitude' => 'required|numeric|unique:panel',
        'gambar_panel' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'ket' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('panel.create_panel')->withErrors($validator)->withInput();
      }

      $gambar_panel = $request->file('gambar_panel');
      $extention = $gambar_panel->getClientOriginalExtension();

      if ($request->file('gambar_panel')->isValid()) {
          $namaFoto = "panel/".date('YmdHis').".".$extention;
          $upload_path = 'public/uploads/panel';
          $request->file('gambar_panel')->move($upload_path,$namaFoto);
          $input['gambar_panel'] = $namaFoto;
      }

      Panel::create($input);
      return redirect()->route('panel.index')->with('status', 'Data Panel Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // $panel = Panel::orderBy('no_panel','ASC')->paginate(10);
      //
      // $data_panel = Panel::all();
      // $x = 0;
      // foreach ($data_panel as $row) {
      //     $hasil[$x]['0'] = $row->no_panel;
      //     $hasil[$x]['1'] = $row->travo->nama_travo;
      //     $hasil[$x]['2'] = $row->latitude;
      //     $hasil[$x]['3'] = $row->longitude;
      //     $x++;
      // }
      //
      // $hasil_lat_long = json_encode($hasil);
      //
      // $lokasi = Panel::first();
      // return view('panel.index',compact('panel','hasil_lat_long','lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $panel = Panel::findOrFail($id);
      $jalan = Jalan::all();
      $travo = Travo::all();

      $hasil_lat_long = json_encode($panel);
      // $lokasi = Panel::first();
      return view('panel.edit', compact('hasil_lat_long','panel','jalan','travo'));
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
      $panel = Panel::findOrFail($id);

      $input = $request->all();
      // return response()->json($input);
      // dd($input);
      $validator = Validator::make($input,[
        'no_panel' => 'required|max:255',
        'kd_jalan' => 'required',
        'kd_travo' => 'required',
        'id_pel' => 'required|numeric',
        'daya_kwh' => 'required|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'gambar_panel' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048',
        'ket' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('panel.edit',[$id])->withErrors($validator)->withInput();
      }

      if ($request->hasfile('gambar_panel')) {

        if ($request->file('gambar_panel')->isValid()) {
          Storage::disk('upload')->delete($panel->gambar_panel);

          $gambar_panel = $request->file('gambar_panel');
          $extention = $gambar_panel->getClientOriginalExtension();
          $namaFoto = "panel/".date('YmdHis').".".$extention;
          $upload_path = 'public/uploads/panel';
          $request->file('gambar_panel')->move($upload_path,$namaFoto);
          $input['gambar_panel'] = $namaFoto;
        }
      }

      $panel->update($input);
      return redirect()->route('panel.index')->with('status', 'Data Panel Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $panel = Panel::findOrFail($id);
        $panel->delete();
        Storage::disk('upload')->delete($panel->gambar_panel);
        return redirect()->route('panel.index')->with('status', 'Data Panel Berhasil dihapus');
    }

    public function kordinat(){
      $panel = Panel::all();
      $hasil_lat_long = json_encode($panel);
      return view('panel.kordinat',compact('hasil_lat_long','panel'));
    }
}
