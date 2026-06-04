<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan DALISTA</title>

</head>

<body>

    <!-- HEADER -->

    <div class="header">

        <table style="width:100%; border:none;">

            <tr>

                <td style="width:70px; border:none;">

                    <img src="{{ public_path('images/logo-jateng.jpg') }}"
                    style="width:85px;">

                </td>

                <td style="border:none; text-align:center;">

                    <div class="judul">
                        DINAS TENAGA KERJA DAN TRANSMIGRASI
                    </div>

                    <div class="subjudul">
                        PROVINSI JAWA TENGAH
                    </div>

                    <div class="subjudul-kecil">
                        SISTEM DALISTA (Digitalisasi Layanan Registrasi Tamu)
                    </div>

                    <div class="info">
                        Tanggal Cetak : {{ date('d F Y') }}
                    </div>

                </td>

                <td style="width:90px; border:none;">
                </td>

            </tr>

        </table>

    </div>

    <!-- JUDUL -->

    <h2 class="section-title">
        LAPORAN DATA TAMU DAN SURVEY
    </h2>
    <!-- RINGKASAN -->

    <h3>Ringkasan Statistik</h3>

    <table class="ringkasan">

        <tr>
            <td class="label">Total Kunjungan</td>
            <td>{{ $totalKunjungan }}</td>
        </tr>

        <tr>
            <td class="label">Total Tamu</td>
            <td>{{ $totalTamu }}</td>
        </tr>

        <tr>
            <td class="label">Total Survey</td>
            <td>{{ $totalSurvey }}</td>
        </tr>

        <tr>
            <td class="label">Rating Rata-rata</td>
            <td>{{ number_format($avgRating,1) }}/5.0</td>
        </tr>

        <tr>
            <td class="label">Rerata Harian</td>
            <td>{{ $rerataHarian }}</td>
        </tr>

        <tr>
            <td class="label">Waktu Rata-rata</td>
            <td>{{ $waktuRata }}</td>
        </tr>

        <tr>
            <td class="label">Layanan Terbanyak</td>
            <td>{{ $layananTerbanyak->layanan_diakses ?? '-' }}</td>
        </tr>

    </table>

    <!-- DATA TAMU -->

    <h3>Data Tamu</h3>

    <table class="table-data">

        <tr>
            <th width="40">No</th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Status</th>
        </tr>

        @foreach($guests as $guest)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $guest->nama }}</td>
            <td>{{ $guest->asal_instansi }}</td>
            <td>{{ $guest->status_kunjungan }}</td>
        </tr>

        @endforeach

    </table>

    <!-- DATA SURVEY -->

    <h3>Data Survey</h3>

    <table class="table-data">

        <tr>
            <th width="40">No</th>
            <th>Nama</th>
            <th>Layanan</th>
            <th>Rating</th>
        </tr>

        @foreach($surveys as $survey)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $survey->nama }}</td>
            <td>{{ $survey->layanan_diakses }}</td>
            <td>{{ $survey->rating }}</td>
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

</body>

<style>

        body{
            font-family: DejaVu Sans;
            font-size:12px;
            color:#222;
            margin:20px;
        }

        .header{
            border-bottom:2px solid #000;
            padding-bottom:8px;
            margin-bottom:10px;
        }

        .judul{
            font-size:18px;
            font-weight:bold;
        }

        .subjudul{
            font-size:12px;
            margin-top:1px;
        }

        .subjudul-kecil{
            font-size:10px;
            color:#555;
            margin-top:2px;
        }

        .info{
            font-size:10px;
            color:#666;
            margin-top:4px;
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
            margin-top:10px;
        }

        .table-data th,
        .table-data td{
            border:1px solid #444;
            padding:6px;
        }

        .table-data th{
            background:#f3f4f6;
        }

        .table-data tr{
            page-break-inside:avoid;
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