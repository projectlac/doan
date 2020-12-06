<?php

namespace App\Http\Repositories;
use DB;

class JsonRepository
{
  public function getDataJson($condition = [])
  {
    $json = DB::table('json')->get();
    $data = [];
    foreach ($json as $value) {
      $jsonString = file_get_contents(base_path('public/json/' . $value->path));
      $data_json = json_decode($jsonString, true);
      // if(!empty($condition)) {
      //   if ($condition['agent_name'] != '' && $data_json[0]['agent_name'] == $condition['agent_name']) {
      //     if ($condition['key'] != '') {
      //       foreach ($data_json[0]['transcript'] as $transcript) {
      //         if (strpos($transcript['text'], $condition['key']) > 0) {
      //           $data[] = $data_json;
      //         }
      //       }
      //     }
      //     // $data[] = $data_json;
      //   }
      //   else {
      //     if ($condition['key'] != '') {
      //       foreach ($data_json[0]['transcript'] as $transcript) {
      //         if (strpos($transcript['text'], $condition['key']) > 0) {
      //           $data[] = $data_json;
      //         }
      //       }
      //     }
      //   }
      //
      //   // if ($condition['call_id'] != '' && $data_json[0]['agent_id'] == $condition['call_id']) {
      //   //   $data[] = $data_json;
      //   // }
      //   // else {
      //   //   $data[] = $data_json;
      //   // }
      //
      // } else {
      //   $data[] = $data_json;
      // }
      $data[] = $data_json[0];
    }
    // dd($data);

    $collection = collect($data);
     if(!empty($condition)) {
       $data = $collection;
       if ($condition['agent_name'] !='') {
         $data = $collection->where('agent_name', $condition['agent_name']);
       }
       if ($condition['call_id'] !='') {
          $data = $collection->where('agent_id', $condition['call_id']);
        }
        // dd($data);
         if ($condition['key'] !='') {
           foreach ($data as $key => $value) {
             $has = 0;
             foreach ($value['transcript'] as $transcript) {
                     if (strpos($transcript['text'], $condition['key']) > 0)
                     {
                       $has = 1;
                     }
                   }
                   if ($has == 0) {
                     $data->forget($key);
                   }
           }
          }
          $start = strtotime($condition['start_date']);
          $end = strtotime($condition['end_date']);
          $now = strtotime(date_create()->format('Y-m-d'));
          // dd($now);
          if($start !='' && $end ="false"){
            $data = $collection->whereBetween('start_time', [$start, $now]);
          }

          // if($start ="false" && $end =""){
          //   $data = $collection->whereBetween('stop_time', [0, $end]);
          // }

          // dd(1);
     }

    // if ($condition['agent_name'] !='') {
      // $filtered = $collection->where('agent_name', 'Tran Thi Thanh Liem');
    // }
    // $filtered = $collection->where('agent_name', 'Tran Thi Thanh Liem');
    // dd($filtered);
    // dd($data);
    return $data;
  }

}
