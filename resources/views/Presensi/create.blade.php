<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Absensi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', sans-serif; 
            max-width: 520px; 
            margin: 40px auto; 
            padding: 25px; 
            background: linear-gradient(135deg, #e0f2fe, #dbeafe);
            min-height: 100vh;
        }
        h1 { text-align: center; color: #1e40af; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #1f2937; }
        select, input { 
            width: 100%; padding: 12px; border: 2px solid #93c5fd; 
            border-radius: 10px; font-size: 16px; background: white;
        }
        input[readonly] { background: #f0fdf4; }
        button { 
            background: linear-gradient(135deg, #22c55e, #16a34a); 
            color: white; border: none; padding: 14px; 
            width: 100%; border-radius: 10px; 
            font-size: 17px; font-weight: 600; cursor: pointer; 
        }
        .kembali {
            display: block; text-align: center; margin-top: 20px;
            color: #2563eb; text-decoration: none; font-weight: 600;
        }
    </style>
</head>
<body>

<h1>📝 Catat Absensi</h1>

<form action="{{ route('presensi.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Nama Mahasiswa</label>
        <select name="nim" id="nim" required onchange="isiNama()">
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach($mahasiswa as $m)
            <option value="{{ $m->nim }}" data-nama="{{ $m->nama }}"
                @if(request('nim') == $m->nim) selected @endif>
                {{ $m->nim }} - {{ $m->nama }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" id="nama_lengkap" readonly
               value="{{ $mahasiswa->firstWhere('nim', request('nim'))?->nama ?? '' }}">
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" required>
            <option value="Hadir">✅ Hadir</option>
            <option value="Izin">📄 Izin</option>
            <option value="Sakit">🏥 Sakit</option>
            <option value="Alfa">❌ Alfa</option>
        </select>
    </div>

    <button type="submit">💾 Simpan Absensi</button>
</form>

<a href="{{ route('presensi.index') }}" class="kembali">← Kembali ke Rekap</a>

<script>
function isiNama() {
    let pilih = document.getElementById('nim');
    let nama = pilih.options[pilih.selectedIndex].getAttribute('data-nama');
    document.getElementById('nama_lengkap').value = nama || '';
}

window.onload = function() {
    let hariIni = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="tanggal"]').value = hariIni;
    isiNama();
};
</script>

</body>
</html>