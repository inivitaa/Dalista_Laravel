<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan DALISTA</title>

</head>

<body>
<!-- ================= HEADER ================= -->

<div class="header">

    <table width="100%" style="border:none;">

        <tr>

            <td width="90" style="border:none;">
                <img src="{{ public_path('images/logo-jateng.jpg') }}" width="80">
            </td>

            <td style="border:none;text-align:center;">

                <div class="judul">
                    DINAS TENAGA KERJA DAN TRANSMIGRASI
                </div>

                <div class="subjudul">
                    PROVINSI JAWA TENGAH
                </div>

                <div class="subjudul-kecil">
                    SISTEM DALISTA
                </div>

                <div class="subjudul-kecil">
                    (Digitalisasi Layanan Registrasi Tamu)
                </div>

            </td>

            <td width="90" style="border:none;"></td>

        </tr>

    </table>

</div>

<div style="text-align:center; margin-top:2px;">

    <div class="laporan-info">

        <b>Periode :</b>
        {{ $periode ? $periode.' Hari Terakhir' : 'Semua Data' }}

        &nbsp;&nbsp;&nbsp;&nbsp;

        <b>Layanan :</b>
        {{ $layanan ?: 'Semua Layanan' }}

        <br>

        <b>Tanggal Cetak :</b>
        {{ date('d F Y') }}

    </div>

</div>

<hr style="margin-top:8px;margin-bottom:15px;">

<h3 class="judul-section">

Ringkasan Statistik

</h3>

<table width="100%" style="border:none;margin-bottom:25px;">

<tr>

<td width="25%" style="border:none;padding:6px;">

<div class="card">

<div class="card-title">

Total Tamu

</div>

<div class="card-value">

{{ $totalTamu }}

</div>

</div>

</td>

<td width="25%" style="border:none;padding:6px;">

<div class="card">

<div class="card-title">

Total Survey

</div>

<div class="card-value">

{{ $totalSurvey }}

</div>

</div>

</td>

<td width="25%" style="border:none;padding:6px;">

<div class="card">

<div class="card-title">

Rating

</div>

<div class="card-value">

{{ number_format($avgRating,1) }}

★

</div>

</div>

</td>

<td width="25%" style="border:none;padding:6px;">

<div class="card">

<div class="card-title">

Survey

</div>

<div class="card-value">

{{ $persentaseSurvey }}%

</div>

</div>

</td>

</tr>

</table>
<h3 class="judul-section">
    Analisis Singkat
</h3>

<table class="analisis-table">

    <tr>
        <td width="35%">
            Total Kunjungan
        </td>
        <td>
            : {{ $totalKunjungan }} tamu
        </td>
    </tr>

    <tr>
        <td>
            Rating Kepuasan
        </td>
        <td>
            : {{ number_format($avgRating,1) }}/5 ({{ $avgRating >= 4 ? 'Sangat Baik' : ($avgRating >= 3 ? 'Baik' : 'Perlu Peningkatan') }})
        </td>
    </tr>

    <tr>
        <td>
            Survey Terisi
        </td>
        <td>
            : {{ $jumlahIsiSurvey }} dari {{ $totalTamu }} tamu ({{ $persentaseSurvey }}%)
        </td>
    </tr>

    <tr>
        <td>
            Layanan Terbanyak
        </td>
        <td>
            : {{ $layananTerbanyak->layanan_diakses ?? '-' }}
        </td>
    </tr>

    <tr>
        <td>
            Status Terbanyak
        </td>
        <td>
            : {{ $statusTerbanyak }}
        </td>
    </tr>

</table>



<h3 style="margin-top:30px;">Distribusi Status Kunjungan</h3>

<table class="chart-table">

    <tr>
        <td class="chart-label">Menunggu</td>

        <td width="350">

            <div class="bar">

                <div class="bar-fill blue"
                    style="width:{{ $totalTamu ? ($menunggu/$totalTamu)*100 : 0 }}%;">
                </div>

            </div>

        </td>

        <td>{{ $menunggu }}</td>
    </tr>

    <tr>
        <td class="chart-label">Terjadwal</td>

        <td>

            <div class="bar">

                <div class="bar-fill yellow"
                    style="width:{{ $totalTamu ? ($terjadwal/$totalTamu)*100 : 0 }}%;">
                </div>

            </div>

        </td>

        <td>{{ $terjadwal }}</td>
    </tr>

    <tr>
        <td class="chart-label">Datang</td>

        <td>

            <div class="bar">

                <div class="bar-fill green"
                    style="width:{{ $totalTamu ? ($datang/$totalTamu)*100 : 0 }}%;">
                </div>

            </div>

        </td>

        <td>{{ $datang }}</td>
    </tr>

    <tr>
        <td class="chart-label">Selesai</td>

        <td>

            <div class="bar">

                <div class="bar-fill red"
                    style="width:{{ $totalTamu ? ($selesai/$totalTamu)*100 : 0 }}%;">
                </div>

            </div>

        </td>

        <td>{{ $selesai }}</td>
    </tr>

</table>
Setelah pelayanan selesai, 
Anda dapat memberikan
penilaian melalui Survei Kepuasan untuk membantu kami meningkatkan kualitas pelayanan.
    <!-- DATA TAMU -->
<div style="page-break-before: always;"></div>

<h2 class="section-title">
    Data Tamu
</h2>

<p style="margin-bottom:12px;color:#666;font-size:11px;">
Daftar seluruh tamu yang melakukan registrasi pada Sistem DALISTA sesuai filter laporan.
</p>

    <table class="table-data">

        <tr>
            <th width="40">No</th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Keperluan</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>

        @foreach($guests as $guest)

<tr>

    <td align="center">
        {{ $loop->iteration }}
    </td>

    <td>
        {{ $guest->nama }}
    </td>

    <td>
        {{ $guest->asal_instansi ?: '-' }}
    </td>

    <td>
        {{ $guest->keperluan }}
    </td>

    <td>
        {{ $guest->status_kunjungan }}
    </td>

    <td align="center">
        {{ date('d M Y',strtotime($guest->waktu_dibuat)) }}
    </td>

</tr>

@endforeach

    </table>

    <!-- DATA SURVEY -->
    <div style="page-break-before: always;"></div>

    <h2 class="section-title">
    Data Survey Kepuasan
</h2>

<p style="margin-bottom:12px;color:#666;font-size:11px;">
Daftar hasil survei kepuasan masyarakat yang telah dikirimkan melalui Sistem DALISTA.
</p>

    <table class="table-data">

        <tr>
            <th width="40">No</th>
            <th>Nama</th>
            <th>Layanan</th>
            <th>Rating</th>
            <th>Ulasan</th>
        </tr>

        @foreach($surveys as $survey)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $survey->nama }}</td>
            <td>{{ $survey->layanan_diakses }}</td>            
            <td align="center">

                @switch($survey->rating)

                    @case(3)
                        Puas
                        @break

                    @case(2)
                        Baik
                        @break

                    @case(1)
                        Cukup
                        @break

                    @default
                        -

                @endswitch

            </td>
            <td>{{ $survey->ulasan }}</td>
        </tr>

        @endforeach

    </table>

    <!-- TANDA TANGAN -->

    <table class="ttd-table">

        <tr>

            <td></td>

            <td class="ttd">

                Semarang, {{ date('d F Y') }}

                <br><br>

                Administrator DALISTA

                <br><br><br><br>

                _____________________

            </td>

        </tr>

    </table>

    <!-- FOOTER -->

    <div class="footer">

        DALISTA - Digitalisasi Layanan Registrasi Tamu

        <br>

        © {{ date('Y') }}
        Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah

    </div>
<h3 style="margin-top:30px;">Tes QuickChart</h3>

<img
    src="https://quickchart.io/chart?width=500&height=300&c=%7B%22type%22%3A%22pie%22%2C%22data%22%3A%7B%22labels%22%3A%5B%22Menunggu%22%2C%22Datang%22%5D%2C%22datasets%22%3A%5B%7B%22data%22%3A%5B8%2C3%5D%7D%5D%7D%7D"
    width="300">
</body>

<style>
.judul-section{

font-size:17px;

font-weight:bold;

margin-bottom:12px;

}

.card{

border:1px solid #d1d5db;

border-radius:8px;

padding:14px;

text-align:center;

height:70px;

}

.card-title{

font-size:11px;

color:#666;

margin-bottom:8px;

}

.card-value{

font-size:24px;

font-weight:bold;

color:#1d4ed8;

}
.analisis-table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
    margin-bottom:25px;
}

.analisis-table td{
    padding:8px 4px;
    border-bottom:1px solid #e5e7eb;
    vertical-align:top;
}

.chart-table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

.chart-table td{
    border:none;
    padding:8px 4px;
    vertical-align:middle;
}

.chart-label{
    width:120px;
    font-weight:bold;
}

.bar{
    width:100%;
    height:18px;
    background:#e5e7eb;
    border-radius:10px;
    overflow:hidden;
}

.bar-fill{
    height:18px;
    border-radius:10px;
}

.blue{
    background:#2563eb;
}

.yellow{
    background:#f59e0b;
}

.green{
    background:#10b981;
}

.red{
    background:#ef4444;
}

        body{
            font-family: DejaVu Sans;
            font-size:12px;
            color:#222;
            margin:20px;
        }

        .header{
            border-bottom:2px solid #000;
            padding-bottom:8px;
            margin-bottom:8px;
        }
        .laporan-info{
            font-size:11px;
            line-height:1.5;
        }

        .judul{
            font-size:19px;
            font-weight:bold;
            margin-bottom:4px;
        }

        .subjudul{
            font-size:12px;
            margin-top:2px;
        }

        .subjudul-kecil{
            font-size:10px;
            color:#555;
            margin-top:5px;
        }

        .info{
            font-size:10px;
            color:#666;
            margin-top:8px;
        }

        .section-title{
            margin-top:15px;
            margin-bottom:8px;
            font-size:18px;
        }

        h3{
            margin-top:20px;
            margin-bottom:3px;
            font-size:15px;
        }

        .periode{
            line-height:1.6;
            margin-bottom:15px;
        }

        .ringkasan{
            width:70%;
            border-collapse:collapse;
            margin-bottom:20px;
        }

        .ringkasan td{
            border-bottom:1px solid #ddd;
            padding:6px;
        }

        .label{
            width:220px;
            font-weight:bold;
        }

.table-data{

    width:100%;

    border-collapse:collapse;

    margin-top:15px;

    font-size:12px;

}

.table-data th{

    background:#e5e7eb;

    color:#222;

    padding:8px;

    border:1px solid #bdbdbd;

    font-weight:bold;

}

.table-data td{

    padding:5px 7px;
    vertical-align:middle;
    border:1px solid #d6d6d6;

}

.table-data tr:nth-child(even){

    background:#fafafa;

}

        .ttd-table{
            width:100%;
            margin-top:25px;
        }

        .ttd-table td{
            border:none;
        }

        .ttd{
            width:250px;
            text-align:center;
        }

        .footer{
            margin-top:25px;
            border-top:1px solid #ccc;
            padding-top:10px;
            text-align:center;
            font-size:10px;
            color:#666;
        }

    </style>

</html>