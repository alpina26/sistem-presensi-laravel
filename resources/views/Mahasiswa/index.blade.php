<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <style>
        body { font-family: Arial; max-width: 900px; margin: 30px auto; padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        .tambah { display: inline-block; background: #28a745; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; margin-bottom: 20px; }
        .tambah:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; font-weight: bold; }
        .hapus { background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
        .hapus:hover { background: #c82333; }
        .pesan { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>

<h2>Daftar Mahasiswa</h2>

<a href="{{ url('mahasiswa/create') }}" class="tambah">+ Tambah Mahasiswa</a>

{{-- Pesan berhasil disimpan --}}
@if(session('success'))
    <div class="pesan">{{ session('success') }}</div>
@endif

{{-- Tabel Data --}}
<table>
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- Kalau belum ada data --}}
        @if($mahasiswa->isEmpty())
            <tr>
                <td colspan="5" style="text-align:center; padding:20px; color:#666;">
                    Belum ada data. Klik "Tambah Mahasiswa" untuk menambahkan.
                </td>
            </tr>
        @else
            {{-- Tampilkan semua data --}}
            @foreach($mahasiswa as $mhs)
            <tr>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->kelas }}</td>
                <td>{{ $mhs->jurusan }}</td>
                <td>
                    <form action="{{ url('mahasiswa/'.$mhs->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="hapus">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

</body>
</html>