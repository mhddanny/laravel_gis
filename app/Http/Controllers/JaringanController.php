<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jaringan;
use Validator;
use Storage;

class JaringanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       $jaringan = Jaringan::paginate(5);
       $fiterKeyword = $request->get('keyword');
       if ($fiterKeyword)
       {
         // DIJALANKAN JIKA ADA PENCARIAN
         $jaringan = Jaringan::where('nama_jaringan', 'LIKE', "%$fiterKeyword%")->paginate(5);
       };
       return view('jaringan.index',compact('jaringan'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jaringan = Jaringan::all();
        return view('jaringan.create');
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
        'nama_jaringan' => 'required|max:255',
        'jr' => 'required',
        'luas_penapang' => 'required|max:255',
        'gambar_jaringan' => 'required|image|mimes:jpeg,jpg,png|max:2048'
      ]);

      if ($validator->fails()) {
        return redirect()->route('jaringan.create')->withErrors($validator);
      }

      $gambar_jaringan = $request->file('gambar_jaringan');
      $extention = $gambar_jaringan->getClientOriginalExtension();

      if ($request->file('gambar_jaringan')->isValid()) {
          $namaFoto = "gambar_jaringan/".date('YmdHis').".".$extention;
          $upload_path = 'public/uploads/gambar_jaringan';
          $request->file('gambar_jaringan')->move($upload_path,$namaFoto);
          $input['gambar_jaringan'] = $namaFoto;
      }

      Jaringan::create($input);
      return redirect()->route('jaringan.index')->with('status', 'Jaringan Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $jaringan = Jaringan::findOrFail($id);
      return view('jaringan.edit',compact('jaringan'));
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
        $jaringan = Jaringan::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($input,[
          'nama_jaringan' => 'required|max:255',
          'jr' => 'required',
          'luas_penapang' => 'required|max:255',
          'gambar_jaringan' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
          return redirect()->route('jaringan.edit',[$id])->withErrors($validator);
        }

        if ($request->hasfile('gambar_jaringan'))
        {
          if ($request->file('gambar_jaringan')->isValid())
          {
            Storage::disk('upload')->delete($jaringan->gambar_jaringan);

            $gambar_jaringan = $request->file('gambar_jaringan');
            $extention = $gambar_jaringan->getClientOriginalExtension();
            $namaFoto = "gambar_jaringan/".date('YmdHis').".".$extention;
            $upload_path = 'uploads/gambar_jaringan';
            $request->file('gambar_jaringan')->move($upload_path,$namaFoto);
            $input['gambar_jaringan'] = $namaFoto;

          }
        }
        $jaringan->update($input);
        return redirect()->route('jaringan.index')->with('status', 'Data Jaringan Berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jaringan = Jaringan::findOrFail($id);
        $jaringan->delete();
        Storage::disk('upload')->delete($jaringan->gambar_jaringan);
        return redirect()->route('jaringan.index')->with('status', 'Data Jaringan Berhasil dihapus');
    }
}
