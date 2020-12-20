<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ANDIRI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <img class="wave-img1" src="img/wave1.png" alt="">
        <img class="wave-img2" src="img/wave2.png" alt="">
        <h1>SCAN UNTUK ABSEN</h1>
    </div>
    <div class="qr">
        {!! QrCode::size(200)->generate($kelas->id); !!}
    </div>
    <div class="footer">
        <p>Absensi QR Code &#169 2020, Andiri</p>
    </div>
</body>
</html>
