<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class DashboardController extends Controller
{
    public function index() {
      $response = Curl::to('https://api.namecheap.com/xml.response?ApiUser=bakkalisimo&ApiKey=dc5c2c1dc6ac45709eac708668ad05ff&UserName=bakkalisimo&Command=namecheap.domains.getList&ClientIp=188.43.136.32')->get();
      $xml = simplexml_load_string($response);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
     
      if($array == false) {
        return view('incoming');
      }
      $domains =  $array["CommandResponse"]["DomainGetListResult"]["Domain"];
    
      if($domains == "") {
        return view('incoming');
      }
      return view('dashboard')->with([
        'domains'=> $domains,
        'counts' => count($domains)
      ]);
     
    }
}
