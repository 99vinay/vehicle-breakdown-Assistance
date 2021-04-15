@extends('layout');

<div>
<table>
<tr>
<td>
<a href="/addemp"  class="btn btn-primary">Add Employee</a>
</td>
<td>
<a href="/ad_logout" class="btn btn-primary">Logout</a>
</td>
</tr>
</table>
<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Place</th>
      <th scope="col">Phone No.</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  @foreach($cus as $data)
    <tr>
      <th scope="row">{{$loop->index + 1}}</th>
      <td>{{$data->name}}</td>
      <td>{{$data->Place}}</td>
      <td>{{$data->Phone}}</td>
      @if($data->Status == 1)
      <td>Paid</td>
      @else
      <td>Due</td>
      @endif
      <td><a class="btn btn-primary" href="{{url('changest'.'/'.$data->id)}}">Pay</a></td>
      <td>
      <a href="{{url('ad_delete'.'/'.$data->id)}}" class="fa fa-trash"></a>
      &nbsp; &nbsp;
      <a href="{{url('ad_edit'.'/'.$data->id)}}" class="fa fa-edit"></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>


