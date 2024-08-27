<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        @page {
            size: A4 landscape;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        .certificate {
            background: url('{{ asset('public/1.png') }}') no-repeat center center;
            background-size: cover;
            width: 1000px;
            height: 707px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 50px;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content {
            width: 100%;
            text-align: center;
            position: relative;
        }

        .content h1 {
            margin: 0;
            font-size: 80px;
            color: #007F73;
            margin-top: 90px;
        }

        .content h2 {
            margin: 0;
            font-size: 60px;
            color: #007F73;
            margin-top: 20px;
        }

        .content h3 {
            margin: 0;
            font-size: 30px;
            color: #007F73;
        }

        .content .underline {
            width: 50%;
            height: 2px;
            background-color: #757575;
            margin: 6px auto;
        }

        .content p {
            margin: 20px 0;
            font-size: 18px;
            color: #666;
        }

        .content img.photo {
            position: absolute;
            top: 65px;
            right: -26px;
            width: 180px;
            height: 200px;
            object-fit: cover;
            border-radius: 10%;
            border: 5px solid #fdffff;
        }

        .qr svg {
            width: 150px;
            height: 150px;

        }

        .qr {
            position: absolute;
            top: 420px;
            left: 15px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #fdffff;
            border-radius: 10px;
        }

        .signature {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .signature p {
            margin: 0;
            font-size: 18px;
            color: #333;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="content">
            <h1>SERTIFIKAT</h1>
            <div class="underline"></div>
            <p>ID : {{ $sertifikat->sertifikat_id }}</p>
            @if ($profile && !empty($profile->gambar))
                @if (strpos($profile->gambar, 'googleusercontent') !== false)
                    <!-- Gambar yang di-hosting oleh Google -->
                    <img class="photo" src="{{ $profile->gambar }}" alt="Foto Peserta">
                @else
                    <!-- Gambar yang di-hosting di server lokal -->
                    <img class="photo" src="{{ asset('public/uploads/' . $profile->gambar) }}" alt="Foto Peserta">
                @endif
            @endif


            <div class="qr">{!! $qrCode !!}</div>
            <h2>{{ $sertifikat->name }}</h2>
            <p>Atas Kelulusannya Pada Kelas</p>
            <h3>{{ $sertifikat->course->nama_kursus }}</h3>

        </div>
    </div>
</body>

</html>
