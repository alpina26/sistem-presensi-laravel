<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 30px auto; padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background: #218838; }
        .kembali { display: block; margin-bottom: 15px; text-align: center; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<a href="{{ url('mahasiswa') }}" class="kembali">← Kembali ke Daftar</a>

<h2>Tambah Data Mahasiswa</h2>

<form action="{{ url('mahasiswa') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>NIM</label>
        <input type="text" name="nim" required>
    </div>

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
    </div>

    <div class="form-group">
        <label>Kelas</label>
        <input type="text" name="kelas" required placeholder="Contoh: 3A">
    </div>

    <div class="form-group">
        <label>Jurusan</label>
        <input type="text" name="jurusan" required placeholder="Contoh: Teknik Informatika">
    </div>

    <button type="submit">Simpan</button>
</form>

</body>
</html>