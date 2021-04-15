<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\customer;
use App\derivetab;
use App\userreq;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = auth()->user();
        $cus = $user->derivetabs;
        return view('home',['cus'=>$cus]);
    }
    function makereq(Request $req)
    {
         
         $user = auth()->user();
         $cus = $user->derivetabs;
         $username = $user->name;
         foreach($cus as $y)
         {
             $item = new userreq;
             $item->user_id = auth()->user()->id;
             $item->customer_id = $y->customer_id;
             $item->item_id = $y->id;
             $item->Latitude = $y->Latitude;
             $item->Longitude = $y->Longitude;
             $y->Status = 2;
             $y->save();
             $item->brand = $req->input('brand');
             $item->phone = $req->input('phone');
             $item->username = $username;
             $item->Status = 2;
             $item->save();
         }
         return view('home',['cus'=>$cus]);
    }
    function getcus(Request $req)
    {
        $latitude = round($req->lats,6);
        $longitude = round($req->long,6);

       // $cus = customer::selectRaw('id,name,Place,Phone,working,image,( 6367 * acos( cos( radians( ? ) ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( Latitude ) ) ) ) as distance', [$latitude, $longitude, $latitude])
       // ->having('distance', '<', 500)
       // ->orderBy('distance')
        //->get();
        
         $cus = customer::selectRaw('"id","name","Place","working","image",( 6367 * acos( cos( radians( ? ) ) * cos( radians( "Latitude" ) ) * cos( radians( "Longitude" ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( "Latitude" ) ) ) ) as distance', [$latitude, $longitude, $latitude])
            ->whereRaw('( 6367 * acos( cos( radians( ? ) ) * cos( radians( "Latitude" ) ) * cos( radians( "Longitude" ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( "Latitude" ) ) ) ) < 500',[$latitude, $longitude, $latitude])
            ->orderBy("distance")
             ->get();
            $user = auth()->user();
            $user->derivetabs()->truncate();
            $items = [];
            foreach($cus as $data)
            {  
                $items[] = [
                    'name' => $data->name,
                    'user_id' => auth()->user()->id,
                    'customer_id' => $data->id,
                    'Status' => 0,
                    'Latitude'=>$latitude,
                    'Longitude'=>$longitude,
                    'place' => $data->Place,
                    'working' => $data->working,
                    'image' => $data->image,
                    'Phone' =>$data->Phone,
                    'distance'=>round($data->distance,1)
                ];
            }
            derivetab::insert($items);
            $user = auth()->user();
            $cus2 = $user->derivetabs;
            return view('home',['cus'=>$cus2]);
    }
    function getderive()
    {
        $user = auth()->user();
        $cus = $user->derivetabs;
        return view('home',['cus'=>$cus]);
    }
    function confirmyesfunc($id)
    {
        $user = auth()->user();
        $myArr = array($id);
        $user->derivetabs()->whereNotIn('id', $myArr)
        ->delete();
        $usr = userreq::where('item_id',$id)->get()->first();
        $usrid = $usr->id;
        $myArr2 = array($usrid);
        $user->userreqs()->whereNotIn('id', $myArr2)
        ->delete();
        $usr->Status = 3;
        $usr->save();
        $tab = derivetab::find($id);
        $tab->Status = 3;
        $tab->save();
        $cus = $user->derivetabs;
        return redirect()->route('home',['cus'=>$cus]);
   }

    function confirmnofunc($id)
    {
        derivetab::destroy($id);
        $usr = userreq::where('item_id',$id)->get()->first();
        $usr->delete();
        $user = auth()->user();
        $cus = $user->derivetabs;
        return redirect()->route('home',['cus'=>$cus]);
   }
    

}