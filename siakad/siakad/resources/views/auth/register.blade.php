<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Portal Akademik UTM</title>
    <style>
        /* ... Copy CSS dari file Login di atas ... */
        body { background-color: #333; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px 0; }
        .login-box { background: linear-gradient(to bottom, #4c4c4c 0%, #2c2c2c 100%); width: 450px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); overflow: hidden; border: 1px solid #555; }
        .login-header { background: url('https://siakad.trunojoyo.ac.id/images/header-login.jpg') no-repeat center; background-size: cover; height: 100px; position: relative; border-bottom: 2px solid #f0ad4e; }
        .header-overlay { background: rgba(0,0,0,0.4); height: 100%; display: flex; align-items: center; padding-left: 20px; }
        .logo-text { color: white; font-weight: bold; font-size: 14px; text-shadow: 1px 1px 2px black; }
        .login-body { padding: 25px; color: white; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 12px; margin-bottom: 5px; font-weight: bold; color: #ccc; }
        .form-control { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 3px; font-size: 13px; }
        .btn-login { background: linear-gradient(to bottom, #f0ad4e 0%, #eea236 100%); border: 1px solid #d58512; padding: 8px 20px; font-weight: bold; color: #fff; cursor: pointer; border-radius: 3px; width: 100%; margin-top: 10px; }
        .btn-login:hover { background: #d58512; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-header">
            <div class="header-overlay">
                <div class="logo-text">REGISTRASI MAHASISWA BARU</div>
            </div>
        </div>
        
        <div class="login-body">
            @if($errors->any())
                <div style="background: #d9534f; padding: 10px; border-radius: 3px; margin-bottom: 15px; font-size: 12px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required>
                </div>

                <div class="form-group">
                    <label>Program Studi</label>
                    <input type="text" name="prodi" class="form-control" value="{{ old('prodi') }}" placeholder="Contoh: Teknik Informatika" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Foto Profil (Wajib)</label>
                    <input type="file" name="photo" class="form-control" accept="image/*" required>
                    <small style="color: #999; font-size: 11px;">Format: JPG/PNG, Maks 2MB</small>
                </div>


                <button type="submit" class="btn-login">DAFTAR SEKARANG</button>
            </form>

            <div style="text-align: center; margin-top: 15px; font-size: 12px;">
                <a href="{{ route('login') }}" style="color: #ccc; text-decoration: none;">Sudah punya akun? Login disini</a>
            </div>
        </div>
    </div>
</body>
</html>