<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker1;
use App\Lampu;
use App\Panel;
use Validator;
use Storage;
use DataTables;

class Marker1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->ajax())
      {
          $marker = Marker1::latest()->get();
          return  DataTables::of($marker)
            ->addIndexColumn()
            ->addColumn('action', function($ma){
                $editUrl = route('marker.edit',[$ma->id]) ;
			          $button = '<a class="btn btn-warning" href="'.$editUrl.'">Edit</a>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                            id="'.$ma->id.'" class="delete btn btn-danger btn-sm">
                            Delete</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->tojson();
      }
      return view('marker.index2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lampu = Lampu::all();
        $marker = Marker1::all();
        return view('Marker.create',compact('lampu','marker'));
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

        $validator = Validator::make($input,[
          'nama_jalan' => 'required|max:225|unique:maker1',
          'latitude' => 'required|numeric|unique:maker1',
          'longitude' => 'required|numeric|unique:maker1',
          // 'gbr' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('marker.index')->withErrors($validator)->withInput();
        }

        $gbr = $request->file('gbr');
        $extention = $gbr->getClientOriginalExtension();

        if ($request->file('gbr')->isValid()) {
            $namaFoto = "marker/".date('YmdHis').".".$extention;
            $upload_path = 'public/uploads/marker';
            $request->file('gbr')->move($upload_path,$namaFoto);
            $input['gbr'] = $namaFoto;
        }
        // return response()->json($input);
        Marker1::create($input);
        return redirect()->route('marker.index')->with('status', 'Marker Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Marker.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $lampu = Lampu::all();
      $marker = Marker1::find($id);

      $hasil_lat_long = json_encode($marker,);
      $lokasi = Marker1::first();
      return view('Marker.edit',compact('lampu','marker','hasil_lat_long', 'lokasi'));
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
      $marker = Marker1::findOrFail($id);
      $input = $request->all();

      $validator = Validator::make($input,[
        'nama_jalan' => 'required|max:225',
        'latitude' => 'required|max:255',
        'latitude' => 'required|max:255',
        'longitude' => 'required|max:255',
        // 'gbr' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048',
      ]);

      if ($validator->fails()) {
          return redirect()->route('marker.edit',[$id])->withErrors($validator)->withInput();
      }
      // return dd($input);
      if ($request->hasfile('gbr')) {

        if ($request->file('gbr')->isValid()) {
          Storage::disk('upload')->delete($marker->gbr);

          $gbr = $request->file('gbr');
          $extention = $gbr->getClientOriginalExtension();
          $namaFoto = "marker/".date('YmdHis').".".$extention;
          $upload_path = 'public/uploads/marker';
          $request->file('gbr')->move($upload_path,$namaFoto);
          $input['gbr'] = $namaFoto;
        }
      }

      $marker->update($input);
      $lokasi = Marker1::first();
      return redirect()->route('marker.index')->with('status', 'Marker Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $marker  = Marker1::findOrFail($id);
      $marker->delete();
      Storage::disk('upload')->delete($marker->gbr);
      return redirect()->route('marker.index')->with('status', 'Marker Berhasil disimpan');
      // return response()->json(['done']);
    }

    public function koordinat(Request $request)

    // {
    //     $marker = Marker1::all();
    //     $hasil_lat_long = json_encode($marker);

    //     return view('Marker.koordinat',compact('hasil_lat_long','marker'));
    // }
   {
     $fiterKeyword = $request->get('keyword');
       if ($fiterKeyword)
       {
         // DIJALANKAN JIKA ADA PENCARIAN
         $data_marker = Marker1::where('id_pel', 'LIKE', "%$fiterKeyword%")->get();
       }else {
         $data_marker = Marker1::all();
       };
      $x = 0;
      foreach ($data_marker as $row) {
          $hasil[$x]['0'] = $row->id_pel;
          $hasil[$x]['1'] = $row->lat;
          $hasil[$x]['2'] = $row->long;
          $hasil[$x]['3'] = $row->nama_jalan;
          $hasil[$x]['4'] = $row->st_panel;
          $hasil[$x]['5'] = $row->no_travo;
          $x++;
      }

      $hasil_lat_long = json_encode($hasil);


      $lokasi = Marker1::first();
      return view('Marker.koordinat',compact('hasil_lat_long','lokasi'));
    }

    public function getdatamarker()
    {
        $marker = Marker1::select('maker1.*');

        return \DataTables::eloquent($marker)->toJson();
    }

}
