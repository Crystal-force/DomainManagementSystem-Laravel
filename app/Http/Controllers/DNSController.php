<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Models\DomainList;

class DNSController extends Controller
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

      $new_domain = DomainList::get();

      return view('domaindns')->with([
        'domains' => $domains,
        'newdomain' => $new_domain,
        'counts' => count($domains)
      ]);
    }

    public function dnsgetdefault(Request $request) {
      $sld = $request->sld;
      $tld = $request->tld;
      $response = Curl::to('https://api.namecheap.com/xml.response?ApiUser=bakkalisimo&ApiKey=dc5c2c1dc6ac45709eac708668ad05ff&UserName=bakkalisimo&Command=namecheap.domains.dns.setDefault&ClientIp=188.43.136.32&SLD='.$sld.'&TLD='.$tld.'')->get();
      $xml = simplexml_load_string($response);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      $status = $array["@attributes"]["Status"];

      if($status == "OK") {
        return response()->json(['data' => '1']);
      }
      else if($status == "ERROR") {
        return response()->json(['data' => '0']);
      }
    }


    public function dnsrecord(Request $request) {
      $sld = $request->sld;
      $tld = $request->tld;
      $hostname = $request->hostname;
      $recordtype = $request->recordtype;
      $address = $request->address;
      $ttl = $request->ttl;
      $response = Curl::to('https://api.namecheap.com/xml.response?apiuser=bakkalisimo&apikey=dc5c2c1dc6ac45709eac708668ad05ff&username=bakkalisimo&Command=namecheap.domains.dns.setHosts&ClientIp=188.43.136.32&SLD='.$sld.'&TLD='.$tld.'&HostName1='.$hostname.'&RecordType1='.$recordtype.'&Address1='.$address.'&TTL1='.$ttl.'')->get();
      $xml = simplexml_load_string($response);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      $status = $array["@attributes"]["Status"];
      
      if($status == "OK") {
        return response()->json([
          'data'=>'1'
        ]);
      }
      else if($status == "ERROR") {
        return response()->json([
          'data'=>'0'
        ]);
      }
    }
}
