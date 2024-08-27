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
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            /* Background color to distinguish the certificate area */
            overflow: hidden;
            /* Prevents scroll bars from appearing */
        }

        .certificate-container {
            width: 148.5mm;
            /* Half of 297mm */
            height: 105mm;
            /* Half of 210mm */
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('{{ asset('public/1.png') }}') no-repeat center center;
            background-size: cover;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
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
            padding: 10mm;
            /* Half of 20mm */
            box-sizing: border-box;
            position: relative;
        }

        .content {
            width: 100%;
            text-align: center;
            position: relative;
        }

        .content h1 {
            margin: 0;
            font-size: 40px;
            /* Half of 80px */
            color: #007F73;
            margin-top: 10mm;
            /* Half of 20mm */
        }

        .content h2 {
            margin: 0;
            font-size: 30px;
            /* Half of 60px */
            color: #007F73;
            margin-top: 5mm;
            /* Half of 10mm */
        }

        .content h3 {
            margin: 0;
            font-size: 15px;
            /* Half of 30px */
            color: #007F73;
        }

        .content .underline {
            width: 50%;
            height: 1px;
            /* Half of 2px */
            background-color: #757575;
            margin: 3px auto;
            /* Half of 6px */
        }

        .content p {
            margin: 5mm 0;
            /* Half of 10mm */
            font-size: 9px;
            /* Half of 18px */
            color: #666;
        }

        .content img.photo {
            position: absolute;
            top: 7.5mm;
            /* Half of 15mm */
            right: -13px;
            /* Half of -26px */
            width: 90px;
            /* Half of 180px */
            height: 100px;
            /* Half of 200px */
            object-fit: cover;
            border-radius: 10%;
            border: 2.5px solid #fdffff;
            /* Half of 5px */
        }

        .qr svg {
            width: 75px;
            /* Half of 150px */
            height: 75px;
            /* Half of 150px */
        }

        .qr {
            position: absolute;
            top: 65mm;
            /* Half of 130mm */
            left: 7.5mm;
            /* Half of 15mm */
            width: 75px;
            /* Half of 150px */
            height: 75px;
            /* Half of 150px */
            object-fit: cover;
            border: 2.5px solid #fdffff;
            /* Half of 5px */
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
            font-size: 9px;
            /* Half of 18px */
            color: #333;
            text-align: right;
        }

        .print-button {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: #ffc107;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #ff9800;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            body,
            html {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                width: 297mm;
                /* A4 landscape */
                height: 210mm;
                margin: 0;
                background: url('{{ asset('public/1.png') }}') no-repeat center center !important;
                background-size: cover !important;
            }

            .certificate-container {
                width: 297mm;
                height: 210mm;
                box-shadow: none;
            }

            .certificate {
                padding: 20mm;
                max-width: 297mm;
                max-height: 210mm;
            }

            .content h1 {
                font-size: 80px;
                margin-top: 20mm;
            }

            .content h2 {
                font-size: 60px;
                margin-top: 10mm;
            }

            .content h3 {
                font-size: 30px;
            }

            .content .underline {
                height: 2px;
                margin: 6px auto;
            }

            .content p {
                margin: 10mm 0;
                font-size: 18px;
            }

            .content img.photo {
                top: 15mm;
                right: -26px;
                width: 180px;
                height: 200px;
                border: 5px solid #fdffff;
            }

            .qr {
                top: 130mm;
                left: 15mm;
                width: 150px;
                height: 150px;
                border: 5px solid #fdffff;
            }

            .qr svg {
                width: 150px;
                height: 150px;
            }

            .signature p {
                font-size: 18px;
            }

            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="certificate-container">
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
    </div>
    <button class="print-button" onclick="window.print()">Cetak Sertifikat</button>
</body>

</html>
