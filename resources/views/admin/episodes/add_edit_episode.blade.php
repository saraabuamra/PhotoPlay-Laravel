@extends('layouts.admin')

@section('title')
Episode
@endsection

@section('contentheader')
Episode
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Episode</h3>
                            {{-- <h6 class="font-weight-normal mb-0">Update Admin Password</h6> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}</h4>
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error: </strong>{{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success: </strong>{{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form class="forms-sample" @if (empty($episode['id']))action="{{ url('admin/add-edit-episode') }}"
                            @else action="{{ url('admin/add-edit-episode/'.$episode['id']) }}" @endif  method="post" enctype="multipart/form-data">
                            @csrf
                            <br><br>
                            <div class="form-group">
                                <label for="movie_id">Select Movie</label>
                                 <select name="movie_id" id="movie_id" class="form-control text-dark">
                                     <option value="">Select</option>
                                     @foreach ($movies as $movie)
                                 <option @if (!empty($episode['movie_id']==$movie['id']))
                                 selected @endif value="{{$movie['id']}}">{{$movie['name']}}</option>
                                     @endforeach
                                 </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Episode Title</label>
                                <input type="text" class="form-control" id="title"
                                     name="title" placeholder="Enter Episode Title" @if (!empty($episode['title']))
                                     value="{{ $episode['title'] }}" @else value="{{old('episode->title')}}"
                                    @endif >
                            </div>
                            <div class="form-group">
                                <label for="runtime">Episode Runtime</label>
                                <input type="text" class="form-control" id="runtime"
                                     name="runtime" placeholder="Enter Episode Runtime" @if (!empty($episode['runtime']))
                                     value="{{ $episode['runtime'] }}" @else value="{{old('episode->runtime')}}"
                                    @endif >
                            </div>
                            <div class="form-group">
                                <label for="uploade_file">Choose how to upload the video</label>
                                 <select name="uploade_file" id="uploade_file" class="form-control text-dark">
                                     <option value="">Select</option>
                                     <option @if (!empty($episode['external_video']))
                                     selected @endif value="1">External Video By Write Path</option>
                                     <option @if (!empty($episode['video']))
                                     selected @endif value="2">Uploade Your Video</option>
                                 </select>
                            </div>
                            <div class="form-group" id="uploade_video">
                                @if (!empty($episode['video']))
                                <input type="file" class="form-control" id="video"
                                 name="video" value="{{$episode['video']}}">
                                     @else
                                     <input type="hidden" class="form-control" id="video"
                                     name="video">
                                @endif
                                 @if (!empty($episode['video']))
                                 <br>
                                     <a target="_blank" href="{{url('admin/videos/movie_videos/'.$episode['video'])}}">View Video</a>
                                    | &numsp;&numsp;
                                    <a href="javascript:void(0)" module="episode-video" class="confirmDelete" moduleid="{{$episode['id']}}"
                                    style="text-decoration: none;background-color:#147bf0;
                                     color:white; padding:8px;border-radius:10px">Delete Video</a>
                                 @endif
                            </div>
                            <div class="form-group" id="write_path">
                                @if (!empty($episode['external_video']))
                                <input type="text" class="form-control" id="write_path"
                                     name="write_path" placeholder="Enter Episode write path" value="{{$episode['external_video']}}">
                                     @else
                                     <input type="hidden" class="form-control" id="write_path"
                                     name="write_path" placeholder="Enter Episode write path"> 
                                @endif
                            </div>
                            <br>
                            <button  type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{url('admin/episodes')}}" type="reset" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('contentheaderlink')
<a href="{{url('admin/add-edit-episode/').$episode['id']}}">Episode</a>
@endsection

@section('contentheaderactive')
view
@endsection
