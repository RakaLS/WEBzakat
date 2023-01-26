<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permata Zakat</title>
</head>
<style>
    @media print {
        @page {
            size: landscape
        }
    }
    @media print and (width: 21cm) and (height: 29.7cm) {
        @page {
            margin: 3cm;
        }
    }
    /* style sheet for "letter" printing */
    @media print and (width: 8.5in) and (height: 11in) {
        @page {
            margin: 1in;
        }
    }

    /* A4 Landscape*/
    @page {
        size: A4 landscape;
        margin: 10%;
    }
</style>

<body>
    <div class="container">
        <h1>Permata Zakat</h1>
        <hr>
        <br><br><br>
        <p>
            Kepada Yth,
        </p>
        <p>
            {{$data->nama}}

        </p>
        <p>
            {{$data->alamat}}
        </p>
        <br>
        <p>Dengan hormat,</p>
        <p style="text-align: justify;">
            Kami segenap jajaran Pimpinan, Direksi, dan Karyawan Yayasan Permata mengucapkan terima kasih yang sebesar – besarnya kepada {{$data->nama}} atas partisipasi dan kerjasamanya untuk kegiatan kami.
            Kami bersyukur mendapatkan bantuan dana dan atensi yang sebesar {{$data->jumlah}} dari pihak {{$data->nama}}. Berkat kerjasamanya, puji syukur kegiatan BERBAGI BERSAMA MELALUI PERMATA ZAKAT kami dapat berjalan dengan lancar tanpa hambatan.
            Demikian surat ucapan terimakasih ini kami sampaikan, atas perhatian Bapak/Ibu kami sampaikan terimakasih yang sebesar besarnya.
        </p>
        <p style="text-align: right;">Surabaya, {{ date('d-m-Y') }}</p>
        <p style="text-align: right;">Hormat Kami,</p>
        <br><br><br>
        <p style="text-align: right;">Direktur Yayasan Permata.</p>
    </div>
    <script>
        // window.print();
    </script>
</body>

</html>