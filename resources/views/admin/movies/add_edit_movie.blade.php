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
                        <form class="forms-sample" @if(empty($movie['id']))action="{{ url('admin/add-edit-movie')}}"
                            @else action="{{ url('admin/add-edit-movie/'.$movie['id']) }}" @endif  method="post" enctype="multipart/form-data">
                            @csrf
                            <br><br>
                            <div class="form-group">
                                <label for="name">movie Name</label>
                                <input type="text" class="form-control" id="name"
                                     name="name" placeholder="Enter movie Name" @if (isset($movie['name']))
                                     value="{{$movie['name']}}" @else value="{{old('name')}}"
                                    @endif required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="sections">Select Section</label>
                                 <select name="sections[]" id="sections" multiple class="form-control text-dark" required>
                                     <option value="">Select</option>
                                     @if(!empty($sections) && is_array($sections))
                                     @foreach ($sections as $section)
                                     @if(isset($section['id']) && !empty($section['id']))
                                 <option @if(in_array($section['id'], $selectedSections)) selected @endif value="{{$section['id']}}">{{$section['name']}}</option>
                                     @endif
                                     @endforeach
                                     @endif
                                 </select>
                            </div> --}}
                            <div class="form-group">
                                <label>Select Sections</label>
                                @if(!empty($sections) && is_array($sections))
                                    @foreach ($sections as $section)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input section-checkbox" id="section{{$section['id']}}" name="sections[]"
                                                   value="{{$section['id']}}" @if(in_array($section['id'], $selectedSections)) checked @endif>
                                            <label class="form-check-label" for="section{{$section['id']}}">{{$section['name']}}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">movie Discription</label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{$movie['description']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Movie Image</label>
                                <input type="file" class="form-control" id="image"
                                 name="image">
                                 @if (!empty($movie['image']))
                                 <br>
                                     <img  src="{{url('admin/images/movie_images/'.$movie['image'])}}" width="100px" height="100px"/>
                                    | &numsp;&numsp;
                                    <a href="javascript:void(0)" module="movie-image" class="confirmDelete" moduleid="{{$movie['id']}}"
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
    <a href="{{ url('admin/add-edit-movie/'.$movie['id']) }}">movies</a>
@endsection

@section('contentheaderactive')
view
@endsection    


