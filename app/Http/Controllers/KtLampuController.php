<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori_Lampu;
use Validator;
use Storage;

class KtLampuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {

         $ktlampu = Kategori_Lampu::paginate(5);
         $fiterKeyword = $request->get('keyword');
         if ($fiterKeyword)
         {
           // DIJALANKAN JIKA ADA PENCARIAN
           $ktlampu = Kategori_Lampu::where('kategori_lampu', 'LIKE', "%$fiterKeyword%")->paginate(5);
         };
         return view('ktlampu.index',compact('ktlampu'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ktlampu.create');
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
          'nama_lampu' => 'required|max:255',
          'kt' => 'required',
          'daya' => 'required|max:255',
          'gambar_kt_lampu' => 'required|image|mimes:jpeg,jpg,png|max:2048',
          'gbr' => 'required|image|mimes:jpeg,jpg,png|max:2048'
         ]);

         if ($validator->fails()) {
           return redirect()->route('ktlampu.create')->withErrors($validator)->withInput();
         }

         $gambar_kt_lampu = $request->file('gambar_kt_lampu');
         $extention = $gambar_kt_lampu->getClientOriginalExtension();

         if ($request->file('gambar_kt_lampu')->isValid()) {
             $namaFoto = "kategori_lampu/".date('YmdHis').".".$extention;
             $upload_path = 'public/uploads/kategori_lampu';
             $request->file('gambar_kt_lampu')->move($upload_path,$namaFoto);
             $input['gambar_kt_lampu'] = $namaFoto;
         }

         $gbr = $request->file('gbr');
         $extention = $gbr->getClientOriginalExtension();

         if ($request->file('gbr')->isValid()) {
             $namaFoto = "marker/".date('YmdHis').".".$extention;
             $upload_path = 'public/uploads/marker';
             $request->file('gbr')->move($upload_path,$namaFoto);
             $input['gbr'] = $namaFoto;
         }

         Kategori_Lampu::create($input);
         return redirect()->route('ktlampu.index')->with('status', 'Kategori Lampu Berhasil disimpan');
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
          $ktlampu = Kategori_Lampu::findOrFail($id);
          return view('ktlampu.edit',compact('ktlampu'));
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
          $ktlampu = Kategori_Lampu::findOrFail($id);

          $input = $request->all();

          $validator = Validator::make($input,[
            'nama_lampu' => 'required|max:255',
            'kt' => 'required',
            'daya' => 'required|max:255',
            'gambar_kt_lampu' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
            'gbr' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
          ]);

          if ($validator->fails())
          {
            return redirect()->route('ktlampu.edit',[$id])->withErrors($validator);
          }

          if ($request->hasfile('gambar_kt_lampu'))
          {
            if ($request->file('gambar_kt_lampu')->isValid())
            {
              Storage::disk('upload')->delete($ktlampu->gambar_kt_lampu);

              $gambar_kt_lampu = $request->file('gambar_kt_lampu');
              $extention = $gambar_kt_lampu->getClientOriginalExtension();
              $namaFoto = "kategori_lampu/".date('YmdHis').".".$extention;
              $upload_path = 'public/uploads/kategori_lampu';
              $request->file('gambar_kt_lampu')->move($upload_path,$namaFoto);
              $input['gambar_kt_lampu'] = $namaFoto;

            }
          }
          if ($request->hasfile('gbr'))
          {
            if ($request->file('gbr')->isValid())
            {
              Storage::disk('upload')->delete($ktlampu->gbr);

              $gbr = $request->file('gbr');
              $extention = $gbr->getClientOriginalExtension();
              $namaFoto = "marker/".date('YmdHis').".".$extention;
              $upload_path = 'public/uploads/marker';
              $request->file('gbr')->move($upload_path,$namaFoto);
              $input['gbr'] = $namaFoto;

            }
          }

          $ktlampu->update($input);
          return redirect()->route('ktlampu.index')->with('status', 'Kategori Lampu Berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ktlampu = Kategori_Lampu::findOrFail($id);
        $ktlampu->delete();
        Storage::disk('upload')->delete($ktlampu->gambar_kt_lampu);
        Storage::disk('upload')->delete($ktlampu->gbr);
        return redirect()->route('ktlampu.index')->with('status', 'Kategori Lampu Berhasil dihapus');
    }
}
