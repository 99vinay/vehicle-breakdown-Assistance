<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use Illuminate\Support\Facades\Crypt;
use App\customer;
use Carbon\Carbon;
use App\spadmin;
use App\userreq;
use App\User;
class UserController extends Controller
{
    function check(Request $req)
    {
        $entity = employee::where('name', $req->user)->get();
        if($entity->isEmpty())
        return redirect('/registersp');
        else if(($req->user == $entity[0]->name)&&($req->password == Crypt::decrypt($entity[0]->password)))
        {

            $req->session()->put('sp-login',$req->user);
                return view('makecus');
        }
        else
        {
           return redirect('/registersp');
        }
    }

    function checkagain()
   {
    $cus = customer::all();
    foreach($cus as $c)

     {   $to = Carbon::createFromFormat('Y-m-d H:i:s', $c->updated_at);
        $mytime = Carbon::now();
        $from = Carbon::createFromFormat('Y-m-d H:i:s', $mytime);
        $diff_in_days = $to->diffInDays($from);
        if($diff_in_days >= 30)
        {
            $c->Status = 0;
            $c->save();
        }
    }
    return view('spadmindash',["cus"=>$cus]);
   }


    function sp_logout(Request $req)
    {
         session()->forget('sp-login');
         return redirect('/registersp');
    }
    function ad_logout(Request $req)
    {
         session()->forget('ad-login');
         return redirect('/spadmin');
    }
    function addnew(Request $req)
    {
        $cus = new customer;
        $cus->Email = $req->email;
        $cus->customer_name = $req->username;
        $cus->Password = Crypt::encrypt($req->password);
        $cus->name = $req->name;
        $cus->Place = $req->place;
        $cus->working = $req->working;
        $cus->Latitude = $req->latitude;
        $cus->Longitude = $req->longitude;
        $cus->Phone = $req->phone;
        $cus->Status = 1;
        if($req->hasfile('image'))
        {
            $file = $req->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/customer',$filename);
            $cus->image = $filename;
        }
        else{
            $cus->image = '';
        }
        $cus->save();
        return redirect('/registersp');

    }
   function changeState($id)
   {
       $cus = customer::find($id);
       $cus->Status = 1;
       $cus->save();
       return redirect()->route('admindash');
   }
   function ad_delete($id)
   {
       customer::find($id)->delete();
       return redirect()->route('admindash');

   }

   function spadmindash(Request $req)
   {
       $entity = spadmin::find(1);
       $realpass = Crypt::decrypt($entity->password);
       if($req->user == $entity->name && $req->password == $realpass)
       {
        $req->session()->put('ad-login',$req->input());
        $cus = customer::all();
        foreach($cus as $c)
        {
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $c->updated_at);
            $mytime = Carbon::now();
            $from = Carbon::createFromFormat('Y-m-d H:i:s', $mytime);
            $diff_in_days = $to->diffInDays($from);
            if($diff_in_days >= 30)
            {
                $c->Status = 0;
                $c->save();
            }
        }
        return view('spadmindash',["cus"=>$cus]);
       }
       else
       {
          return redirect('/spadmin');
       }
   }
   function checkadmin(Request $req)
   {
       if(customer::where('Email','=',$req->admin)->exists())
       {
         $cus =  customer::where('Email','=',$req->admin)->get()->first();
         $pass = Crypt::decrypt($cus->Password);
         if($cus->Email == $req->admin && $req->password == Crypt::decrypt($cus->Password))
         {
             $req->session()->put('admin', $cus->id);
             $usr = $cus->userreqs;
             return redirect()->route('admindashboard',["items"=>$usr]);
         }
         else
         {
             $message = "These credentials do not match our records.";
             return view('admin',["message"=>$message]);
         }
       }
       else
       {
           $message = "User doesn't exist";
           return view('admin',["message"=>$message]);
       }

   }
   function reloadstats(Request $req)
   {
        $cus_id = session()->get('admin');
        $cus = customer::find($cus_id);
        $name = $cus->customer_name;
        $items = $cus->userreqs;
        if($req->ajax())
        {
            return view('admindashboard',["items"=>$items , "name"=>$name])->render();
        }
        return view('admindashboard',["items"=>$items , "name"=>$name]);
   }
   function adminlogout()
   {
    session()->forget('admin');
    return redirect('/admin');
   }
   function accept($id)
   {
    $cus_id = session()->get('admin');
    $cus = customer::find($cus_id);
    $name = $cus->customer_name;
    $items = $cus->userreqs;
    $ent = userreq::find($id);
    $ent->Status = 1;
    $user = User::find($ent->user_id);
    $derive = $user->derivetabs()->find($ent->item_id);
    $derive->Status = 1;
    $ent->save();
    $derive->save();
    return redirect()->route('admindashboard',["items"=>$items , "name"=>$name]);
   }
   function deny($id)
   {
      $cus_id = session()->get('admin');
      $cus = customer::find($cus_id);
      $name = $cus->customer_name;
      $items = $cus->userreqs;
      $ent = userreq::find($id);
      $ent->Status = 2;
      $user = User::find($ent->user_id);
      $derive = $user->derivetabs()->find($ent->item_id)->delete();
      $ent->delete();
    return redirect()->route('admindashboard',["items"=>$items , "name"=>$name]);
   }

   function getdirectfunc($lats1,$long1){
        return view('direction',["lats1"=>$lats1,"long1"=>$long1]);
   }
}
