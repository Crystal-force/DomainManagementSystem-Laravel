
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
		<h1 class="page-title">Domain Management</h1>

	</div>

	<div class="pull-right">
		<a href="#" class="ico-item mdi mdi-logout js__logout"></a>
	</div>

</div>


<div id="wrapper">
	<div class="main-content">
    <h1>Sorry! Server update now. Please wait!</h1>
	</div>

</div>

@endsection
