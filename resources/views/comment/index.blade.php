
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('List of Publications with Hola Comments') }}
                    <a class="btn btn-small btn-primary float-right" href="{{ URL::to('publication/create') }}">Create</a>

                </div>

                <div class="card-body">

                    <div class="container">
                    @foreach($publications as $key => $value)
                        <div>
                            <!-- Title -->
                            <h1 class="mt-4">{{ $value->title }}</h1>
                            <p class="lead">by {{ $value->name }}</p>
                            <hr>
                            <p>Posted on  {{ $value->created_at }}</p>
                            <p class="lead">{{ $value->content }}</p>
                            <a class="btn btn-small btn-primary" href="{{ URL::to('publication/' . $value->id) }}">Show</a>
                            <hr>
                        </div>
                    @endforeach
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection