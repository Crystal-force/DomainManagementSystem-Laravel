
@extends('layout.index')
@section('content')

<div id="single-wrapper">
	<div action="#" class="frm-single">
		<div class="inside">
			<div class="title lg-logo"><strong>IEMS</strong></div>
			<div class="frm-title">LOGIN</div>

			<div class="alert alert-success" role="alert" id="login_success">  </div>
			<div class="alert alert-danger" role="alert" id="login_danger">  </div>
      <div class="alert alert-warning" role="alert" id="login_warning">  </div>

			<div class="frm-input"><input type="email" id="lg_email" placeholder="Useremail" class="frm-inp lg-user"><i class="fa fa-user frm-ico"></i></div>
			<div class="frm-input"><input type="password" id="lg_password" placeholder="Password" class="frm-inp lg-user"><i class="fa fa-lock frm-ico"></i></div>
			<div class="clearfix margin-bottom-20">
				<div class="pull-left">
					
				</div>
				<div class="pull-right"><a href="{{route("forgot")}}" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a></div>
			</div>
			<button type="submit" class="frm-submit lg-btn" onclick="Login()">Login<i class="fa fa-arrow-circle-right"></i></button>
			
			<a href="{{route('register')}}" class="a-link"><i class="fa fa-key"></i>New to IEMS? Register.</a>
			<div class="frm-footer">IEMS © <span id="year"></span> | Crystal team</div>
		</div>
	</div>
</div>

@endsection

<script>

function Login() {
  var lg_email = $("#lg_email").val();
  var lg_pwd = $("#lg_password").val();

  if(lg_email == "" || lg_pwd == "") {
    $("#login_warning").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
    $("#login_warning").html('<strong>Warning! </strong> You have to write each field to register correctly.');
    setTimeout(function() {
        location.reload();
    }, 1500);
    return;
  }

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url:"/login",
    method: 'post',
    data: {
      email: lg_email,
      password: lg_pwd
    },
    dataType: false,
    success: function(data) {
      if(data.data == "1") {
        $("#login_success").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
        $("#login_success").html('<strong>Well done!</strong> You successfully logged in!');
        setTimeout(function() {
            window.location.href="/dashboard";
        }, 1500);
      }
      else if(data.data == "0") {
        $("#login_danger").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
        $("#login_danger").html("<strong>Warning!</strong> This user information doesn't exist. Please check the information again!");
        setTimeout(function() {
            location.reload();
        }, 1500);
      }
    }
  });
}

</script>
