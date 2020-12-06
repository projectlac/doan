<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Repositories\JsonRepository;
use App\Models\Json;

class AgentsController extends Controller
{
  protected $jsonReository;

  public function __construct(JsonRepository $jsonReository)
  {
    $this->jsonReository = $jsonReository;
  }

  public function index(Request $request)
  {
    $data = $this->jsonReository->getDataJson($request->all());
    $agent = DB::table('agents')->get();
    $keywords = DB::table('keywords')->get();
    $noidung = DB::table('subjects')->get();

    return view('admin.index', compact('agent', 'data','keywords','noidung'));
  }

  public function getChart()
  {
      $data = $this->jsonReository->getDataJson();
      $dataCount = [];
      $countAgent = [];
      $agent = DB::table('agents')->get();
      foreach (Json::EMOTION_TEXT as $key => $value) {
          $dataCount[$key] = 0;
      }

      foreach ($data as $row) {
        foreach (Json::EMOTION_TEXT as $key => $value) {
          if ($row[0]['emotion_score'] == $key)
          {
              $dataCount[$key]++;
          }
        }
        // dd($row);
      }
      // foreach ($agent as $item => $v) {
      //    $countAgent[$item] = 0;
      // }
      // foreach ($data as $row) {
      //   foreach ($agent as $item => $v) {
      //
      //
      //
      //   }
      //
      // }
      return view('thongke.index', compact('dataCount'));
  }


}
