@extends('layouts.admin')

@section('title')
Movies
@endsection

@section('contentheader')
Movies
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card" style="position: relative;right:10%">
            <div class="card-body">
              <h4 class="card-title">Movies</h4>
              <a style="float: right; width:150px" class="btn btn-primary" href="{{url('admin/add-edit-movie')}}">Add Movie</a>
              @if (Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success: </strong>{{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif
              <div class="table-responsive pt-3">
                <table id="movies" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                         ID
                      </th>
                      <th>
                        Movie Name
                      </th>
                      <th>
                        Movie description
                      </th>
                      <th>
                        Movie Image
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Sections
                      </th>
                      <th>
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                      <td>
                        {{$movie['id']}}
                      </td>
                      <td>
                        {{$movie['name']}}
                      </td>
                      <td>
                        {{$movie['description']}}
                      </td>
                      <td>
                        @if(!empty($movie['image']))
                        <img style="height: 120px;width:120px" src="{{asset('admin/images/movie_images/'.$movie['image'])}}">
                        @else
                        <img style="height: 120px;width:120px" src="{{asset('admin/images/movie_images/no-image.png')}}">
                      @endif
                      </td>
                      <td>
                        @if($movie['status']==1)
                        <a class="updateMovieStatus" id="movie-{{$movie['id']}}" movie_id="{{$movie['id']}}"
                         href="javascript:void(0)"> 
                          <i style="font-size: 25px;" class="icon-nav fas fa-unlock" status="Active"></i> 
                        </a>
                        @else
                        <a class="updateMovieStatus" id="movie-{{$movie['id']}}" movie_id="{{$movie['id']}}"
                         href="javascript:void(0)"> 
                        <i style="font-size: 25px;" class="icon-nav fas fa-lock" status="Inactive"></i></a>
                        @endif
                      </td>
                      <td>
                        @foreach($movie['sections'] as $section)
                        {{$section['name']}}<br>
                        @endforeach
                      </td>
                      <td style="width:50%">
                       <a title="Add/Edit Movie" href="{{url('admin/add-edit-movie/'.$movie['id'])}}">
                        <i style="font-size: 25px ;" 
                        class="icon-nav fas fa-edit"></i> </a>

                            <a href="javascript:void(0)" module="movie" class="confirmDelete" moduleid="{{$movie['id']}}">
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
    <a href="{{url('admin/movies')}}">Movies</a>
@endsection

@section('contentheaderactive')
view
@endsection
