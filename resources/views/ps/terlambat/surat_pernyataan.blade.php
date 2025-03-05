<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .content {
            text-align: left;
            margin-top: 20px;
            line-height: 1.8;
        }
        .signature {
            margin-top: 50px;
        }
        .signature-table {
            width: 100%;
            margin-top: 20px;
            text-align: center;
        }
        .signature-table td {
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>SURAT PERNYATAAN</h3>
        <h4>TIDAK AKAN DATANG TERLAMBAT KE SEKOLAH</h4>

        <div class="content">
            <p>Yang bertanda tangan di bawah ini :</p>
            <p>NIS : {{ $student->nis }}</p>
            <p>Nama &emsp;: {{ $student->name }}</p>
            <p>Rombel &emsp;: {{ $student->rombel->rombel }}</p>
            <p>Rayon &emsp;: {{ $student->rayon->rayon }}</p>
            <br>
            <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak <b>{{ $late_count }} Kali</b> yang mana hal tersebut termasuk ke dalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p>
            <br>
            <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
        </div>

        <p style="text-align: right;">Bogor, {{ now()->format('d F Y') }}</p>

        <div class="signature">
            <table class="signature-table">
                <tr>
                    <td>Peserta Didik,</td>
                    <td>Orang Tua/Wali Peserta Didik,</td>
                </tr>
                <tr>
                    <td>( {{ $student->name }} )</td>
                    <td>( ...................... )</td>
                </tr>
                <tr>
                    <td>Pembimbing Siswa,</td>
                    <td>Kesiswaan,</td>
                </tr>
                <tr>
                    <td>( {{ $student->rayon->user->name }} )</td>
                    <td>( ...................... )</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
