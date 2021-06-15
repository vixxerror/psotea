@extends('layouts.app')

@section('title', "Crear usuario")

@section('content')
    <center><h1>Editar usuario</h1></center>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corrige los errores debajo:</h6>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
 
        @foreach($posts as $user)
        
    <form action="{{ url('/users',$user) }}" method="post"  enctype="multipart/form-data">
    @csrf
            
        {{ csrf_field() }}
        <center><label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $user->name) }}">
        <br>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email', $user->email) }}">
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Mayor a 6 caracteres">
        <br>

              <button  class="btn btn-dark" type="submit">editar</button>     
              </center>  
              <br>
 
   
        @endforeach
        
    </form>
    <center>
    <form action="{{route('user.delete',$user->id)}}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('delete')
              <button  class="btn btn-dark" type="submit">Eliminar</button>
             
    </form> 
    </center>  
@endsection