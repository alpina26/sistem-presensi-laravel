<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', sans-serif; 
            background: linear-gradient(135deg, #e0f2fe, #dbeafe);
            min-height: 100vh;
            padding: 30px 20px;
        }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { text-align: center; color: #1e40af; margin-bottom: 25px; }
        h2 { color: #1e40af; margin: 40px 0 20px; font-size: 20px; }
        .tombol-baris { display: flex; gap: 12px; margin-bottom: 25px; flex-wrap: wrap; }
        .tombol {
            padding: 12px 20px; border-radius: 10px; text-decoration: none;
            font-weight: 600; border: none; cursor: pointer; font-size: 15px;
        }
        .tambah { background: #22c55e; color: white; }
        .daftar { background: #3b82f6; color: white; }
        .sukses {
            background: #dcfce7; color: #166534; padding: 12px;
            border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 600;
        }
        table {
            width: 100%; border-collapse: separate; border-spacing: 0;
            border-radius: 12px; overflow: hidden; background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); margin-bottom: 30px;
        }
        th, td { padding: 14px 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #eff6ff; color: #1e40af; font-weight: 700; }
        tr:last-child td { border-bottom: none; }
        .kosong { text-align: center; padding: 40px; color: #6b7280; }
        
        .qr-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }
        .qr-kartu {
            background: white; padding: 20px; border-radius: 12px;
            text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .qr-kartu h4 { color: #1e40af; margin: 10px 0 5px; }
        .qr-kartu p { color: #6b7280; font-size: 13px; margin-bottom: 10px; }
        .qr-kode { padding: 10px; background: #f0fdf4; border-radius: 10px; display: inline-block; }
    </style>
</head>
<body>

<div class="container">
    <h1>📋 Rekap Absensi</h1>

    <div class="tombol-baris">
        <a href="{{ route('presensi.create') }}" class="tombol tambah">+ Catat Absensi</a>
        <a href="{{ route('mahasiswa.index') }}" class="tombol daftar">Daftar Mahasiswa</a>
    </div>

    @if(session('success'))
        <div class="sukses">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $daftar = \App\Models\Mahasiswa::all(); @endphp
            @forelse($presensi as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nim }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->tanggal }}</td>
                <td>{{ $p->jam_masuk }}</td>
                <td>{{ $p->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="kosong">
                    Belum ada data absensi. Klik "+ Catat Absensi" untuk menambahkan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h2>📱 QR Code Absensi — Scan Langsung Catat!</h2>
    <div class="qr-grid">
        @foreach($daftar as $m)
        <div class="qr-kartu">
            <div class="qr-kode" id="qr-{{ $m->nim }}"></div>
            <h4>{{ $m->nama }}</h4>
            <p>{{ $m->nim }}</p>
        </div>
        @endforeach
    </div>
</div>

<script>
window.onload = function() {
    let alamatDasar = "http://192.168.110.26:8000/presensi/create?nim=";
    
    @foreach($daftar as $m)
        let url{{ $m->nim }} = alamatDasar + "{{ $m->nim }}";
        QRCode.toCanvas(document.createElement('canvas'), url{{ $m->nim }}, { width: 150 }, function (error, canvas) {
            if (!error) {
                document.getElementById('qr-{{ $m->nim }}').appendChild(canvas);
            }
        });
    @endforeach
};
</script>

</body>
</html>