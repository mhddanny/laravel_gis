<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jalan;
use DataTables;
use Validator;
use Redirect,Response;

class JalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       if ($request->ajax()) {

         $jalan = Jalan::latest()->get();
         return DataTables::of($jalan)
             ->addIndexColumn()
             ->addColumn('action', function($ja){
               $editUrl =  route('jalan.edit',[$ja->kd_jalan]);
               $button  = '<a class="btn btn-sm btn-warning" href="'.$editUrl.'">Edit</a>';
               $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                           id="'.$ja->kd_jalan.'" class="delete btn-sm btn btn-danger btn-sm deleteJalan">
                           Delete</button>';
               return $button;
             })
             ->rawColumns(['action'])
             ->tojson();
          }
       return view('jalan.index');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jalan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
         // dd($request->all());
        $validator = Validator::make($data,[
          'nama_jalan' => 'required|min:6|max:255',
          'kec' => 'required',
          'kel' => 'required',
        ]);

        if ($validator->fails())
        {
          return redirect()->route('jalan.create')->withErrors($validator)->withInput();
        }

        Jalan::create($data);
        return redirect()->route('jalan.index')->with('status','Jalan Berhasil ditambahkan');
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
        $jalan = Jalan::findOrFail($id);
        return view('jalan.edit',compact('jalan'));
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
         $jalan = Jalan::findOrFail($id);
         $data = $request->all();
          // dd($request->all());
         $validator = Validator::make($data,[
           'nama_jalan' => 'required|min:6|max:255',
           'kec' => 'required',
           'kel' => 'required'
         ]);

         if ($validator->fails())
         {
           return redirect()->route('jalan.edit',[$id])->withErrors($validator)->withInput();
         }
         $jalan->update($data);
         return redirect()->route('jalan.index')->with('status','User Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy( $id)
    {
      $jalan = Jalan::where('kd_jalan', $id);
      $jalan->delete();
      // return Response::json($jalan);
      return redirect()->route('jalan.index')->with('status', 'User Berhasil didelete');

      // $jalan = Jalan::find($id);
      //   if (is_null($jalan)) {
      //     return response()->json([
      //       'status' => FALSE,
      //       'msg' => 'Record Not Found'
      //     ],404);
      //   }
      // $jalan->delete();
      //   return response()->json([
      //     'status' => TRUE,
      //     'msg' => 'Data Berhasil didelete'
      //   ],200);
    }


}
