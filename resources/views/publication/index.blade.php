
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('All Publications') }}
                    <a class="btn btn-small btn-primary float-right" href="{{ URL::to('publication/create') }}">Create</a>

                </div>

                <div class="card-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="container">
                    @foreach($publications as $key => $value)
                        <div>
                            <!-- Title -->
                            <h1 class="mt-4">{{ $value->title }}</h1>
                            <p class="lead">by {{ $value->user->name }}</p>
                            <hr>
                            <p>Posted on  {{ $value->created_at }}</p>
                            <p class="lead">{{ $value->content }}</p>
                            <a class="btn btn-small btn-primary" href="{{ URL::to('publication/' . $value->id) }}">Show</a>
                            <a class="btn btn-small btn-warning" href="{{ URL::to('publication/' . $value->id . '/edit') }}">Edit</a>
                            <a class="btn btn-small btn-danger delete_post" data-toggle="modal" data-target="#deleteModal" data-id="{{ $value->id }}">Edit</a>
                            <hr>

                        </div>
                    @endforeach

                    @if (count($publications) == 0)
                        <p class="text-center"> No Comments </p>
                    @endif
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> Are you sure? </p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="confirm_delete btn btn-danger">Confirm</button>
      </div>
    </div>
  </div>
</div>
@endsection