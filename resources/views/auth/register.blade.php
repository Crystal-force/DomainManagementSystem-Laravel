
@extends('layout.index')
@section('content')

<div id="single-wrapper">
	<div class="frm-single">
		<div class="inside">
			<div class="title lg-logo"><strong>IEMS</strong></div>
			<div class="frm-title">Register</div>

			<div class="alert alert-success" role="alert" id="register_success">  </div>
			<div class="alert alert-danger" role="alert" id="register_danger">  </div>
			<div class="alert alert-warning" role="alert" id="register_warning">  </div>

      <div class="frm-input"><input type="email" id="rg_email" placeholder="Email" class="frm-inp lg-user"><i class="fa fa-envelope frm-ico"></i></div>
			<div class="frm-input"><input type="text" id="rg_name" placeholder="Username" class="frm-inp lg-user"><i class="fa fa-user frm-ico"></i></div>
			<div class="frm-input"><input type="password" id="rg_password" placeholder="Password" class="frm-inp lg-user"><i class="fa fa-lock frm-ico"></i></div>
			
      <button type="submit" class="frm-submit lg-btn" onclick="Register()">Register<i class="fa fa-arrow-circle-right"></i></button>
			
      <a href="/" class="a-link"><i class="fa fa-sign-in"></i>Already have account? Login.</a>
			<div class="frm-footer">IEMS © <span id="year"></span> | Crystal team</div>
		</div>
	</div>
</div>

@endsection

<script>
  
  function Register() {
    var rg_email = $("#rg_email").val();
    var rg_name = $("#rg_name").val();
    var rg_pwd = $("#rg_password").val();

    if(rg_name == "" || rg_email == "" || rg_pwd == "") {
        $("#register_warning").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
          $("#register_warning").html('<strong>Warning! </strong> You have to write each field to register correctly.');
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
      url: '/register',
      method: 'post',
      data: {
        email: rg_email,
        name: rg_name,
        password: rg_pwd
      },
      dataType: false,
      success: function(data) {
        if(data.data == "1") {
          $("#register_success").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
          $("#register_success").html('<strong>Well done!</strong> You successfully registered new user information.');
          setTimeout(function() {
              window.location.href="/";
          }, 1500);
        }
        else if(data.data == "0") {
          $("#register_danger").delay(5).fadeIn('slow').delay(1500).fadeOut('slow');
          $("#register_danger").html('<strong>Warning!</strong> This user information already exists. Please check the information again!');
          setTimeout(function() {
              location.reload();
          }, 1500);
        }
      }
    });
  }

</script>
