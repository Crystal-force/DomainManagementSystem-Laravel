
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
		<h1 class="page-title">Dashboard</h1>

	</div>

	<div class="pull-right">
		<a href="/logout" class="ico-item mdi mdi-logout"></a>
	</div>

</div>


<div id="wrapper">
	<div class="main-content">

    <div class="row small-spacing">
      <div class="col-lg-4 col-xs-12">
				<div class="box-content">
					<h4 class="box-title text-info">Total Domains</h4>
					
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="/domain">View</a></li>
						</ul>
					</div>
					<div class="content widget-stat">
						<div id="traffic-sparkline-chart-1" class="left-content margin-top-15"></div>
						<div class="right-content">
							<h2 class="counter text-info">{{$counts}} <i class="fa fa-external-link"></i></h2>
							<p class="text text-info">Domains</p>
						</div>
					</div>
				</div>
			</div>
    </div>

    <div class="row small-spacing">
      <div class="col-lg-6 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Latest Domains</h4>
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="/domain">View</a></li>
						</ul>
					</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ID</th> 
								<th>Domain</th> 
								<th>Created</th> 
								<th>Expires</th> 
							</tr> 
						</thead> 
						<tbody> 
              @foreach($domains as $key => $domain)
                @if($key == 6)
                  @break
                @endif
                @php
                    $d = $domain['@attributes'];
                @endphp
                <tr> 
                  <th scope="row">{{$d['ID']}}</th> 
                  <td>{{$d['Name']}}</td> 
                  <td>{{$d['Created']}}</td> 
                  <td>{{$d['Expires']}}</td> 
                </tr> 
              @endforeach
						</tbody> 
					</table>
				</div>
				<!-- /.box-content -->
			</div>

      <div class="col-lg-6 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Latest DNS</h4>
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="/domains">View</a></li>
						</ul>
					</div>
					<table class="table table-hover">
						<thead>
							<tr class="table-content">
								<th >ID</th>
								<th>Name</th> 
								<th>IsOurDNS</th> 
							</tr> 
						</thead> 
						<tbody> 
								
              @foreach($domains as $key=>$domain)
              @if($key == 6)
              @break
              @endif
                @php
                    $d = $domain['@attributes'];
                @endphp
                <tr> 
                  <th scope="row">{{$d['ID']}}</th> 
                  <td>{{$d['Name']}}</td> 
                  <td>{{$d['IsOurDNS']}}</td> 
                </tr> 
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

@endsection
