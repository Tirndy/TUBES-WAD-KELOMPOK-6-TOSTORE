<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - ToStore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            width: 380px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #222;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .link {
            text-align: center;
            margin-top: 15px;
        }

        .error {
            color: red;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Buat Akun ToStore</h2>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label>Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>

        <label>Nomor Telepon</label>
        <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="Masukkan nomor telepon">

        <label>Password</label>
        <input type="password" name="password" placeholder="Minimal 8 karakter" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>

        <button type="submit">Daftar Sekarang</button>
    </form>

    <div class="link">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login</a>
    </div>
</div>

</body>
</html>