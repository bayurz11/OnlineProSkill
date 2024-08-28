<!DOCTYPE html>
<html>

<head>
    <title>Halaman Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f8fafc;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background-color: #636b6f;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                <img src="assets/img/others/error_img.svg" alt="img" class="injectable">
                Halaman Tidak Ditemukan - 404
            </div>
            <a href="{{ route('home') }}" class="btn">Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>
