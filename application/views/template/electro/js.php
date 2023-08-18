</body>

<!-- jQuery Plugins -->
<script src="<?= base_url('assets/electro/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('assets/electro/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/electro/') ?>js/slick.min.js"></script>
<script src="<?= base_url('assets/electro/') ?>js/nouislider.min.js"></script>
<script src="<?= base_url('assets/electro/') ?>js/jquery.zoom.min.js"></script>
<script src="<?= base_url('assets/electro/') ?>js/main.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        // Tombol "Scan" diklik
        $('#scanQrCode').on('click', function() {
            $('#qrCodeModal').modal('show'); // Tampilkan modal
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });

        // Menutup modal akan menghentikan pemindai QR code
        $('#qrCodeModal').on('hidden.bs.modal', function() {
            html5QrcodeScanner.clear();
        });

        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            html5QrcodeScanner.clear();
            $('#qrCodeModal').modal('hide'); // Tampilkan modal
            alert('Tunggu sebentar, anda akan dilihkan.')
            window.location.replace(decodedText);
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }
    });
</script>

</html>