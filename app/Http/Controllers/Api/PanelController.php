<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PanelResource;
use App\Panel;
use App\Jalan;
use App\Travo;
use Storage;
use Validator;

class PanelController extends Controller
{
    public function get_panel()
    {
      return PanelResource::collection(Panel::all());
    }

    public function store(Request $request)
    {
      $input = $request->all();

      $validator = Validator::make($input,[
        'no_panel' => 'required|max:255',
        'kd_jalan' => 'required|numeric',
        'kd_travo' => 'required|numeric',
        'id_pel' => 'required|numeric',
        'daya_kwh' => 'required|max:255',
        'latitude' => 'required|max:255',
        'longitude' => 'required|max:255',
        'gambar_panel' => 'required|image|mimes:jpeg,jpg,png|max:2048'
      ]);

      if ($validator->fails()) {
          return response()->json([
            "status"=>FALSE,
            "msg"=>$validator->errors()
          ],400);
      }

      if ($request->file('gambar_panel')->isValid()) {
          $gambar_panel = $request->file('gambar_panel');
          $extention = $gambar_panel->getClientOriginalExtension();
          $namaFoto = "panel/".date('YmdHis').".".$extention;
          $upload_path = 'public/uploads/panel';
          $request->file('gambar_panel')->move($upload_path,$namaFoto);
          $input['gambar_panel'] = $namaFoto;
      }

      if (Panel::create($input)) {
          //memberikan respon berhaasil
          return response()->json([
            'status'=>TRUE,
            'msg'=>'Panel Berhasil disimpan'
          ],201);
      }
      else{
        //membrerikan respon tidak berhasil
        return response()->json([
          'status'=>FALSE,
          'msg'=>'Panel gagal disimpan'
        ],200);
      }
    }

    public function show($id)
    {
        $panel = Panel::find($id);
        if (is_null($panel)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Fount'
            ],404);
        }

        return new PanelResource($panel);
    }

    public function update(Request $request, $id)
    {
      $input = $request->all();
      $panel = Panel::find($id);

      $panel = Panel::find($id);
      if (is_null($panel)) {
          return response()->json([
            'status' => FALSE,
            'msg' => 'Record Not Fount'
          ],404);
      }

      $validator = Validator::make($input,[
        'no_panel' => 'required|max:255',
        'kd_jalan' => 'required|numeric',
        'kd_travo' => 'required|numeric',
        'id_pel' => 'required|numeric',
        'daya_kwh' => 'required|max:255',
        'latitude' => 'required|max:255',
        'longitude' => 'required|max:255',
        'gambar_panel' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
      ]);

      if ($validator->fails()) {
          return response()->json([
            "status"=>FALSE,
            "msg"=>$validator->errors()
          ],400);
      }

      if ($request->hasfile('gambar_panel'))
      {
        if ($request->file('gambar_panel')->isValid())
        {
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
        return response()->json([
          'status' => TRUE,
          'msg' => 'Data Berhasil dipudate'
        ],200);
    }

    public function delete($id)
    {
        $panel = Panel::find($id);
        if (is_null($panel)) {
            return response()->json([
              'status' => FALSE,
              'msg' => 'Record Not Found'
            ],404);
        }

        $panel->delete();
        Storage::disk('upload')->delete($panel->gambar_panel);
        return response()->json([
          'status' => TRUE,
          'msg' => 'Data Berhasil didelete'
        ],200);
    }

    public function search(Request $request)
    {
      $filterKeyword = $request->get('keyword');
      return PanelResource::collection(Panel::where('nama_travo','LIKE',"%$filterKeyword%")->get());
    }

}
