@extends('layouts.admin')

@section('title')
Actors
@endsection

@section('contentheader')
Actors
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card" style="position: relative;right:10%">
            <div class="card-body">
              <h4 class="card-title">Actors</h4>
              <a style="float: right; width:150px" class="btn btn-primary" href="{{url('admin/add-edit-actor')}}">Add Actor</a>
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
                        First Name
                      </th>
                      <th>
                        Last Name
                      </th>
                      <th>
                        Biography
                      </th>
                      <th>
                        Actor Image
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Movies
                      </th>
                      <th>
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($actors as $actor)
                    <tr>
                      <td>
                        {{$actor['id']}}
                      </td>
                      <td>
                        {{$actor['firstname']}}
                      </td>
                      <td>
                        {{$actor['lastname']}}
                      </td>
                      <td style="width:100px">
                        {{$actor['biography']}}
                      </td>
                      <td>
                        @if(!empty($actor['image']))
                        <img style="height: 120px;width:120px" src="{{asset('admin/images/actor_images/'.$actor['image'])}}">
                        @else
                        <img style="height: 120px;width:120px" src="{{asset('admin/images/actor_images/no-image.png')}}">
                      @endif
                      </td>
                      <td>
                        @if($actor['status']==1)
                        <a class="updateActorStatus" id="actor-{{$actor['id']}}" actor_id="{{$actor['id']}}"
                         href="javascript:void(0)"> 
                          <i style="font-size: 25px;" class="icon-nav fas fa-unlock" status="Active"></i> 
                        </a>
                        @else
                        <a class="updateActorStatus" id="actor-{{$actor['id']}}" actor_id="{{$actor['id']}}"
                         href="javascript:void(0)"> 
                        <i style="font-size: 25px;" class="icon-nav fas fa-lock" status="Inactive"></i></a>
                        @endif
                      </td>
                      <td style="width:100px">
                        @foreach($actor['movies'] as $movie)
                        {{$movie['id']}}- {{$movie['name']}}<br><br>
                        @endforeach
                      </td>
                      <td style="width:50%">
                       <a title="Add/Edit Actor" href="{{url('admin/add-edit-actor/'.$actor['id'])}}">
                        <i style="font-size: 25px ;" 
                        class="icon-nav fas fa-edit"></i> </a>

                            <a href="javascript:void(0)" module="actor" class="confirmDelete" moduleid="{{$actor['id']}}">
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
