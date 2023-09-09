@extends('layouts.admin')

@section('title')
Episodes
@endsection

@section('contentheader')
Episodes
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card" style="position: relative;right:10%">
            <div class="card-body">
              <h4 class="card-title">Episodes</h4>
              <a style="float: right; width:150px" class="btn btn-primary" href="{{url('admin/add-edit-episode')}}">Add Episode</a>
              @if (Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success: </strong>{{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
               @endif
               <div class="table-responsive pt-3">
              <table id="episodes" class="table table-bordered">
                <thead>
                  <tr>
                      <th>
                         ID
                      </th>
                      <th>
                        Movie Name
                     </th>
                      <th>
                         Title
                      </th>
                      <th>
                        External Video
                     </th>
                     <th>
                        Video
                     </th>
                     <th>
                      Runtime
                     </th>
                    <th>
                    Status
                    </th>
                    <th>
                    Actions
                    </th>
                 </tr>
                </thead>
                  <tbody>
                    @foreach ($episodes as $episode)
                    <tr>
                      <td>
                        {{$episode['id']}}
                      </td>
                      <td>
                        {{$episode['movie']['name']}}
                      </td>
                      <td>
                        {{$episode['title']}}
                      </td>
                      <td>
                        @if(!empty($episode['external_video']))
                        <a target="_blank" href="{{$episode['external_video']}}">View Video</a>
                        @else
                        =========
                        @endif
                      </td>
                      <td>
                        @if (!empty($episode['video']))
                                    <a target="_blank" href="{{url('admin/videos/movie_videos/'.$episode['video'])}}">View Video</a>
                                   | &numsp;&numsp;
                                   <a href="javascript:void(0)" module="episode-video" class="confirmDelete" moduleid="{{$episode['id']}}"
                                   style="text-decoration: none;background-color:#147bf0;
                                    color:white; padding:8px;border-radius:10px">Delete Video</a>
                                    @else
                                    ========
                                @endif
                      </td>
                      <td>
                        {{$episode['runtime']}}
                      </td>
                      <td>
                        @if ($episode['status']==1)
                                <a class="updateEpisodeStatus" id="episode-{{$episode['id']}}" episode_id="{{$episode['id']}}"
                                 href="javascript:void(0)"> 
                                  <i style="font-size: 25px;" class="icon-nav fas fa-unlock" status="Active"></i> 
                                </a>
                               
                                @else
                                <a class="updateEpisodeStatus" id="episode-{{$episode['id']}}" episode_id="{{$episode['id']}}"
                                 href="javascript:void(0)"> 
                                <i style="font-size: 25px;" class="icon-nav fas fa-lock" status="Inactive"></i></a>
                                    @endif
                      </td>
                      <td>
                        <a title="Add/Edit Episode" href="{{url('admin/add-edit-episode/'.$episode['id'])}}">
                         <i style="font-size: 25px ;" 
                         class="icon-nav fas fa-edit"></i> </a>
 
                             <a href="javascript:void(0)" module="episode" class="confirmDelete" moduleid="{{$episode['id']}}">
                                 <i style="font-size: 25px ;"
                                 class="icon-nav fas fa-trash"></i> </a>
                       </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>      
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>
@endsection

@section('contentheaderlink')
    <a href="{{url('admin/episodes')}}">Episode</a>
@endsection

@section('contentheaderactive')
view
@endsection
