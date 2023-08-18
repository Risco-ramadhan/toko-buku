<!DOCTYPE html>
<html>

<head>
    <title>Cetak QR Code</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        #container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            height: 100%;
        }

        #qrcode {
            margin: 20px auto;
            display: block;
        }

        h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        i {
            font-style: italic;
            color: #666;
        }

        ol {
            text-align: left;
            padding-left: 20px;
        }

        p {
            font-size: 11pt;
            margin-bottom: 0;
        }

        ol li {
            margin-bottom: .5em;
            font-size: 10pt;
        }
    </style>
</head>

<body>
    <div id="container">
        <h1>QR Code</h1>
        <p>Buku: <i><?= $nama_barang ?></i></p>
        <div id="qrcode"></div>
        <p>Untuk memindai QR code, ikuti langkah-langkah berikut:</p>
        <ol>
            <li>Buka aplikasi pembaca QR code di smartphone Anda.</li>
            <li>Arahkan kamera ponsel Anda ke QR code yang ditampilkan di atas.</li>
            <li>Aplikasi pembaca QR code akan mendeteksi QR code dan menampilkan informasinya.</li>
        </ol>
    </div>

    <script>
        $(document).ready(function() {
            var qr = new QRCode(document.getElementById("qrcode"), {
                text: "<?= base_url('home/detail/' . $qr) ?>",
                width: 200,
                height: 200,
            });
        });
    </script>
</body>

</html>