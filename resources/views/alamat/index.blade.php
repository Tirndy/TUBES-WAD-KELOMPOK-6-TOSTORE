<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Pengiriman - ToStore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        input, textarea {
            width: 100%;
            padding: 11px;
            margin: 7px 0 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            margin-top: 8px;
        }

        .alamat {
            border: 1px solid #ddd;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .default {
            color: green;
            font-weight: bold;
        }

        .success { color: green; }
        .error { color: red; }

        .aksi {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .hapus { background: #dc2626; }
        .utama { background: #16a34a; }

        a { color: #2563eb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Direktori Alamat Pengiriman</h2>

    <a href="{{ route('profil.index') }}">Kembali ke Profil</a>

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

    <hr>

    <h3>Tambah Alamat Baru</h3>

    <form action="{{ route('alamat.store') }}" method="POST">
        @csrf

        <label>Label Alamat</label>
        <input type="text" name="label" placeholder="Contoh: Rumah, Kantor" required>

        <label>Nama Penerima</label>
        <input type="text" name="nama_penerima" required>

        <label>Nomor Telepon Penerima</label>
        <input type="text" name="telepon_penerima" required>

        <label>Alamat Lengkap</label>
        <textarea name="alamat_lengkap" rows="3" required></textarea>

        <label>Kota</label>
        <input type="text" name="kota" required>

        <label>Provinsi</label>
        <input type="text" name="provinsi" required>

        <label>Kode Pos</label>
        <input type="text" name="kode_pos" required>

        <button type="submit">Simpan Alamat</button>
    </form>

    <hr>

    <h3>Daftar Alamat Saya</h3>

    @forelse ($alamats as $alamat)
        <div class="alamat">
            <h4>{{ $alamat->label }}</h4>

            @if ($alamat->is_default)
                <p class="default">Alamat Utama</p>
            @endif

            <p><strong>{{ $alamat->nama_penerima }}</strong></p>
            <p>{{ $alamat->telepon_penerima }}</p>
            <p>
                {{ $alamat->alamat_lengkap }},
                {{ $alamat->kota }},
                {{ $alamat->provinsi }},
                {{ $alamat->kode_pos }}
            </p>

            <div class="aksi">
                <button type="button"
                    onclick="document.getElementById('edit-{{ $alamat->id }}').style.display='block'">
                    Edit
                </button>

                @if (!$alamat->is_default)
                    <form action="{{ route('alamat.default', $alamat->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="utama">Jadikan Alamat Utama</button>
                    </form>
                @endif

                <form action="{{ route('alamat.destroy', $alamat->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hapus">Hapus</button>
                </form>
            </div>

            <div id="edit-{{ $alamat->id }}" style="display:none; margin-top:20px;">
                <h4>Edit Alamat</h4>

                <form action="{{ route('alamat.update', $alamat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label>Label Alamat</label>
                    <input type="text" name="label" value="{{ $alamat->label }}" required>

                    <label>Nama Penerima</label>
                    <input type="text" name="nama_penerima" value="{{ $alamat->nama_penerima }}" required>

                    <label>Nomor Telepon Penerima</label>
                    <input type="text" name="telepon_penerima" value="{{ $alamat->telepon_penerima }}" required>

                    <label>Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="3" required>{{ $alamat->alamat_lengkap }}</textarea>

                    <label>Kota</label>
                    <input type="text" name="kota" value="{{ $alamat->kota }}" required>

                    <label>Provinsi</label>
                    <input type="text" name="provinsi" value="{{ $alamat->provinsi }}" required>

                    <label>Kode Pos</label>
                    <input type="text" name="kode_pos" value="{{ $alamat->kode_pos }}" required>

                    <button type="submit">Simpan Perubahan</button>
                    <button type="button" onclick="document.getElementById('edit-{{ $alamat->id }}').style.display='none'">
                        Batal
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p>Belum ada alamat pengiriman yang ditambahkan.</p>
    @endforelse

</div>

</body>
</html>