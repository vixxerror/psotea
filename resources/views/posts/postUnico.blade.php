@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-md-center">
        <div class = "col-md-8">
            <div class="card">
                <img src="{{ Storage::url($post->image)}}" alt="..." class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$post->title}}
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{$post->created_at->toFormattedDateString()}}
                    </h6>
                    <p class="card-text">
                        {{$post->content}}
                    </p>
                    <a href="{{url('/posts')}}" class='card-link'>
                    todas las publicaciones
                    </a>
                </div>
            </div>
            @auth
            <form action="{{url('/comments?post_id='.$post->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-8 col-form-label" for="content">
                        {{__('Comment')}}
                    </label>
                    <div class="col-md-8">
                        <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="3">{{ old('content') }}</textarea>
                        @error('content')
                        <span class="inavlid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <button class="btn btn-primary">
                            {{__('Create')}}
                        </button>
                    </div>
                </div>
            </form>
                
            @else
            <div class="alert alert-secundary" role="alert">
                <p>
                    Si desea comentar <a href="{{url('/login')}}">inicia sesion</a> o <a href="{{'register'}}">registrate</a>
                </p>
            </div>
            @endauth
            @forelse ($post->comments as $comment)
            <div class="card">
                <div class="card-body">
                    <h5 class="card title">
                        {{$comment->user->name}}
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{$comment->created_at->toFormattedDateString()}}
                    </h6>
                    <p class="card-text">
                        {{$comment->content}}
                    </p>

                </div>
            </div>
            @empty
            
            <p>No hay comentarios para esta publicacion, se el primero</p>
            @endforelse
         
         
     
        </div>
    </div>
 
</div>
@endsection