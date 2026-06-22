<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- TRANSAKSI HEADER -->
        <div class="card mb-4 animate-fadeInUp" style="opacity:0">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-receipt me-2" style="color: #7c3aed;"></i>
                    <?= esc($transaksi['kode_transaksi']) ?>
                </h5>
                <a href="<?= base_url('/transaksi') ?>" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <table style="font-size:0.88rem;">
                            <tr>
                                <td class="text-secondary pe-3 pb-2">Pelanggan</td>
                                <td class="fw-semibold pb-2">: <?= esc($transaksi['nama_pelanggan'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <td class="text-secondary pe-3 pb-2">Telepon</td>
                                <td class="pb-2">: <?= esc($transaksi['telepon'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <td class="text-secondary pe-3 pb-2">Kasir</td>
                                <td class="pb-2">: <?= esc($transaksi['nama_kasir'] ?? '-') ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table style="font-size:0.88rem;">
                            <tr>
                                <td class="text-secondary pe-3 pb-2">Tgl. Masuk</td>
                                <td class="pb-2">: <?= date('d M Y', strtotime($transaksi['tanggal_masuk'])) ?></td>
                            </tr>
                            <tr>
                                <td class="text-secondary pe-3 pb-2">Tgl. Selesai</td>
                                <td class="pb-2">: <?= $transaksi['tanggal_selesai'] ? date('d M Y', strtotime($transaksi['tanggal_selesai'])) : '-' ?></td>
                            </tr>
                            <tr>
                                <td class="text-secondary pe-3 pb-2">Status</td>
                                <td class="pb-2">: <span class="badge-status badge-<?= $transaksi['status'] ?>"><?= ucfirst($transaksi['status']) ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <?php if ($transaksi['catatan']): ?>
                        <div class="col-12">
                            <div class="p-3" style="background:#f1f5f9;border-radius:10px;font-size:0.85rem;">
                                <strong>Catatan:</strong> <?= esc($transaksi['catatan']) ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- DETAIL ITEM -->
        <div class="card animate-fadeInUp" style="opacity:0; animation-delay:0.2s">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-list-check me-2" style="color:#7c3aed;"></i>Item Layanan</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Layanan</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($detail as $item) : ?>
                                <tr>
                                    <td class="fw-semibold text-secondary"><?= $no++ ?></td>
                                    <td class="fw-semibold"><?= esc($item['nama_layanan'] ?? '-') ?></td>
                                    <td>Rp <?= number_format($item['harga'] ?? 0, 0, ',', '.') ?>/<?= esc($item['satuan'] ?? '') ?></td>
                                    <td><?= $item['jumlah'] ?> <?= esc($item['satuan'] ?? '') ?></td>
                                    <td class="price-tag">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold" style="font-size:1.1rem;">Total Harga:</td>
                                <td class="price-tag" style="font-size:1.2rem;font-weight:800;">Rp <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
