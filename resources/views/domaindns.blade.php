
@extends('layout.index')
@section('content')

<div class="main-menu">
	<header class="header">
		<a href="/dashboard" class="logo">DOMAIN SYSTEM</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		@include('component.left-avater')
	</header>
@include('component.left-menu')
</div>


<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">DNS Management</h1>
	</div>

	<div class="pull-right">
		<a href="/logout" class="ico-item mdi mdi-logout"></a>
	</div>

</div>


<div id="wrapper">
	<div class="main-content">
    <div class="row small-spacing">
      <div class="col-lg-3 col-xs-12">
				<div class="box-content bg-warning text-white">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-first-order"></i>
						<p class="text text-white">DNS Setting</p>
						<h2 class="counter">{{$counts}}</h2>
					</div>
				</div>
			</div>
      <div class="col-lg-9 col-xs-12">
        <ul class="list-inline domain-add">
            <li class="margin-bottom-10"><button type="button" class="btn btn-violet btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#dns-record" >DNS record</button></li>
        </ul>
      </div>
    </div>

    <div class="row small-spacing">
      <div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">DNS Table</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">All remove</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Created</th>
								<th>Expires</th>
								<th>IsExpired</th>
								<th>IsPremium</th>
								<th>IsOurDNS</th>
							</tr>
						</thead>
						<tbody>
              @foreach($domains as $domain)
                @php
                  $d = $domain['@attributes'];
                @endphp
                @if($d['IsOurDNS'] != "false")
                <tr>
                  <td>{{$d['ID']}}</td>
                  <td>{{$d['Name']}}</td>
                  <td>{{$d['Created']}}</td>
                  <td>{{$d['Expires']}}</td>
                  <td>{{$d['IsExpired']}}</td>
                  <td>{{$d['IsPremium']}}</td>
                  <td>{{$d['IsOurDNS']}}</td>
                </tr>
                @endif
              @endforeach
						</tbody>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
    </div>



		<footer class="footer">
			@include('component\footer')
		</footer>
	</div>

</div>



<div class="modal fade" id="dns-record" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">DNS Record</h4>
			</div>
			<div class="modal-body">
        <div class="alert alert-success" role="alert" id="dns_domainlist_success"> </div>
        <div class="alert alert-warning" role="alert" id="dns_domainlist_warning"> </div>
        <div class="form-group margin-bottom-20">
          <h5 class="add-domainname"><b>Domain Name</b></h5>
          <select class="form-control" id="selected_domain">
            @foreach($newdomain as $domain)
               <option value="{{ $domain->name }}">{{ $domain->name }}</option>
            @endforeach
          </select>
        </div>
        <h5 class="add-domainname"><b>HostName</b></h5>
				<input type="text" class="form-control" name="defaultconfig" id="hostname" placeholder="@" value="@" readonly/>
        <h5 class="add-domainname"><b>RecordType</b></h5>
        <select class="form-control" id="selected_recordtype">
          <option value="A">A</option>
        </select>
        <h5 class="add-domainname"><b>Address</b></h5>
				<input type="text" class="form-control" name="defaultconfig" id="address" placeholder="http://www.namecheap.com" />
        <h5 class="add-domainname"><b>TTL</b></h5>
				<input type="text" class="form-control" name="defaultconfig" id="ttl" placeholder="1800" value="1800" readonly/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" onclick="DNSRecordSetting()">Confirm</button>
			</div>
		</div>
	</div>
</div>

<script>
  function DNSRecordSetting() {
    var domain = $("#selected_domain").find(":selected").val();
    var domain_r = domain.split(".");
    var sld = domain_r[0];
    var tld = domain_r[1];

    var hostname = $("#hostname").val();
    var recordtype = $("#selected_recordtype").find(":selected").val();
    var address = $("#address").val();
    var ttl = $("#ttl").val();
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:'/dns-record',
        method: 'post',
        data: {
          sld: sld,
          tld: tld,
          hostname: hostname,
          recordtype: recordtype,
          address: address,
          ttl:ttl
        },
        dataType: false,
        success: function(data) {
          if(data.data == '1') {
            $("#dns_domainlist_success").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
            $("#dns_domainlist_success").html('<strong>Well done!</strong> The dns record setted successfully.');
            setTimeout(function() {
                location.reload();
            }, 1500);
          }
          else if(data.data == "0") {
            $("#dns_domainlist_warning").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
            $("#dns_domainlist_warning").html('<strong>Warning!</strong> Cannot complete this command as this domain is not using proper DNS servers.');
          }
        }
    });
  }
</script>


@endsection
