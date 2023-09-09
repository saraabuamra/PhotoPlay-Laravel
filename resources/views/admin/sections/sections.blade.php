@extends('layouts.admin')

@section('title')
Section
@endsection

@section('contentheader')
    Sections
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card" style="margin-right: 30%">
            <div class="card-body">
              <h4 class="card-title">Sections</h4>
              <a style="float: right; width:150px" class="btn btn-primary" href="{{url('admin/add-edit-section')}}">Add Section</a>
              @if (Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success: </strong>{{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif
              <div class="table-responsive pt-3">
                <table id="sections" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                         ID
                      </th>
                      <th>
                         Name
                      </th>
                      <th>
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sections as $section )
                    <tr>
                      <td>
                        {{$section['id']}}
                      </td>
                      <td>
                        {{$section['name']}}
                      </td>
                      <td>
                       <a href="{{url('admin/add-edit-section/'.$section['id'])}}">
                        <i style="font-size: 25px ;" 
                        class="icon-nav fas fa-edit"></i> </a>&numsp;
                            <a href="javascript:void(0)" module="section" class="confirmDelete" moduleid="{{$section['id']}}">
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
    <a href="{{url('admin/sections')}}">Sections</a>
@endsection

@section('contentheaderactive')
view
@endsection