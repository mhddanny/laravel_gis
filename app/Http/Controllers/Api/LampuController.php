<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LampuResource;
use App\Lampu;
use Validator;
use Storage;

class LampuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LampuResource::collection(Lampu::all());
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
            'no_lampu'=> 'required|max:255',
            'kt_lampu'=> 'required|numeric',
            'kd_panel'=> 'required|numeric',
            'kd_travo'=> 'required|numeric',
            'kd_jalan'=> 'required|numeric',
            'kd_tiang'=> 'required|numeric',
            'kd_jaringan'=> 'required|numeric',
            'ket'=> 'required',
            'gambar_lampu'=> 'required|image|mimes:jpeg,jpg,png|max:2048'
          ]);

          if ($validator->fails()) {
              return response()->json([
                "status"=>FALSE,
                "msg"=>$validator->errors()
              ],400);
          }

          if ($request->file('gambar_lampu')->isValid()) {
              $gambar_lampu = $request->file('gambar_lampu');
              $extention = $gambar_lampu->getClientOriginalExtension();
              $namaFoto = "lampu/".date('YmdHis').".".$extention;
              $upload_path = 'public/uploads/lampu';
              $request->file('gambar_lampu')->move($upload_path,$namaFoto);
              $input['gambar_lampu'] = $namaFoto;
          }

          if (Lampu::create($input)) {
            // respon berhasil
            return response()->json([
              'status'=>TRUE,
              'msg'=>'Lampu Berhasil disimpan'
            ],201);
          }
          else
          {
            // Lampu gagal
            return response()->json([
              'status'=>FALSE,
              'msg'=>'Lampu Gagal disimpan'
            ],200);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $lampu = Lampu::find($id);
          if (is_null($lampu)) {
              return response()->json([
                "status" => FALSE,
                "msg" => 'Record Not Found'
              ],404);
          }
          return new LampuResource($lampu);
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
         $input = $request->all();
         $lampu = Lampu::find($id);

         if (is_null($lampu)) {
            return response()->json([
               'status' => FALSE,
               'msg' => 'Record Not Found'
                ],404);
         }

         $validator = Validator::make($input,[
           'no_lampu'=> 'required|max:255',
           'kt_lampu'=> 'required|numeric',
           'kd_panel'=> 'required|numeric',
           'kd_travo'=> 'required|numeric',
           'kd_jalan'=> 'required|numeric',
           'kd_tiang'=> 'required|numeric',
           'kd_jaringan'=> 'required|numeric',
           'ket'=> 'required',
           'gambar_lampu'=> 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
         ]);

         if ($validator->fails()) {
             return response()->json([
               "status"=>FALSE,
               "msg"=>$validator->errors()
             ],400);
         }

         if ($request->hasfile('gambar_lampu'))
         {
            if ($request->hasfile('gambar_lampu')->isValid()) {
              $gambar_lampu = $request->file('gambar_lampu');
              $extention = $gambar_lampu->getClientOriginalExtension();
              $namaFoto = "lampu/".date('YmdHis').".".$extention;
              $upload_path = 'public/uploads/lampu';
              $request->file('gambar_lampu')->move($upload_path,$namaFoto);
              $input['gambar_lampu'] = $namaFoto;
            }
         }

         $lampu->update($input);
         return response()->json([
           'status' => TRUE,
           'msg' => 'Record not Found'
         ],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lampu = Lampu::find($id);
        if (is_null($lampu)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Found'
            ],404);
        }

        $lampu->delete();
        Storage::disk('upload')->delete($lampu->gambar_lampu);
        return response()->json([
          'status' => TRUE,
          'msg' => 'Data Berhasil didelete'
        ],200);
    }

    public function search(Request $request)
    {
      $filterKeyword = $request->get('keyword');
      return LampuResource::collection(Lampu::where('no_lampu','LIKE',"%$filterKeyword%")->get());
    }
}
