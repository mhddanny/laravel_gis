<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TravoResource;
use App\Travo;
use App\Jalan;
use Storage;
use Validator;

class TravoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return TravoResource::collection(Travo::all());
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
            'nama_travo' => 'required|max:255',
            'kd_jalan' => 'required|numeric',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'rayon' => 'required|max:255',
            'gambar_travo' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
              "status"=>FALSE,
              "msg"=>$validator->errors()
            ],400);
        }

        if ($request->file('gambar_travo')->isValid()) {
            $gambar_travo = $request->file('gambar_travo');
            $extention = $gambar_travo->getClientOriginalExtension();
            $namaFoto = "travo/".date('YmdHis').".".$extention;
            $upload_path = 'public/uploads/travo';
            $request->file('gambar_travo')->move($upload_path,$namaFoto);
            $input['gambar_travo'] = $namaFoto;
        }

        if (Travo::create($input)) {
            //memberikan respon berhaasil
            return response()->json([
              'status'=>TRUE,
              'msg'=>'Travo Berhasil disimpan'
            ],201);
        }
        else{
          //membrerikan respon tidak berhasil
          return response()->json([
            'status'=>FALSE,
            'msg'=>'Travo gagal disimpan'
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
        $travo = Travo::find($id);
        if (is_null($travo)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Found'
            ],404);
        }

        return new TravoResource($travo);
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
        $input =  $request->all();
        $travo = Travo::find($id);

        if (is_null($travo)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Found'
            ],404);
        }

        $validator = Validator::make($input,[
            'nama_travo' => 'required|max:255',
            'kd_jalan' => 'required|numeric',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'rayon' => 'required|max:255',
            'gambar_travo' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
              "status"=>FALSE,
              "msg"=>$validator->errors()
            ],400);
        }

        if ($request->hasfile('gambar_travo'))
        {
          if ($request->file('gambar_travo')->isValid())
          {
            Storage::disk('upload')->delete($travo->gambar_travo);

            $gambar_travo = $request->file('gambar_travo');
            $extention = $gambar_travo->getClientOriginalExtension();
            $namaFoto = "travo/".date('YmdHis').".".$extention;
            $upload_path = 'public/uploads/travo';
            $request->file('gambar_travo')->move($upload_path,$namaFoto);
            $input['gambar_travo'] = $namaFoto;
          }
        }

        $travo->update($input);
        return response()->json([
          'status' => TRUE,
          'msg' => 'Data Berhasil dipudate'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travo = Travo::find($id);
        if (is_null($travo)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Found'
            ],404);
        }

        $travo->delete();
        Storage::disk('upload')->delete($travo->gambar_travo);
        return response()->json([
          'status' => TRUE,
          'msg' => 'Data Berhasil didelete'
        ],200);
    }

    public function search(Request $request)
    {
      $filterKeyword = $request->get('keyword');
      return TravoResource::collection(Travo::where('nama_travo','LIKE',"%$filterKeyword%")->get());
    }
}
