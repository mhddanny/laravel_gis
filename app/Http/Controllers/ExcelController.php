<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportJalan;
use App\Imports\ImportJalan;
use App\Exports\ExportTravo;
use App\Imports\ImportTravo;
use App\Exports\ExportMarker;
use App\Imports\ImportMarker;
use App\Exports\ExportLampu;
use App\Imports\ImportLampu;
use App\Exports\ExportPanel;
use App\Imports\ImportPanel;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class ExcelController extends Controller
{
      public function export_jalan()
      {
        return Excel::download(new ExportJalan, 'jalan.xlsx');
      }

      public function import_jalan(Request $request)
      {
        $input =$request->all();
        $validator = Validator::make($input,[
          'data_jalan' => 'required|mimes:csv,xls,xlsx'
        ]);

        if ($validator->fails())
        {
          return redirect()->route('jalan.index')->withErrors($validator)->withInput();
        }

          Excel::import(new ImportJalan, $request->file('data_jalan'));

          return redirect()->back()->with('status','Data Berhasil Di Upload');
      }

      public function export_travo()
      {
        return Excel::download(new ExportTravo, 'travo.xlsx');
      }

      public function import_travo(Request $request)
      {
          $input = $request->all();
          $validator = Validator::make($input,[
            'data_travo' => 'required|mimes:csv,xls,xlsx'
          ]);
          
          if ($validator->fails())
        {
          return redirect()->route('travo.index')->withErrors($validator)->withInput();
        }

          Excel::import(new ImportTravo, $request->file('data_travo'));

          return redirect()->back()->with('status','Data Berhasil Di Upload');
      }

      public function export_marker()
      {
        return Excel::download(new ExportMarker, 'travo.xlsx');
      }

      public function import_marker(Request $request)
      {
          $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
          ]);

          if($validator->fails())
          {
            return redirect()->route('Marker.index')->withErrors($validator)->withInput();
          }

          Excel::import(new ImportMarker, request()->file('file'));

          return redirect()->back()->with('status','Data Berhasil Di Upload');
      }

      public function export_lampu()
      {
        return Excel::download(new ExportLampu, 'Lampu.xlsx');
      }

      public function import_lampu(Request $request)
      {
        $input      = $request->all();
        $validator  = Validator::make($input,[
          'data_lampu' => 'required|mimes:csv,xls,xlsx'
        ]);

        if ($validator->fails())
        {
          return redirect()->route('lampu.index')->withErrors($validator)->withInput();
        }
        // dd($request->all());
        Excel::import( new ImportLampu, $request->file('data_lampu'));

        return redirect()->back()->with('status','Data Berhasil Di Upload');

      }

      public function export_panel()
      {
        return Excel::download(new ExportPanel, 'panel.xlsx');
      }

      public function import_panel(Request $request)
      {
          $input = $request->all();
          $validator = Validator::make($input,[
            'data_panel' => 'required|mimes:csv,xls,xlsx'
          ]);

          if ($validator->fails())
        {
          return redirect()->route('panel.index')->withErrors($validator)->withInput();
        }

          Excel::import(new ImportPanel, $request->file('data_panel'));

          return redirect()->back()->with('status','Data Berhasil Di Upload');
      }
}
