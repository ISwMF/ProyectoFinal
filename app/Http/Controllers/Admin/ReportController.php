<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Report as ReportResource;
use App\Report;

class ReportController extends Controller {

    public function index() {
        //
    }

    public function store(Request $request) {
      $report = new Report;
      $report->id_user = $request->id_user;
      $report->title = $request->title;
      $report->URL = $request->URL;
      $report->description = $request->description;
      $report->save();
      return $report;
    }

    public function show($id) {
      return new ReportResource(Report::find($id));
    }

    public function update(Request $request, $id) {
      $report = Report::find($id);
      $report->title = $request->title;
      $report->URL = $request->URL;
      $report->description = $request->description;
      $report->save();
      return $report;
    }

    public function destroy($id) {
      Report::destroy($id);
      return response()->json([
        'sucess' => 'Destroyed'
      ]);
    }
}
