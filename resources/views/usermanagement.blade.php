
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
		<h1 class="page-title">User Management</h1>

	</div>

	<div class="pull-right">
		<a href="#" class="ico-item mdi mdi-logout js__logout"></a>
	</div>

</div>


<div id="wrapper">
	<div class="main-content">
    <div class="row small-spacing">
      <div class="col-lg-3 col-xs-12">
				<div class="box-content bg-success text-white">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-users"></i>
						<p class="text text-white">Users</p>
						<h2 class="counter">120</h2>
					</div>
				</div>
			</div>
    </div>

    <div class="row small-spacing">
      <div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">User Table</h4>
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
								<th>User Name</th>
								<th>Domain</th>
								<th>Management</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Kevin Damon</td>
								<td>https://test.com</td>
								<td>
                  <span class="margin-bottom-10"><button type="button" id="sal-warning" class="btn btn-danger btn-circle btn-xs waves-effect waves-light"><i class="ico fa fa-remove (alias)"></i></button></span>
                </td>
							</tr>
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



<div class="modal fade" id="add-domain-manualy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Add domain manually</h4>
			</div>
			<div class="modal-body">
        <h5 class="add-domainname"><b>Domain Name</b></h5>
				<input type="text" class="form-control" maxlength="25" name="defaultconfig" id="defaultconfig" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-rounded waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Add domain</button>
			</div>
		</div>
	</div>
</div>

@endsection
