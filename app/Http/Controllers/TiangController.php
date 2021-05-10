<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiang;
use Validator;
use Illuminate\Support\Arr;

class TiangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       $tiang = Tiang::paginate(10);
       $fiterKeyword = $request->get('keyword');
       if ($fiterKeyword)
       {
         // DIJALANKAN JIKA ADA PENCARIAN
         $tiang = User::where('nama_tiang', 'LIKE', "%$fiterKeyword%")->paginate(5);
       };
       return view('tiang.index',compact('tiang'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('tiang.create');
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

         $validator = Validator::make($data,[
           'nm' =>'required',
           'jns' =>'required',
           'knt' => 'required',
           'panjang' => 'required|min:2',
           'diameter' => 'required|min:3'
         ]);

         if ($validator->fails())
         {
           return redirect()->route('tiang.create')->withErrors($validator)->withInput();
         }
         Tiang::create($data);
         return redirect()->route('tiang.index')->with('status','Tiang Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiang = Tiang::findOrFail($id);
        return view('tiang.show',compact('tiang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiang = Tiang::findOrFail($id);
        $tiang->delete();
        return redirect()->route('tiang.index')->with('status','Data Berhasil dihapus');
    }
}
