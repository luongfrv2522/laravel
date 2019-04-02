<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Đăng nhập</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
	<form action="{{ route('loginpost') }}" method="post">
		@csrf
		<h2 class="text-center">Đăng nhập</h2>       
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required="required">
		</div>
		<p class="" style="font-size: 12px;color: red;">{{ $errors->first('username') }}</p>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Mật khẩu" required="required">
		</div>
		<p class="" style="font-size: 12px;color: red;">{{ $errors->first('password') }}</p>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
		</div>
		<div class="clearfix">
			<p class="float-left"><input type="checkbox" name="remember_me"> Ghi nhớ</p>
			<a href="#" class="float-right">Quên mật khẩu?</a>
		</div>        
	</form>
	<p class="text-center"><a href="#">Đăng ký tài khoản</a></p>
</div>
</body>
</html>                                		                            