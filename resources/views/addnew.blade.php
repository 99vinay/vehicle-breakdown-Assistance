@extends('layout')
<script>

function getLocation() {
  var x = document.getElementById("demo");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var x = document.getElementById("demo");
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}
</script>
<h3 style="text-align: center;color:rgb(25, 0, 255)">Workshop registration Form</h3>
<div class="container">
<form action = "savenew" method = "post" enctype="multipart/form-data">
 @csrf
 <div class="col-sm-5">
 <div class="form-group" >
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group" >
    <label for="exampleInputEmail1">Email</label>
    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>

  <div class="form-group" >
    <label for="exampleInputEmail1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group" >
    <label for="exampleInputEmail1">Enter Name of place</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Location</label>
    <input type="text"name="place" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Latitude</label>
    <input type="text"name="latitude" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Longitude</label>
    <input type="text"name="longitude" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Phone no</label>
    <input type="text"name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Working Hours</label>
    <input type="text"name="working" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="input-group">
  <div class="custom-file">
    <input type="file" class="custom-file-input" name="image" id="customFile">
    <label class="custom-file-label" for="customFile">Upload Image</label>
  </div>
  </div>
  <br>
  <div align="center">
  <button type="submit" class="btn btn-primary">Save</button>
  </div>
  </div>
</form>
<div align="center" class="form-group">
    <label for="exampleInputEmail1">Click the button to get your coordinates</label>
    <button class="btn btn-primary" onclick="getLocation()">Get</button>
    <p id="demo"></p>

  </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>