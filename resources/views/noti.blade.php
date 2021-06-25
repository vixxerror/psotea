@extends('layouts.app')

@section('content')
 <table class = "table">
   <thead>
     <tr>
       <th scope="col">fecha</th>
       <th scope="col">Mensaje</th>
     </tr>
   </thead>
      @foreach($noti as $NOTI)
       <tr>
         <th>{{$NOTI -> created_at}}</th>
         <th>{{$NOTI -> data['user']}}</th>
       </tr>

       @php
         $NOTI->markAsRead();
       @endphp
     @endforeach
    </tbody>
 </table>


@endsection