@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">List JSON</div> -->
                <div class="col-md-12">
                  <form class="" action="{{ route('admin.index') }}" method="get">
                    @csrf
                    <div class="form-group col-md-3">
                      <label for="exampleFormControlSelect1">Điện thoại viên</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="agent_name">
                        <option value="">Tất cả</option>
                        @foreach($agent as $key)

                        <option value="{{ $key->name }}" @if(request('agent_name') == $key->name) selected @endif> {{ $key->name }}</option>

                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleFormControlSelect1">Mã cuộc gọi</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="call_id">
                        <option value="">Tất cả</option>
                        @foreach($data as $items)
                          <!-- @foreach($items as $key) -->
                              <option value="{{ $items["agent_id"] }}" @if(request('call_id') == $items["agent_id"]) selected @endif>{{ $items["agent_id"] }}</option>

                          <!-- @endforeach -->
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleFormControlSelect1">Từ khóa</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="key">
                        <option value="">Tất cả</option>
                        @foreach($keywords as $key)

                        <option value="{{ $key->keyword }}" @if(request('key') == $key->keyword) selected @endif> {{ $key->keyword }}</option>

                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleFormControlSelect1">Thời gian</label>
                      <div class="input-group input-daterange">
                          <input type="date" class="form-control"  name="start_date">
                          <div style="clear:both"></div>
                          <div class="input-group-addon">to</div>
                          <div style="clear:both"></div>
                          <input type="date" class="form-control"  name="end_date">
                      </div>
                      <!-- <select class="form-control" id="exampleFormControlSelect1" name="call_content">
                        <option value="">Tất cả</option>
                        @foreach($noidung as $key)

                        <option value="{{ $key->name }}"> {{ $key->name }}</option>

                        @endforeach
                      </select> -->
                    </div>
                    <div class="" style="clear:both">

                    </div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">In kết quả</button>
                  </form>

                </div>
                <div class="card-body">
                  <table class="table" id="myTable">
                    <thead style="text-align:center">
                      <tr>
                        <th>STT</th>
                        <th>Điện Thoại Viên</th>
                        <th>Mã Cuộc Gọi</th>
                        <th>Số điện thoại</th>
                        <th>Cảm xúc</th>

                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Chi tiết</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $dem = 0; ?>
                      @foreach($data as $key)
                        <?php $dem++; ?>


                          <tr style="text-align:center">
                            <td>{{ $dem }}</td>
                            <td>{{ $key["agent_name"] }}</td>
                            <td>{{ $key["agent_id"] }}</td>
                            <td>0{{ $key["phone_number"] }}</td>
                            <td>{{ \App\Models\Json::EMOTION_TEXT[$key["emotion_score"]] }}</td>

                            <td>{{date("Y-m-d H:i:s",$key["start_time"])}}</td>
                            <td>{{date("Y-m-d H:i:s",$key["stop_time"])}}</td>
                            <td><p style="cursor: pointer" data-toggle="modal" data-target="#myModal{{ $key["agent_id"] }}">Chi tiết</p></td>
                          </tr>


                      @endforeach


                    </tbody>
                  </table>

                </div>
            <!-- </div> -->
            @foreach($data as $key)

                    <div id="myModal{{ $key["agent_id"] }}" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <div style="clear:both">

                            </div>
                            <h4 class="modal-title">Nội dung cuộc gọi</h4>
                              <audio controls id="sound">

                                <source src="sounds/sound.wav" type="audio/wav">

                              </audio>
                          </div>
                          <div class="modal-body">
                            @foreach($key["transcript"] as $chat)
                                @if($chat["channel"] == "AGENT")
                                  <div class="agent">
                                    <p>Điện thoại viên - <span>{{date("i:s",$chat["start_time"])}}</span> </p>
                                    <p class="noidung" onclick="alpha({{$chat['start_time']}},{{$chat['stop_time']}})">{{$chat["text"]}}</p>
                                  </div>
                                  <div style="clear:both">

                                  </div>
                                @endif
                                @if($chat["channel"] == "CTM")
                                  <div class="ctm">
                                    <p>Khách hàng - <span>{{date("i:s",$chat["start_time"])}}</span></p>
                                    <p class="noidung" onclick="alpha({{$chat['start_time']}},{{$chat['stop_time']}})">{{$chat["text"]}}</p>
                                  </div>
                                  <div style="clear:both">

                                  </div>
                                @endif
                            @endforeach
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

            @endforeach

        </div>
    </div>
</div>
<script type="text/javascript">
  function alpha(start_time, stop_time){
    let aud = document.getElementById("sound");
      aud.currentTime = start_time;
      aud.play();
        let delta =(stop_time - start_time)
      setTimeout(function(){
        aud.pause();
      }, 2000);

  }
  // $('.input-daterange input').each(function() {
  //     $(this).datepicker('clearDates');
  // });
</script>
@endsection
