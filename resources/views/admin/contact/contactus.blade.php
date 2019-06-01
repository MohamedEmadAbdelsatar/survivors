<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact US</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('default/contact/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('default/contact/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('default/contact/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('default/contact/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('default/contact/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('default/contact/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('default/contact/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100" >

		<div class="wrap-contact100"style="width:600px;">
			<form class="m-form m-form--fit m-form--label-align-right" role="form" action="{{route('contact/save')}}" method="POST" >
            {{ csrf_field()}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4>Done !</h4><?=session('success')?>
            </div>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4>Failed !</h4><?=session('failed')?>
            </div>
        @endif
        @if(count($errors)>0)
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        @foreach($errors->all() as $error)
        <h5><span class="la la-warning"></span> Failed ! {{$error}}</h5>
        @endforeach
        </div>
        @endif
            <span class="contact100-form-title">
                Contact Us
            </span>
            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <span class="label-input100">Hospital Name</span>
                <input class="input100" type="text" name="name" placeholder="Enter Hospital Name">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <span class="label-input100">Address</span>
                <input class="input100" type="text" name="address" placeholder="Enter Address">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                <span class="label-input100">Email Address</span>
                <input class="input100" type="text" name="email" placeholder="Enter your email addess">
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                <span class="label-input100">Phone Number</span>
                <input class="input100" type="tel" name="phone" placeholder="Enter Phone Number">
                <span class="focus-input100"></span>
            </div>
                <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary">
                                Submit
                        </button>
                </div>

        </form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="{{asset('default/contact/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('default/contact/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('default/contact/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('default/contact/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('default/contact/js/main.js')}}"></script>



</body>
</html>
