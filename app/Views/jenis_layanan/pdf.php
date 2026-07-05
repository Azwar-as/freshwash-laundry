<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk Jasa Laundry - FreshWash</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #fff;
        }

        .header {
            background: linear-gradient(135deg, #4338ca, #7c3aed);
            color: white;
            padding: 20px 30px;
            margin-bottom: 20px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .brand-name {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .brand-sub {
            font-size: 10px;
            opacity: 0.85;
            margin-top: 2px;
        }

        .doc-info {
            text-align: right;
            font-size: 9px;
            opacity: 0.9;
        }

        .doc-info .doc-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .divider {
            border: none;
            border-top: 2px solid #4338ca;
            margin: 0 30px 16px;
        }

        .section-label {
            margin: 0 30px 8px;
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-box {
            margin: 0 30px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px 16px;
            display: flex;
            gap: 24px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item .val {
            font-size: 18px;
            font-weight: bold;
            color: #4338ca;
        }

        .summary-item .lbl {
            font-size: 9px;
            color: #64748b;
        }

        table {
            width: calc(100% - 60px);
            margin: 0 30px 20px;
            border-collapse: collapse;
            font-size: 10px;
        }

        thead tr {
            background: #4338ca;
            color: white;
        }

        thead th {
            padding: 9px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        tbody tr:hover {
            background: #ede9fe;
        }

        tbody td {
            padding: 8px 10px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .badge-aktif {
            background: #dcfce7;
            color: #166534;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: 600;
        }

        .badge-nonaktif {
            background: #fee2e2;
            color: #991b1b;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: 600;
        }

        .price {
            font-weight: 600;
            color: #4338ca;
        }

        .no-col { width: 30px; text-align: center; color: #64748b; }
        .nama-col { width: 22%; }
        .desc-col { width: 28%; color: #64748b; }
        .harga-col { width: 14%; }
        .satuan-col { width: 9%; text-align: center; }
        .estimasi-col { width: 10%; text-align: center; }
        .status-col { width: 10%; text-align: center; }

        .footer {
            margin: 10px 30px 0;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9px;
            color: #94a3b8;
        }

        .footer .watermark {
            font-weight: 600;
            color: #4338ca;
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <div class="header">
        <table style="width:100%; margin:0; border:none; background:transparent;">
            <tr>
                <td style="color:white; padding:0;">
                    <div class="brand-name">&#9901; FreshWash Laundry</div>
                    <div class="brand-sub">Sistem Manajemen Laundry Profesional</div>
                </td>
                <td style="text-align:right; color:white; padding:0; font-size:9px; opacity:0.9;">
                    <div style="font-size:13px; font-weight:bold; margin-bottom:4px;">DAFTAR PRODUK JASA LAUNDRY</div>
                    <div>Tanggal Cetak : <?= date('d F Y, H:i') ?> WIB</div>
                    <div>Dicetak oleh : <?= esc(session()->get('user_nama') ?? 'Admin') ?></div>
                </td>
            </tr>
        </table>
    </div>

    <hr class="divider">

    <div class="section-label">Ringkasan Data</div>
    <table style="width: calc(100% - 60px); margin: 0 30px 16px; border:none;">
        <tr>
            <td style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:12px 16px; text-align:center; width:25%;">
                <div style="font-size:18px; font-weight:bold; color:#4338ca;"><?= $totalLayanan ?></div>
                <div style="font-size:9px; color:#64748b;">Total Layanan</div>
            </td>
            <td style="width:4%;"></td>
            <td style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:12px 16px; text-align:center; width:25%;">
                <div style="font-size:18px; font-weight:bold; color:#16a34a;"><?= $totalAktif ?></div>
                <div style="font-size:9px; color:#64748b;">Layanan Aktif</div>
            </td>
            <td style="width:4%;"></td>
            <td style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:12px 16px; text-align:center; width:25%;">
                <div style="font-size:18px; font-weight:bold; color:#dc2626;"><?= $totalNonaktif ?></div>
                <div style="font-size:9px; color:#64748b;">Layanan Nonaktif</div>
            </td>
            <td style="width:4%;"></td>
            <td style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:12px 16px; text-align:center; width:25%;">
                <div style="font-size:13px; font-weight:bold; color:#7c3aed;">Rp <?= number_format($avgHarga, 0, ',', '.') ?></div>
                <div style="font-size:9px; color:#64748b;">Rata-rata Harga</div>
            </td>
        </tr>
    </table>

    <div class="section-label">Detail Layanan</div>
    <table>
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th class="nama-col">Nama Layanan</th>
                <th class="desc-col">Deskripsi</th>
                <th class="harga-col">Harga</th>
                <th class="satuan-col">Satuan</th>
                <th class="estimasi-col">Estimasi</th>
                <th class="status-col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($layanan as $item) : ?>
                <tr>
                    <td class="no-col"><?= $no++ ?></td>
                    <td class="nama-col" style="font-weight:600;"><?= esc($item['nama_layanan']) ?></td>
                    <td class="desc-col" style="font-size:9px;"><?= esc(substr($item['deskripsi'] ?? '-', 0, 80)) ?><?= strlen($item['deskripsi'] ?? '') > 80 ? '...' : '' ?></td>
                    <td class="harga-col price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td class="satuan-col"><?= esc($item['satuan']) ?></td>
                    <td class="estimasi-col"><?= $item['estimasi_waktu'] ?> jam</td>
                    <td class="status-col">
                        <span class="badge-<?= $item['status'] ?>">
                            <?= ucfirst($item['status']) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <div>Dokumen ini digenerate otomatis oleh sistem FreshWash Laundry</div>
        <div class="watermark">FreshWash &copy; <?= date('Y') ?></div>
    </div>

</body>
</html>
