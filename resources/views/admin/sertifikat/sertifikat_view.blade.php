<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        img {
            max-width: 50%;
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #ffc107;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #ff9800;
        }
    </style>
</head>

<body>
    <div class="container">

        <img src="{{ asset('public/uploads/' . $sertifikat->img) }}" alt="Gambar Sertifikat">
        <p>{{ $sertifikat->sertifikat_name }}</p>
        <a href="{{ asset('public/uploads/' . $sertifikat->img) }}" class="btn" download="sertifikat.jpg">Download</a>

    </div>
</body>

</html>
