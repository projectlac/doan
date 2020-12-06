<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class JsonController extends Controller
{
  public function index() {
    $json = DB::table('json')->get();
    $data = [];
    foreach ($json as $value) {
      $jsonString = file_get_contents(base_path('public/json/' . $value->path));
      $data[] = json_decode($jsonString, true);
    }
    return view('admin.index', ['data' => $data]);
  }
}
