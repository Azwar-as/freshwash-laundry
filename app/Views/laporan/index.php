<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- FILTER -->
<div class="card mb-4 animate-fadeInUp" style="opacity:0">
    <div class="card-body">
        <form action="<?= base_url('/laporan') ?>" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="dari" class="form-label">Dari Tanggal</label>
                <input type="date" class="form-control" id="dari" name="dari" value="<?= $dari ?>">
            </div>
            <div class="col-md-4">
                <label for="sampai" class="form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" id="sampai" name="sampai" value="<?= $sampai ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary-gradient w-100">
                    <i class="bi bi-funnel me-1"></i> Filter Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    <div class="col-md-4 animate-fadeInUp animate-delay-1" style="opacity:0">
        <div class="stat-card stat-blue">
            <div class="stat-icon"><i class="bi bi-receipt"></i></div>
            <div class="stat-value"><?= $totalTransaksi ?></div>
            <div class="stat-label">Total Transaksi</div>
        </div>
    </div>
    <div class="col-md-4 animate-fadeInUp animate-delay-2" style="opacity:0">
        <div class="stat-card stat-green">
            <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
            <div class="stat-value" style="font-size:1.4rem;">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></div>
            <div class="stat-label">Total Pendapatan</div>
        </div>
    </div>
    <div class="col-md-4 animate-fadeInUp animate-delay-3" style="opacity:0">
        <div class="stat-card stat-purple">
            <div class="stat-icon"><i class="bi bi-calculator"></i></div>
            <div class="stat-value" style="font-size:1.4rem;">Rp <?= $totalTransaksi > 0 ? number_format($totalPendapatan / $totalTransaksi, 0, ',', '.') : '0' ?></div>
            <div class="stat-label">Rata-rata per Transaksi</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- LAYANAN POPULER -->
    <div class="col-lg-4 animate-fadeInUp animate-delay-3" style="opacity:0">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-trophy-fill me-2" style="color:#d97706;"></i>Layanan Terpopuler</h6>
            </div>
            <div class="card-body">
                <?php if (empty($layananPopuler)) : ?>
                    <p class="text-secondary text-center py-3">Belum ada data</p>
                <?php else : ?>
                    <?php $rank = 1; foreach ($layananPopuler as $lp) : ?>
                        <div class="d-flex align-items-center gap-3 mb-3 p-2" style="background:#f8fafc;border-radius:10px;">
                            <div style="width:32px;height:32px;background:<?= $rank <= 3 ? 'var(--primary-gradient)' : '#e2e8f0' ?>;border-radius:8px;display:flex;align-items:center;justify-content:center;color:<?= $rank <= 3 ? '#fff' : '#64748b' ?>;font-weight:700;font-size:0.8rem;">
                                <?= $rank ?>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size:0.85rem;"><?= esc($lp['nama_layanan'] ?? '-') ?></div>
                                <small class="text-secondary"><?= $lp['total_order'] ?> order</small>
                            </div>
                        </div>
                    <?php $rank++; endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- TABEL LAPORAN -->
    <div class="col-lg-8 animate-fadeInUp animate-delay-4" style="opacity:0">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-table me-2" style="color:#7c3aed;"></i>Detail Transaksi</h6>
            </div>
            <div class="card-body p-0">
                <?php if (empty($transaksi)) : ?>
                    <div class="empty-state py-4">
                        <i class="bi bi-inbox" style="font-size:2.5rem;"></i>
                        <h6 class="text-secondary">Tidak ada transaksi di periode ini</h6>
                    </div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($transaksi as $trx) : ?>
                                    <tr>
                                        <td class="text-secondary"><?= $no++ ?></td>
                                        <td><span class="fw-semibold" style="color:#6366f1;"><?= esc($trx['kode_transaksi']) ?></span></td>
                                        <td><?= esc($trx['nama_pelanggan'] ?? '-') ?></td>
                                        <td class="text-secondary"><?= date('d M Y', strtotime($trx['tanggal_masuk'])) ?></td>
                                        <td><span class="badge-status badge-<?= $trx['status'] ?>"><?= ucfirst($trx['status']) ?></span></td>
                                        <td class="price-tag">Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
