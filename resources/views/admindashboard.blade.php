@extends('layout')
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Vehicle BreakDown Assistance</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="#">{{$name}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/adminlogout">log out</a>
      </li>    
    </ul>
  </div>  
</nav>

<div id="mainwork" style="background-color:blueviolet;">
<div class="container" >
@if(!empty($items))
@foreach($items as $data)
   <div class="card mt-3">
  <div class="card-header">
    <h4>Request From {{$data->username}}</h4>
  </div>
  <div class="card-body">
    <h5 class="card-title"><span class="font-weight-bold font-italic" style="display:inline-block; width:70px ;text-align:left" >Brand/Car</span>{{$data->brand}}</h5>
    @if($data->Status == 1)
    <h4><span>Waiting for confirmation</span></h4>
    @elseif($data->Status == 2)
    <a href="{{url('accept'.'/'.$data->id)}}" class="btn btn-success">Accept</a>
    <a href="{{url('deny'.'/'.$data->id)}}" class="btn btn-primary">Deny</a>
    @elseif($data->Status == 3)
    <h4 align="right"><span  class="badge badge-success">Confirmed</span></h4>
    <h5 class="card-title"><span class="font-weight-bold font-italic" style="display:inline-block; width:70px;text-align:left" >Phone no.</span>{{$data->phone}}</h5>
    <a href="{{url('getdirect'.'/'.$data->Latitude.'/'.$data->Longitude)}}" class="btn btn-primary">Get Directions</a>
    @endif
  </div>
 </div>
 @endforeach
 @endif
 </div>
 </div>
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  
    <script>
   $(document).ready(function(){
       setInterval(function(){
          $.ajax({
             url:'/admindashboard',
             type:'GET',
             success: function(result){
              data = $(result).filter('#mainwork');
             
             
              $('#mainwork').replaceWith(data);
             }
          });
       }, 3000);
   });
</script>
