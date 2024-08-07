<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/favicon.png') }}">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .invoice-box {
            max-width: 800px;
            width: 100%;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .print-button {
            text-align: center;
        }

        .print-button button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .print-button button:hover {
            background-color: #45a049;
        }

        .download-button {
            display: none;
            text-align: center;
        }

        .download-button button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .download-button button:hover {
            background-color: #45a049;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: center;
            }

            .print-button {
                display: none;
            }

            .download-button {
                display: block;
            }
        }

        @media print {

            .print-button,
            .download-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('public/assets/img/logo/logo.svg') }}" alt="ProSkill Akademia Logo"
                                    style="width: 100%; max-width: 150px;">
                                <div style=" font-size:12px">Jl. H. Ungar No.2C, Kota Tanjung Pinang,
                                    Kepulauan Riau
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 14px;">{{ $order->nomor_invoice }}<br>
                                    Tanggal: {{ $order->created_at->format('d M Y') }}<br>
                                    Tanggal Cetak: <span id="print-date"></span><br>
                                    Status:
                                    {{ $order->status == 'PAID' ? 'Sukses' : ($order->status == 'SETTLED' ? 'Sukses' : 'Belum Dibayar') }}

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Nama : {{ $order->user->name }}<br>
                                Email : {{ $order->user->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Nama Kelas</td>
                <td>Harga</td>
            </tr>
            <tr class="item">
                <td>{{ $order->KelasTatapMuka->nama_kursus ?? 'Nama kelas tidak tersedia' }}</td>
                <td>{{ number_format($order->price, 0) }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Total: {{ number_format($order->price, 0) }}</td>
            </tr>
        </table>
    </div>
    <div class="print-button">
        <button onclick="window.print()">Cetak Invoice</button>
    </div>
    <div class="download-button">
        <button onclick="downloadPDF()">Unduh Invoice</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script>
        document.getElementById('print-date').innerText = new Date().toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });

        function downloadPDF() {
            html2canvas(document.querySelector('.invoice-box')).then(canvas => {
                let pdf = new jsPDF('p', 'pt', 'a4');
                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, pdf.internal.pageSize.width, canvas
                    .height * (pdf.internal.pageSize.width / canvas.width));
                pdf.save('invoice.pdf');
            });
        }
    </script>
</body>

</html>
