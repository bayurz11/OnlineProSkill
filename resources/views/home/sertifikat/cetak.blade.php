<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
            /* Hapus margin default */
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 297mm;
            height: 210mm;
            display: flex;
            background: url('{{ asset('public/1.png') }}') no-repeat center center;
            background-size: cover;
        }

        .certificate {
            width: 100%;
            max-width: 100%;
            height: 100%;
            max-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 20mm;
            /* Ganti ke mm untuk ukuran yang konsisten saat mencetak */
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            max-width: 297mm;
            /* Menentukan lebar maksimal sesuai ukuran kertas A4 landscape */
            max-height: 210mm;
            /* Menentukan tinggi maksimal sesuai ukuran kertas A4 landscape */
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
            margin-top: 20mm;
        }

        .content h2 {
            margin: 0;
            font-size: 60px;
            color: #007F73;
            margin-top: 10mm;
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
            margin: 10mm 0;
            font-size: 18px;
            color: #666;
        }

        .content img.photo {
            position: absolute;
            top: 15mm;
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
            top: 130mm;
            left: 15mm;
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

        .print-button {
            position: fixed;
            /* Ganti absolute dengan fixed */
            bottom: 20px;
            /* Tempatkan tombol di bawah */
            left: 50%;
            /* Pusatkan secara horizontal */
            transform: translateX(-50%);
            /* Geser setengah lebar tombol ke kiri untuk memusatkan */
            padding: 10px 20px;
            background-color: #007F73;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #005f59;
        }

        @media print {

            body,
            html {
                -webkit-print-color-adjust: exact;
                /* Safari dan Chrome */
                print-color-adjust: exact;
                /* Firefox */
                width: 297mm;
                /* Pastikan body mengikuti ukuran A4 landscape */
                height: 210mm;
                margin: 0;
                /* Hapus margin saat mencetak */
                background: url('{{ asset('public/1.png') }}') no-repeat center center !important;
                background-size: cover !important;
            }

            .print-button {
                display: none;
                /* Sembunyikan tombol cetak saat mencetak */
            }

            .certificate {
                box-shadow: none;
                /* Hapus shadow jika tidak diinginkan di cetakan */
            }
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="content">
            <h1>SERTIFIKAT</h1>
            <div class="underline"></div>
            <p>{{ $sertifikat_id }}</p>
            @if ($profile && $profile->gambar)
                @if (strpos($profile->gambar, 'googleusercontent') !== false)
                    <img class="photo" src="{{ $profile->gambar }}" alt="Foto Peserta">
                @else
                    <img class="photo" src="{{ asset('public/uploads/' . $profile->gambar) }}" alt="Foto Peserta">
                @endif
            @endif

            <div class="qr">{!! $qrCode !!}</div>
            <h2>{{ $user->name }}</h2>
            <p>Atas Kelulusannya Pada Kelas</p>
            <h3>{{ $namaKursus }}</h3>
        </div>
    </div>
    <button class="print-button" onclick="window.print()">Cetak Sertifikat</button>
</body>

</html>
