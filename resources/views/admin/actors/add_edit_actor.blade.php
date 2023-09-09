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
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            {{-- <h3 class="font-weight-bold">Products</h3> --}}
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
                        <form class="forms-sample" @if(empty($actor['id']))action="{{ url('admin/add-edit-actor')}}"
                            @else action="{{ url('admin/add-edit-actor/'.$actor['id']) }}" @endif  method="post" enctype="multipart/form-data">
                            @csrf
                            <br><br>
                            <div class="form-group">
                                <label for="firstname">actor First Name</label>
                                <input type="text" class="form-control" id="firstname"
                                     name="firstname" placeholder="Enter actor First Name" @if (isset($actor['firstname']))
                                     value="{{$actor['firstname']}}" @else value="{{old('firstname')}}"
                                    @endif required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">actor Last Name</label>
                                <input type="text" class="form-control" id="lastname"
                                     name="lastname" placeholder="Enter actor Last Name" @if (isset($actor['lastname']))
                                     value="{{$actor['lastname']}}" @else value="{{old('lastname')}}"
                                    @endif required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="movies">Select Movies</label>
                                 <select name="movies[]" id="movies" multiple class="form-control text-dark" required>
                                     <option value="">Select</option>
                                     @if(!empty($movies) && is_array($movies))
                                     @foreach ($movies as $movie)
                                     @if(isset($movie['id']) && !empty($movie['id']))
                                 <option selected value="{{$movie['id']}}">{{$movie['name']}}</option>
                                     @endif
                                     @endforeach
                                     @endif
                                 </select>
                            </div> --}}
                            <div class="form-group">
                                <label>Select Movies</label>
                                @if(!empty($movies) && is_array($movies))
                                    @foreach ($movies as $movie)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input movie-checkbox" id="movie{{$movie['id']}}" name="movies[]"
                                                   value="{{$movie['id']}}" @if(in_array($movie['id'], $selectedMovies)) checked @endif>
                                            <label class="form-check-label" for="movie{{$movie['id']}}">{{$movie['name']}}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="biography">actor Biography</label>
                                <textarea name="biography" class="form-control" id="biography" rows="3">{{$actor['biography']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Actor Image</label>
                                <input type="file" class="form-control" id="image"
                                 name="image">
                                 @if (!empty($actor['image']))
                                 <br>
                                     <img  src="{{url('admin/images/actor_images/'.$actor['image'])}}" width="100px" height="100px"/>
                                    | &numsp;&numsp;
                                    <a href="javascript:void(0)" module="movie-image" class="confirmDelete" moduleid="{{$actor['id']}}"
                                    style="text-decoration: none;background-color:#147bf0;
                                     color:white; padding:8px;border-radius:10px">Delete Image</a>
                                 @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('contentheaderlink')
    <a href="{{ url('admin/add-edit-actor/'.$actor['id']) }}">actors</a>
@endsection

@section('contentheaderactive')
view
@endsection    
