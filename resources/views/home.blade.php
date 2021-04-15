@extends('layouts.app')
@section('content')
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter the details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="makingreq">
        @csrf
  <div class="form-group">
    <label for="example">Vehicle Brand/</label>
    <input type="text" name="brand" class="form-control" id="example" aria-describedby="emailHelp" placeholder="Enter car brand">
  </div>
  <div class="form-group">
    <label for="example">Enter your phone no.</label>
    <input type="text" name="phone" class="form-control" id="example" placeholder="Enter phone no.">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="special" class="btn btn-primary">Make A Request</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="container">
  <p style="text-align: center;color:#5891ff;font-style: italic;font-size: 24px">Call for SOS</p>
  <div class="d-flex justify-content-center">
    
   <div class="row"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="text-align: center">Request</button></div></div>
   <div class="d-flex justify-content-center">
   <div class="row pt-4"><button id="ajax-submit" class="btn btn-primary ml-4"> Click for Nearby workshops</button></div></div>
   <div id="demo" class="alert alert-secondary"style="display:none"></div>
   <div id="main">
@if(!empty($cus))
@foreach($cus as $data)
<div class="row">
  <div class="col d-flex justify-content-center">
   <div class="card" style="width:400px">
     <img class="card-img-top" src="{{asset('uploads/customer/'. $data->image)}}" alt="Card image" style="width:100%">
     <div class="card-body">
      
       <div style="text-align: right ;">
        
       <span class="fa fa-star checked"></span>
 <span class="fa fa-star checked"></span>
 <span class="fa fa-star checked"></span>
 <span class="fa fa-star"></span>
 <span class="fa fa-star"></span>
       </div>
 
       <div class="row">
         <div class="col-12" style="color:rgb(193, 192, 255);">
          <p style="color: blueviolet;font-size: 20px">{{$data->name}}</p>
           <p style="color: blueviolet">Working Hours: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data->working}}</p> 
           <p style="color: blueviolet">Contact No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data->Phone}}</p>
           <p style="color: blueviolet">Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data->place}}</p>
           <p style="color: blueviolet">distance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$data->distance}} from your location</p>
         </div>
    </div>
    <div>@if($data->Status == 2)
  <h5><span class="badge badge-primary">Requested</span></h5>
  @elseif($data->Status == 1)
  <h5><span class="badge badge-success">Accepted</span></h5>
  <h5>Confirm?</h5>
  <a href="{{url('confirmyes'.'/'.$data->id)}}" class="btn btn-success">Yes</a>
  <a href="{{url('confirmno'.'/'.$data->id)}}" class="btn btn-primary">No</a>
  @elseif($data->Status == 3)
  <h4><span style="color: blueviolet">Wait for some time they are on their  way</span></h4>
  @endif
  </div>
  </div>
   </div>
   </div>
 </div>
 @endforeach
 @endif
 </div>
   </div>

@endsection
<style>
  .checked {
    color: rgb(251, 255, 0);
    
  }
  </style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{asset('js/script.js')}}" type="text/javascript"></script>

