@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Publication') }}
                <a class="btn btn-small btn-primary float-right" href="{{ URL::to('publication') }}">Back</a>

                </div>

                <div class="card-body">
                    <div class="container">
                        <div>
                            <!-- Title -->
                            <h1 class="mt-4">{{ $publication->title }}</h1>
                            <hr>
                            <!-- Date/Time -->
                            <p>Posted on  {{ $publication->created_at }}</p>
                            <!-- Post Content -->
                            <p class="lead">{{ $publication->content }}</p>
                        </div>
                    </div>    
                </div>
            </div>

            <hr>

            <div class="card border-primary">
                <div class="card-header">{{ __('Comments') }}</div>

                <div class="card-body">
                    <div class="container">
                        @if (!$hasCommented)
                        <form method="POST" action="{{ route('comment.store', ['publication' => $publication]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="Content" class="form-label">{{ __('Make a comment') }}</label>
                                <div>
                                    <textarea id="Content" maxlength="200" class="form-control @error('title') is-invalid @enderror" name="content" required autofocus> </textarea>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                
                        <hr>
                        <div class="list-group">

                                
                            @foreach ($publication->comments as $value)
                                <a class="list-group-item list-group-item-action" aria-current="true">
                                    <div class="">
                                        <small>User: {{ $value->user->name }} - Created: {{ $value->created_at }}</small>
                                    </div>
                                    <p class="mb-1">{{ $value->content }}</p>
                                </a>
                            @endforeach

                            @if (count($publication->comments) == 0)
                                <p class="text-center"> No Comments </p>
                            @endif
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
