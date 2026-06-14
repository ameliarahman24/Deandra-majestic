<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Dikonfirmasi - Deandra Majestic Venue</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #070708;
            color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #111115;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .header {
            background-color: #121214;
            padding: 40px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        }
        .brand {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        .brand span {
            color: #dfae62;
        }
        .badge {
            display: inline-block;
            background: rgba(25, 135, 84, 0.1);
            color: #5cdb7d;
            border: 1px solid rgba(25, 135, 84, 0.2);
            font-size: 12px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 15px;
        }
        .content {
            padding: 40px;
        }
        h2 {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            margin-top: 0;
            margin-bottom: 15px;
        }
        p {
            font-size: 15px;
            line-height: 1.6;
            color: #7c7c85;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            background-color: rgba(255, 255, 255, 0.01);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.03);
        }
        .details-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.02);
            font-size: 14px;
        }
        .details-table tr:last-child td {
            border-bottom: none;
        }
        .details-table td.label {
            color: #7c7c85;
            font-weight: 500;
            width: 40%;
        }
        .details-table td.value {
            color: #ffffff;
            font-weight: 700;
            text-align: right;
        }
        .highlight {
            color: #dfae62 !important;
        }
        .price-highlight {
            font-size: 18px;
            color: #dfae62;
            font-weight: 800;
        }
        .footer {
            background-color: #121214;
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.03);
            font-size: 12px;
            color: #5c5c64;
        }
        .footer p {
            font-size: 12px;
            color: #5c5c64;
            margin: 0;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #dfae62 0%, #b8860b 100%);
            color: #070708 !important;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 30px;
            text-align: center;
            margin-top: 10px;
            box-shadow: 0 8px 20px rgba(223, 174, 98, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="brand" href="#">Deandra<span>.</span></a>
            <div>
                <span class="badge">Booking Dikonfirmasi</span>
            </div>
        </div>
        <div class="content">
            <h2>Kabar Bahagia!</h2>
            <p>Halo <strong><?php echo e($booking->nama_mempelai_pria); ?> & <?php echo e($booking->nama_mempelai_wanita); ?></strong>,</p>
            <p>Dengan senang hati kami menginformasikan bahwa reservasi wedding venue Anda telah **DISETUJUI** dan dikonfirmasi oleh tim administrator Deandra Majestic Venue.</p>
            
            <table class="details-table">
                <tr>
                    <td class="label">ID Booking</td>
                    <td class="value font-mono highlight">#BK-<?php echo e(str_pad($booking->id, 4, '0', STR_PAD_LEFT)); ?></td>
                </tr>
                <tr>
                    <td class="label">Venue Pilihan</td>
                    <td class="value"><?php echo e($booking->nama_ruangan); ?></td>
                </tr>
                <tr>
                    <td class="label">Tanggal Acara</td>
                    <td class="value"><?php echo e(date('d F Y', strtotime($booking->tanggal_acara))); ?></td>
                </tr>
                <tr>
                    <td class="label">Sesi Acara</td>
                    <td class="value"><?php echo e($booking->sesi); ?></td>
                </tr>
                <tr>
                    <td class="label">Tema Dekorasi</td>
                    <td class="value"><?php echo e($booking->tema_dekorasi); ?></td>
                </tr>
                <tr>
                    <td class="label">Estimasi Tamu</td>
                    <td class="value"><?php echo e($booking->estimasi_tamu); ?> Pax</td>
                </tr>
                <tr>
                    <td class="label">Total Estimasi Biaya</td>
                    <td class="value price-highlight">Rp <?php echo e(number_format($booking->total_estimasi, 0, ',', '.')); ?></td>
                </tr>
                <tr>
                    <td class="label">Uang Muka (DP 30%)</td>
                    <td class="value price-highlight highlight">Rp <?php echo e(number_format($booking->total_estimasi * 0.3, 0, ',', '.')); ?></td>
                </tr>
            </table>

            <p>Untuk mengamankan tanggal pernikahan Anda, mohon untuk segera melakukan pembayaran Down Payment (DP) sebesar 30% dan mengunggah bukti transfer atau menghubungi perwakilan kami melalui tombol WhatsApp di bawah ini.</p>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Deandra,%20saya%20ingin%20mengonfirmasi%20pembayaran%20DP%20untuk%20booking%20%23BK-<?php echo e(str_pad($booking->id, 4, '0', STR_PAD_LEFT)); ?>" class="btn">Hubungi Kami &rarr;</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> Deandra Majestic Venue. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 11px;">Email ini dikirimkan secara otomatis kepada customer yang mengisi form pemesanan.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\semester 4\Deandra Majestic Final\buruan-nikah\resources\views/emails/booking_confirmed.blade.php ENDPATH**/ ?>