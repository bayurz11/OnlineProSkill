<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            box-sizing: border-box;
        }

        .certificate {
            background: url('{{ asset('public/1.png') }}') no-repeat center center;
            background-size: cover;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20mm;
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
            font-size: 40px;
            color: #007F73;
            margin-top: 20mm;
        }

        .content h2 {
            margin: 0;
            font-size: 30px;
            color: #007F73;
            margin-top: 10mm;
        }

        .content h3 {
            margin: 0;
            font-size: 15px;
            color: #007F73;
        }

        .content .underline {
            width: 50%;
            height: 2px;
            background-color: #757575;
            margin: 6px auto;
        }

        .content p {
            margin: 10mm 0;
            font-size: 9px;
            color: #666;
        }

        .content img.photo {
            position: absolute;
            top: 20px;
            right: -26px;
            width: 50mm;
            height: 60mm;
            object-fit: cover;
            border-radius: 10%;
            border: 5px solid #fdffff;
        }

        .content img.qr {
            position: absolute;
            top: 100mm;
            left: 10mm;
            width: 45mm;
            height: 45mm;
            object-fit: cover;
            border: 5px solid #fdffff;
        }

        .signature {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .signature p {
            margin: 0;
            font-size: 9px;
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
            <p>ID : {{ $certificateId }}</p>
            @if ($profile && $profile->gambar)
                @if (strpos($profile->gambar, 'googleusercontent') !== false)
                    <img class="photo" src="{{ $profile->gambar }}" alt="Foto Peserta">
                @else
                    <img class="photo" src="{{ asset('public/uploads/' . $profile->gambar) }}" alt="Foto Peserta">
                @endif
            @endif
            <img class="qr" src="{{ asset('public/3.jpg') }}" alt="QR Code">
            <h2>{{ $user->name }}</h2>
            <p>Atas Kelulusannya Pada Kelas</p>
            <h3>{{ $coursename }}</h3>
        </div>
    </div>
</body>

</html>
