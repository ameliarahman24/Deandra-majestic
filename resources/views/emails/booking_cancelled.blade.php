<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Dibatalkan - Deandra Majestic Venue</title>
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
            background: rgba(220, 53, 69, 0.1);
            color: #ff6b6b;
            border: 1px solid rgba(220, 53, 69, 0.2);
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
            color: #ff6b6b !important;
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
            background: transparent;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 30px;
            text-align: center;
            margin-top: 10px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background-color: rgba(255, 255, 255, 0.03);
            border-color: #dfae62;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="brand" href="#">Deandra<span>.</span></a>
            <div>
                <span class="badge">Booking Dibatalkan</span>
            </div>
        </div>
        <div class="content">
            <h2>Pemberitahuan Pembatalan</h2>
            <p>Halo <strong>{{ $booking->nama_mempelai_pria }} & {{ $booking->nama_mempelai_wanita }}</strong>,</p>
            <p>Kami ingin menginformasikan bahwa reservasi wedding venue Anda di Deandra Majestic Venue telah **DIBATALKAN** atau ditolak oleh pihak administrasi kami.</p>
            
            <table class="details-table">
                <tr>
                    <td class="label">ID Booking</td>
                    <td class="value font-mono highlight">#BK-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td class="label">Venue Pilihan</td>
                    <td class="value">{{ $booking->nama_ruangan }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Acara</td>
                    <td class="value">{{ date('d F Y', strtotime($booking->tanggal_acara)) }}</td>
                </tr>
                <tr>
                    <td class="label">Sesi Acara</td>
                    <td class="value">{{ $booking->sesi }}</td>
                </tr>
            </table>

            <p>Pembatalan ini dapat terjadi dikarenakan ketidaksesuaian berkas, pembatalan manual, atau tanggal pilihan Anda sudah terisi penuh oleh acara lain. Silakan periksa kembali jadwal ketersediaan gedung kami di situs web untuk memilih tanggal alternatif atau konsultasikan dengan tim admin kami via WhatsApp.</p>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Deandra,%20saya%20ingin%20bertanya%20mengenai%20pembatalan%20booking%20%23BK-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}" class="btn">Tanya Admin Via WA &rarr;</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Deandra Majestic Venue. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 11px;">Email ini dikirimkan secara otomatis kepada customer yang mengisi form pemesanan.</p>
        </div>
    </div>
</body>
</html>
