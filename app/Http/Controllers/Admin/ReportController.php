<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Resources\Report as ReportResource;
use App\Http\Controllers\Controller;
use App\report;

class ReportController extends Controller {

    public function index() {
      $reports = report::all();
      return $reports;
    }

    public function store(Request $request) {
      $report = new report;
      $report->id_user = $request->id_user;
      $report->title = $request->title;
      $report->URL = $request->link;
      $report->description = $request->description;
      $report->save();
      return response()->json([
        'sucess' => 'Created news'
      ]);
    }

    public function show($id) {
      $report = report::find($id);
      return $report;
      //return new ReportResource(Report::find($id));
    }

    public function update(Request $request, $id) {
      $report = report::find($id);
      $report->title = $request->title;
      $report->URL = $request->link;
      $report->description = $request->description;
      $report->save();
      return response()->json([
        'sucess' => 'Updated news'
      ]);
    }

    public function destroy($id) {
      report::destroy($id);
      return response()->json([
        'sucess' => 'Destroyed'
      ]);
    }
}
