<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Models\DomainList;
use DB;

class DomainController extends Controller
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
      $manual_domain = DomainList::get();
      return view('domain')->with([
        'domains'=> $domains,
        'm_domains'=>$manual_domain,
        'counts' => count($domains)
      ]);
    }

    public function domaindetailinfo(Request $request) {
      $sld = $request->sld;
      $tld = $request->tld;
      $response = Curl::to('https://api.namecheap.com/xml.response?ApiUser=bakkalisimo&ApiKey=dc5c2c1dc6ac45709eac708668ad05ff&UserName=bakkalisimo&Command=namecheap.domains.dns.getHosts&ClientIp=188.43.136.32&SLD='.$sld.'&TLD='.$tld.'')->get();
      $xml = simplexml_load_string($response);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      $domain =  $array["CommandResponse"]["DomainDNSGetHostsResult"];
      if(count($domain) >= 2) {
        return response()->json(['data'=>$domain]);
      }
      else {
        return response()->json(['data'=>'false']);
      }
    }

    public function adddomainmanually(Request $request) {
      $name = $request->d_name;
      $get_name = explode(" ",$name);
      for($i = 0; $i<count($get_name); $i++) {
        $res =DomainList::where('name', $get_name)->first();
      }
      
      if($res == null) {
        for($i = 0; $i<count($get_name); $i++) {
          $adddomain = [
            'name' => $get_name[$i]
          ];
          $add_res = DomainList::create($adddomain);
        }
        
        if($add_res != ""){
          return response()->json([
            'data'=>'1'
          ]);
        };
      }
      else {
        return response()->json([
          'data'=>'0'
        ]);
      }
    }

    public function removedomain(Request $request) {
      $m_domain = $request->r_domain;

      $res = DomainList::where('name', $m_domain)->delete();
      return response()->json([
        'data'=>'1'
      ]);
    }

    public function allremovedomain(Request $request) {
      $all = $request->all;
      if($all == "1") {
        $res = DB::table('domain_lists')->delete();
        return response()->json([
          'data'=>'1'
        ]);
      }
    }
}
