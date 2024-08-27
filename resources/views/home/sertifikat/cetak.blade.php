<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        /* Aturan untuk tampilan layar */
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100vw;
            /* Gunakan vw (viewport width) untuk fleksibilitas layar */
            height: 70vh;
            /* Gunakan vh (viewport height) untuk fleksibilitas layar */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url('{{ asset('public/1.png') }}') no-repeat center center;
            background-size: contain;
            /* Menyesuaikan ukuran background untuk preview layar */
        }

        .certificate {
            width: 90%;
            /* Fleksibel sesuai layar */
            height: 90%;
            /* Fleksibel sesuai layar */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 2%;
            /* Menggunakan % untuk padding agar fleksibel sesuai layar */
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            background-color: rgba(255, 255, 255, 0.85);
        }

        .content {
            width: 100%;
            text-align: center;
            position: relative;
        }

        .content h1 {
            margin: 0;
            font-size: 4vw;
            /* Menyesuaikan font berdasarkan lebar viewport */
            color: #007F73;
            margin-top: 5vh;
        }

        .content h2 {
            margin: 0;
            font-size: 3vw;
            color: #007F73;
            margin-top: 2vh;
        }

        .content h3 {
            margin: 0;
            font-size: 1.5vw;
            color: #007F73;
        }

        .content .underline {
            width: 50%;
            height: 2px;
            background-color: #757575;
            margin: 6px auto;
        }

        .content p {
            margin: 2vh 0;
            font-size: 1vw;
            color: #666;
        }

        .content img.photo {
            position: absolute;
            top: 5vh;
            right: -2vw;
            width: 9vw;
            height: 10vh;
            object-fit: cover;
            border-radius: 10%;
            border: 5px solid #fdffff;
        }

        .qr svg {
            width: 8vw;
            height: 8vw;
        }

        .qr {
            position: absolute;
            top: 60vh;
            left: 2vw;
            width: 8vw;
            height: 8vw;
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
            font-size: 1vw;
            color: #333;
            text-align: right;
        }

        .print-button {
            position: absolute;
            top: 2vh;
            right: 2vw;
            padding: 1vh 2vw;
            background-color: #007F73;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #005f59;
        }

        /* Aturan untuk pencetakan */
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

            .certificate {
                width: 100%;
                height: 100%;
                padding: 20mm;
                box-shadow: none;
                /* Hapus shadow jika tidak diinginkan di cetakan */
            }

            .print-button {
                display: none;
                /* Sembunyikan tombol cetak saat mencetak */
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
