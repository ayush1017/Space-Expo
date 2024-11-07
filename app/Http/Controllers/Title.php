<?php
namespace App\Http\Controllers;



use Http;
class Title extends Controller{
    function index(){
       $data=Http::get('https://api.nasa.gov/planetary/apod?api_key=HkORylQH8IB2lJQbzIU5fD6SJ3gGIamAtuPP6Q5M');
       if($data->successful()){
         response()->json($data->json());
       }
       return view('Login',compact('data'));
    }
}
?>