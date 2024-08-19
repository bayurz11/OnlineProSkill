<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
</head>

<body>
    <div class="certificate"
        style="
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
        position: relative;
    ">
        <div class="content"
            style="
            width: 100%;
            text-align: center;
            position: relative;
        ">
            <h1
                style="
                margin: 0;
                font-size: 80px;
                color: #007F73;
                margin-top: 90px;
            ">
                SERTIFIKAT</h1>
            <div class="underline"
                style="
                width: 50%;
                height: 2px;
                background-color: #757575;
                margin: 6px auto;
            ">
            </div>
            <p
                style="
                margin: 20px 0;
                font-size: 18px;
                color: #666;
            ">
                ID : 122222a</p>
            @if ($profile && $profile->gambar)
                @if (strpos($profile->gambar, 'googleusercontent') !== false)
                    <img class="photo" src="{{ $profile->gambar }}" alt="Foto Peserta"
                        style="
                        position: absolute;
                        top: 65px;
                        right: -26px;
                        width: 180px;
                        height: 200px;
                        object-fit: cover;
                        border-radius: 10%;
                        border: 5px solid #fdffff;
                    ">
                @else
                    <img class="photo" src="{{ asset('public/uploads/' . $profile->gambar) }}" alt="Foto Peserta"
                        style="
                        position: absolute;
                        top: 65px;
                        right: -26px;
                        width: 180px;
                        height: 200px;
                        object-fit: cover;
                        border-radius: 10%;
                        border: 5px solid #fdffff;
                    ">
                @endif
            @endif

            <div class="qr"
                style="
                position: absolute;
                top: 398px;
                left: 34px;
                width: 180px;
                height: 180px;
                border: 5px solid #fdffff;
                border-radius: 10px;
            ">
                {!! $qrCode !!}</div>
            <h2
                style="
                margin: 0;
                font-size: 60px;
                color: #007F73;
                margin-top: 20px;
            ">
                {{ $user->name }}</h2>
            <p
                style="
                margin: 20px 0;
                font-size: 18px;
                color: #666;
            ">
                Atas Kelulusannya Pada Kelas</p>
            <h3
                style="
                margin: 0;
                font-size: 30px;
                color: #007F73;
            ">
                Tes Qr</h3>
        </div>
    </div>

    <!-- Button to Print the Certificate -->
    <button class="print-button" onclick="window.print()"
        style="
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #007F73;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    ">Cetak
        Sertifikat</button>
</body>

</html>
