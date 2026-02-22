<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penitipan - {{ $item->receipt_token ?? $item->name }}</title>
    <style>
        @page {
            size: 80mm auto;
            /* Standard Thermal Printer size */
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            color: #000;
            margin: 0;
            padding: 10mm;
            background-color: #fff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            line-height: 1.4;
            font-size: 12px;
            width: 80mm;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0 0 5px 0;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 900;
        }

        .header p {
            margin: 2px 0;
            font-size: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
            font-size: 11px;
        }

        .qr-section {
            text-align: center;
            margin: 15px 0;
            padding: 15px 0;
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }

        .qr-section img {
            width: 100px;
            height: 100px;
            margin: 0 auto 10px auto;
            display: block;
        }

        .token {
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 3px;
            margin: 5px 0;
        }

        .details h3 {
            font-size: 12px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
            margin: 10px 0 5px 0;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            border-top: 2px dashed #000;
            padding-top: 15px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="no-print"
        style="text-align: center; margin-bottom: 20px; padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0; width: 100%; box-sizing: border-box; font-family: sans-serif;">
        <button onclick="window.print()"
            style="padding: 10px 20px; background: #1e293b; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 14px;">
            🖨️ Cetak Struk (Thermal 80mm)
        </button>
        <p style="margin-top: 10px; font-size: 12px; color: #64748b;">Preview struk diformat khusus untuk Printer
            Kasir/Thermal 80mm.</p>
    </div>

    <div class="receipt-container">
        <div class="header">
            <h1>{{ $app_settings['app_name'] ?? 'PENITIPAN BARANG' }}</h1>
            <p>{{ $app_settings['hero_title'] ?? 'Sistem Manajemen Titip Aman' }}</p>
            <p>{{ $app_settings['contact_address'] ?? 'Jl. Contoh Alamat No. 123, Kota' }}</p>
            <p>Telp: {{ $app_settings['contact_phone'] ?? '0812-3456-7890' }}</p>
        </div>

        <div class="info-row">
            <span>TANGGAL:</span>
            <span>{{ now()->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span>KASIR/ADMIN:</span>
            <span>SISTEM</span>
        </div>
        <div class="info-row">
            <span>RESI:</span>
            <span>PTR-{{ strtoupper(substr(md5($item->id), 0, 6)) }}</span>
        </div>

        <div class="qr-section">
            <p style="font-size: 11px; text-transform: uppercase; margin-bottom: 8px;"><b>KODE / TOKEN PENGAMBILAN</b>
            </p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($item->receipt_token ?? $item->token) }}"
                alt="QR Code Token">
            <div class="token">{{ $item->receipt_token ?? 'N/A' }}</div>
            <p style="font-size: 10px; margin-top: 5px;">Tunjukkan QR/Token ini saat mengambil barang.</p>
        </div>

        <div class="details">
            <h3>DETAIL PENITIP</h3>
            <div class="info-row"><span>Nama:</span> <b>{{ strtoupper($item->user->name) }}</b></div>
            <div class="info-row"><span>ID User:</span>
                <span>USR-{{ str_pad($item->user->id, 4, '0', STR_PAD_LEFT) }}</span></div>

            <br>
            <h3>DETAIL BARANG</h3>
            <div class="info-row"><span>Nama:</span> <b>{{ strtoupper($item->name) }}</b></div>
            <div class="info-row"><span>Kategori:</span> <span>{{ strtoupper($item->item_type ?? '-') }}</span></div>
            <div class="info-row"><span>Merek:</span> <span>{{ strtoupper($item->brand ?? '-') }}</span></div>
            <div class="info-row"><span>Warna:</span> <span>{{ strtoupper($item->color ?? '-') }}</span></div>
            <div class="info-row"><span>Estimasi:</span> <span>Rp
                    {{ number_format($item->estimated_value ?? 0, 0, ',', '.') }}</span></div>
            <div class="info-row" style="flex-direction: column; margin-top: 5px;">
                <span>Catatan/Ciri Khusus:</span>
                <span
                    style="font-size: 10px; margin-top: 2px;">{{ $item->characteristics ?: ($item->notes ?: '-') }}</span>
            </div>
        </div>

        <div class="footer">
            <p>*** TERIMA KASIH ***</p>
            <p style="margin-top: 5px;">Harap simpan struk ini sebagai bukti pengambilan barang yang sah. Barang yang
                tidak diambil dalam 30 hari di luar tanggung jawab kami.</p>
        </div>
    </div>

</body>

</html>