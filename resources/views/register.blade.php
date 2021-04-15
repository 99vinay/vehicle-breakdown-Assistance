@extends('layout')
<div class="col-sm-5 offset-md-3">
<form action = "regcustomer" method = "post" >
 @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">User</label>
    <input type="text" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <label for="exampleInput">Password</label>
    <input type="password"name="password" class="form-control" id="exampleInput" aria-describedby="emailHelp" >

  </div>
  <button type="submit" class="btn btn-primary">Enter</button>
</form>
</div>