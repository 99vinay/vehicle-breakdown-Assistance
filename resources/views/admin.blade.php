<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshop login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/form.css')}}">
</head>
<body>
    <div class="registration-form">
      <form action = "admindashboard" method = "post" >
        @csrf
        <div class="form-icon">
          <span><i class="icon icon-user"></i></span>
          
          
      </div>
      
         <div class="form-group">
           <label for="AdminEmail">Email</label>
           <input type="text" name="admin" class="form-control" id="AdminEmail" aria-describedby="emailHelp" >
       
         </div>
         <div class="form-group">
           <label for="AdminPass">Password</label>
           <input type="password"name="password" class="form-control" id="Adminpass" aria-describedby="emailHelp" >
          @if(!empty($message))
          <br>
           <div class="alert alert-danger" role="alert">
           {{$message}}
           </div>
           @endif
         </div>
         <button type="submit" class="btn btn-primary">Enter</button>
       </form>
        <div class="social-media">
            <h5>Sign up with social media</h5>
            <div class="social-icons">
                <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                <a href="#"><i class="icon-social-google" title="Google"></i></a>
                <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js">
    /*
    $(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  $('#phone-number').mask('0000-0000');
 })  
 
    </script>
</body>
</html>
