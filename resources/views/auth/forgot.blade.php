
@extends('layout.index')
@section('content')

<div id="single-wrapper">
	<form action="#" class="frm-single">
		<div class="inside">
			<div class="title lg-logo"><strong>IEMS</strong></div>
		
			<div class="frm-title">Reset Password</div>
			<p class="text-center">Enter your email address and we'll send you an email with instructions to reset your password.</p>
			<div class="frm-input"><input type="email" placeholder="Enter Email" class="frm-inp lg-user"><i class="fa fa-envelope frm-ico"></i></div>
			<button type="submit" class="frm-submit lg-btn">Send Email<i class="fa fa-arrow-circle-right"></i></button>
			<a href="/" class="a-link"><i class="fa fa-sign-in"></i>Already have account? Login.</a>
      <div class="frm-footer">IEMS © <span id="year"></span> | Crystal team</div>
		</div>
	</form>
</div>

@endsection
