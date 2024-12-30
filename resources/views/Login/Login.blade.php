<!DOCTYPE html>
<html lang="zxx">
@include('Login.LoginCss')
<body>
<div class="login-wrap" style="background-image: url(images/background-login.jpg);">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Đăng Nhập</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Đăng Kí</label>
		<div class="login-form">
			@if($errors->has('login'))
			<p class="login-box-msg">
				<strong class="text-danger" style="color:red">{{ $errors->first('login') }}</strong>
			</p>
			@endif
			@if($errors->has('loginsuccess'))
			<p class="login-box-msg">
				<strong class="text-danger" style="color:green">{{ $errors->first('loginsuccess') }}</strong>
			</p>
			@endif
			<form class="sign-in-htm" style="padding-top:30px" action="{{ route('login') }}" method="post" onsubmit="return checkLogin();">
			{{ csrf_field() }}
				<div class="group">
					<label for="user" class="label">Email</label>
					<input id="email" name="email" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Mật khẩu</label>
					<input id="pass" name="password" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input id="check" name="remember" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Nhớ mật khẩu </label>
				</div>
				<div class="group">
					<button type="submit" class="button" value="">Đăng Nhập</button>
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot" style="color:white;">Quên mật khẩu?</a>
				</div>
				<div class="foot-lnk" style="margin-top:25px">
					<a href="/" style="color:white;"><i class="fas fa-home"></i> Trang chủ</a>
				</div>
			</form>
			<form class="sign-up-htm" style="padding-top:30px" action="{{ route('register') }}" method="post" onsubmit="return checkRegister();">
			{{ csrf_field() }}
				<div class="group">
					<label for="user" class="label">Email</label>
					<input id="regemail" name="regEmail" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Mật khẩu</label>
					<input id="regpass" name="regPassword" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Xác thực mật khẩu</label>
					<input id="repass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<button onclick="checkPass()" style="margin-top:25px" type="submit" class="button">Đăng Kí</button>
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1" style="color:white; cursor: pointer">Bạn đã có tài khoản? Đăng nhập.</label>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	function checkRegister(){
		var x = document.getElementById('regemail').value;
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
		var pass = document.getElementById('regpass').value;
		var repass = document.getElementById('repass').value;
        if (atposition < 1 || dotposition < (atposition + 2)
                || (dotposition + 2) >= x.length) {
            alert("Email của bạn không hợp lệ!");
            return false;
        }
		else if (repass !== pass){
			alert('Xác thực mật khẩu không khớp!');
			return false;
		}
	}
	function checkLogin(){
		var x = document.getElementById('email').value;
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        if (atposition < 1 || dotposition < (atposition + 2)
                || (dotposition + 2) >= x.length) {
            alert("Email của bạn không hợp lệ!");
            return false;
        }
	}
</script>
</body>

</html>