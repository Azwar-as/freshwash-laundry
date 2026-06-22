<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- WELCOME BANNER -->
<div class="card mb-4 animate-fadeInUp" style="opacity:0; background: var(--primary-gradient); color: #fff;">
    <div class="card-body py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold mb-1">Selamat Datang, <?= esc(session()->get('user_nama')) ?>! 👋</h3>
                <p class="mb-0" style="opacity: 0.85;">Kelola usaha laundry Anda dengan mudah melalui dashboard ini.</p>
            </div>
            <div class="col-md-4 text-end">
                <span style="font-size: 3rem; opacity: 0.3;"><i class="bi bi-droplet-fill"></i></span>
            </div>
        </div>
    </div>
</div>

<!-- FLASH MESSAGE -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success animate-fadeInUp" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-1" style="opacity:0">
        <div class="stat-card stat-purple">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value"><?= $totalPelanggan ?></div>
            <div class="stat-label">Total Pelanggan</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-2" style="opacity:0">
        <div class="stat-card stat-blue">
            <div class="stat-icon"><i class="bi bi-receipt"></i></div>
            <div class="stat-value"><?= $transaksiHariIni ?></div>
            <div class="stat-label">Transaksi Hari Ini</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-3" style="opacity:0">
        <div class="stat-card stat-green">
            <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
            <div class="stat-value" style="font-size: 1.4rem;">Rp <?= number_format($pendapatanBulanIni, 0, ',', '.') ?></div>
            <div class="stat-label">Pendapatan Bulan Ini</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-4" style="opacity:0">
        <div class="stat-card stat-orange">
            <div class="stat-icon"><i class="bi bi-tags-fill"></i></div>
            <div class="stat-value"><?= $totalLayananAktif ?></div>
            <div class="stat-label">Layanan Aktif</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- STATUS OVERVIEW -->
    <div class="col-lg-4 animate-fadeInUp animate-delay-3" style="opacity:0">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-pie-chart-fill me-2" style="color: #7c3aed;"></i>Status Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background: #fef3c7; border-radius: 12px;">
                    <div>
                        <div class="fw-bold" style="color: #d97706;">Antrian</div>
                        <small class="text-secondary">Menunggu proses</small>
                    </div>
                    <span class="fs-3 fw-bold" style="color: #d97706;"><?= $statusAntrian ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background: #dbeafe; border-radius: 12px;">
                    <div>
                        <div class="fw-bold" style="color: #2563eb;">Proses</div>
                        <small class="text-secondary">Sedang dikerjakan</small>
                    </div>
                    <span class="fs-3 fw-bold" style="color: #2563eb;"><?= $statusProses ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center p-3" style="background: #dcfce7; border-radius: 12px;">
                    <div>
                        <div class="fw-bold" style="color: #16a34a;">Selesai</div>
                        <small class="text-secondary">Siap diambil</small>
                    </div>
                    <span class="fs-3 fw-bold" style="color: #16a34a;"><?= $statusSelesai ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- RECENT TRANSACTIONS -->
    <div class="col-lg-8 animate-fadeInUp animate-delay-4" style="opacity:0">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2" style="color: #7c3aed;"></i>Transaksi Terakhir</h6>
                <a href="<?= base_url('/transaksi') ?>" class="text-decoration-none" style="font-size: 0.82rem; color: #6366f1; font-weight: 600;">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($transaksiTerakhir)) : ?>
                    <div class="empty-state py-4">
                        <i class="bi bi-inbox" style="font-size: 2.5rem;"></i>
                        <h6 class="text-secondary">Belum ada transaksi</h6>
                    </div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksiTerakhir as $trx) : ?>
                                    <tr>
                                        <td><span class="fw-semibold" style="color: #6366f1;"><?= esc($trx['kode_transaksi']) ?></span></td>
                                        <td><?= esc($trx['nama_pelanggan'] ?? '-') ?></td>
                                        <td><span class="price-tag">Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></span></td>
                                        <td><span class="badge-status badge-<?= $trx['status'] ?>"><?= ucfirst($trx['status']) ?></span></td>
                                        <td class="text-secondary"><?= date('d M Y', strtotime($trx['tanggal_masuk'])) ?></td>
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

<?= $this->section('scripts') ?>
<script>
    // Auto-hide flash messages
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function() { alert.remove(); }, 500);
        });
    }, 4000);
</script>
<?= $this->endSection() ?>
