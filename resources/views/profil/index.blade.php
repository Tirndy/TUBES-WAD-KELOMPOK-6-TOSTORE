<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - ToStore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h2 { color: #222; }

        label {
            display: block;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            margin-top: 20px;
            padding: 11px 18px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .success { color: green; }
        .error { color: red; }

        a { color: #2563eb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Profil Pengguna</h2>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Lengkap</label>
        <input type="text" name="name"
            value="{{ old('name', $user->name) }}" required>

        <label>Email</label>
        <input type="email" name="email"
            value="{{ old('email', $user->email) }}" required>

        <label>Nomor Telepon</label>
        <input type="text" name="telepon"
            value="{{ old('telepon', $user->telepon) }}">

        <button type="submit">Simpan Perubahan</button>
    </form>

    <hr>

    <h2>Ubah Password</h2>

    <form action="{{ route('profil.password') }}" method="POST">
        @csrf
        @method('PUT')

        <label>Password Lama</label>
        <input type="password" name="password_lama" required>

        <label>Password Baru</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Ubah Password</button>
    </form>

    <hr>

    <p><a href="{{ route('alamat.index') }}">Kelola Alamat Pengiriman</a></p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>