<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Akademik UTM</title>
    <style>
        body { background-color: #333; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: linear-gradient(to bottom, #4c4c4c 0%, #2c2c2c 100%); width: 400px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); overflow: hidden; border: 1px solid #555; }
        .login-header { background: url('https://siakad.trunojoyo.ac.id/images/header-login.jpg') no-repeat center; background-size: cover; height: 120px; position: relative; border-bottom: 2px solid #f0ad4e; }
        .header-overlay { background: rgba(0,0,0,0.4); height: 100%; display: flex; align-items: center; padding-left: 20px; }
        .logo-text { color: white; font-weight: bold; font-size: 14px; text-shadow: 1px 1px 2px black; }
        .login-body { padding: 30px; color: white; text-align: center; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; font-size: 13px; margin-bottom: 5px; font-weight: bold; }
        .form-control { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 3px; }
        .btn-login { background: linear-gradient(to bottom, #ffffff 0%, #e5e5e5 100%); border: 1px solid #ccc; padding: 6px 15px; font-weight: bold; color: #333; cursor: pointer; border-radius: 3px; }
        .btn-login:hover { background: #d4d4d4; }
        .footer-text { font-size: 11px; color: #999; margin-top: 20px; border-top: 1px solid #444; padding-top: 10px; }
        .alert { background-color: #d9534f; color: white; padding: 10px; font-size: 12px; margin-bottom: 15px; border-radius: 3px; }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="login-header">
            <div class="header-overlay">
                <div class="logo-text">
                    <img src="https://siakad.trunojoyo.ac.id/images/logo-utm-mini.png" width="30" style="vertical-align:middle; margin-right:5px;">
                    UNIVERSITAS TRUNOJOYO MADURA
                </div>
            </div>
        </div>
        
        <div class="login-body">
            @if ($errors->any())
                <div class="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Mahasiswa" required autofocus>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div style="text-align: left; margin-bottom: 10px; font-size: 12px;">
                    <label style="display: inline; font-weight: normal;">
                        <input type="checkbox" name="remember"> Ingat Saya
                    </label>
                </div>

                <div style="text-align: right;">
                    <button type="submit" class="btn-login">Login</button>
                </div>
            </form>

            <div style="margin-top: 20px; font-size: 12px;">
                <a href="{{ route('register') }}" style="color: #f0ad4e; text-decoration: none;">Belum punya akun? Daftar disini</a>
            </div>

            <div class="footer-text">
                Copyright © 2016, Powered by: PTIK - UTM
            </div>
        </div>
    </div>

</body>
</html>