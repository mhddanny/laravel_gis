<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Marker1Resource;
use App\Marker1;
use App\Lampu;
use Storage;
use Validator;

class Marker1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Marker1Resource::collection(Marker1::all());
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
            'kd_lampu' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
          ]);

          if ($validator->fails()) {
              return response()->json([
                "status"=>FALSE,
                "msg"=>$validator->errors()
              ],400);
          }
          if (Marker1::create($input)) {
              //memberikan respon berhaasil
              return response()->json([
                'status'=>TRUE,
                'msg'=>'Marker Berhasil disimpan'
              ],201);
          }
          else{
            //membrerikan respon tidak berhasil
            return response()->json([
              'status'=>FALSE,
              'msg'=>'Marker gagal disimpan'
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
        $marker = Marker1::find($id);
        if (is_null($marker)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Fount'
            ],404);
        }

        return new Marker1Resource($marker);
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
          $marker = Marker1::find($id);

          if (is_null($marker)) {
              return response()->json([
                'status' => FALSE,
                'msg' => 'Record Not Found'
              ],404);
          }

          $validator = Validator::make($input,[
              'kd_lampu' => 'required|numeric',
              'latitude' => 'required|numeric',
              'longitude' => 'required|numeric'
          ]);

          if ($validator->fails()) {
              return response()->json([
                "status"=>FALSE,
                "msg"=>$validator->errors()
              ],400);
          }

          $marker->update($input);
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
        $marker  = Marker1::find($id);
        if (is_null($marker)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Found'
            ],404);
        }
        $marker->delete();
        return redirect()->route('merker.index')->with('status', 'Data Lampu Berhasil dihapus');
    }

    public function search(Request $request)
    {
      $filterKeyword = $request->get('keyword');
      return Marker1Resource::collection(Marker1::where('kd_lampu','LIKE',"%$filterKeyword%")->get());
    }
}
