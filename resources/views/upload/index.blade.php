@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="" action="" method="post">
                  <div class="form-group custom-upload">
                    <label for="exampleFormControlFile1"><i class="fa fa-upload" aria-hidden="true"></i> Bấm để thêm file</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    <br>

                    <button type="submit" class="btn btn-danger">Upload</button>
                    <p style="color:#d33; margin:0"> *File có định dạng .mp3</p>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
