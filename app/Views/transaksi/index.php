<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- FLASH MESSAGE -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success animate-fadeInUp" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger animate-fadeInUp" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- FILTER STATUS -->
<div class="card mb-4 animate-fadeInUp" style="opacity:0">
    <div class="card-body py-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="fw-semibold me-2" style="font-size:0.85rem;">Filter:</span>
            <a href="<?= base_url('/transaksi') ?>" class="btn btn-sm <?= !$filterStatus ? 'btn-primary-gradient' : 'btn-outline-secondary' ?>" style="border-radius:8px;padding:6px 16px;font-size:0.8rem;">Semua</a>
            <a href="<?= base_url('/transaksi?status=antrian') ?>" class="btn btn-sm <?= $filterStatus === 'antrian' ? 'btn-warning' : 'btn-outline-warning' ?>" style="border-radius:8px;padding:6px 16px;font-size:0.8rem;">Antrian</a>
            <a href="<?= base_url('/transaksi?status=proses') ?>" class="btn btn-sm <?= $filterStatus === 'proses' ? 'btn-primary' : 'btn-outline-primary' ?>" style="border-radius:8px;padding:6px 16px;font-size:0.8rem;">Proses</a>
            <a href="<?= base_url('/transaksi?status=selesai') ?>" class="btn btn-sm <?= $filterStatus === 'selesai' ? 'btn-success' : 'btn-outline-success' ?>" style="border-radius:8px;padding:6px 16px;font-size:0.8rem;">Selesai</a>
            <a href="<?= base_url('/transaksi?status=diambil') ?>" class="btn btn-sm <?= $filterStatus === 'diambil' ? 'btn-secondary' : 'btn-outline-secondary' ?>" style="border-radius:8px;padding:6px 16px;font-size:0.8rem;">Diambil</a>
        </div>
    </div>
</div>

<!-- TABLE CARD -->
<div class="card animate-fadeInUp" style="opacity:0; animation-delay: 0.2s">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-receipt me-2" style="color: #7c3aed;"></i>
            Daftar Transaksi
        </h5>
        <a href="<?= base_url('/transaksi/create') ?>" class="btn btn-primary-gradient">
            <i class="bi bi-plus-lg"></i> Transaksi Baru
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($transaksi)) : ?>
            <div class="empty-state">
                <i class="bi bi-receipt"></i>
                <h5>Belum Ada Transaksi</h5>
                <p>Klik "Transaksi Baru" untuk membuat transaksi.</p>
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Tgl Masuk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Kasir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $trx) : ?>
                            <tr>
                                <td><span class="fw-semibold" style="color:#6366f1;"><?= esc($trx['kode_transaksi']) ?></span></td>
                                <td class="fw-semibold"><?= esc($trx['nama_pelanggan'] ?? '-') ?></td>
                                <td class="text-secondary"><?= date('d M Y', strtotime($trx['tanggal_masuk'])) ?></td>
                                <td><span class="price-tag">Rp <?= number_format($trx['total_harga'], 0, ',', '.') ?></span></td>
                                <td><span class="badge-status badge-<?= $trx['status'] ?>"><?= ucfirst($trx['status']) ?></span></td>
                                <td class="text-secondary" style="font-size:0.82rem;"><?= esc($trx['nama_kasir'] ?? '-') ?></td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="<?= base_url('/transaksi/show/' . $trx['id']) ?>" class="btn-action btn-view" title="Detail"><i class="bi bi-eye-fill"></i></a>
                                        <?php if ($trx['status'] !== 'diambil') : ?>
                                            <button type="button" class="btn-action btn-status" title="Update Status"
                                                    onclick="updateStatus(<?= $trx['id'] ?>, '<?= $trx['status'] ?>')">
                                                <i class="bi bi-arrow-right-circle-fill"></i>
                                            </button>
                                        <?php endif; ?>
                                        <button type="button" class="btn-action btn-delete" title="Hapus"
                                                onclick="confirmDelete(<?= $trx['id'] ?>, '<?= esc($trx['kode_transaksi']) ?>')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- STATUS UPDATE MODAL -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-arrow-repeat me-2" style="color:#7c3aed;"></i>Update Status</h5>
                <form id="statusForm" method="POST">
                    <?= csrf_field() ?>
                    <select class="form-select mb-3" id="statusSelect" name="status">
                        <option value="antrian">Antrian</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                        <option value="diambil">Diambil</option>
                    </select>
                    <div class="d-flex gap-3 justify-content-end">
                        <button type="button" class="btn btn-secondary" style="border-radius:10px;" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary-gradient">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;">
            <div class="modal-body text-center p-4">
                <div style="width:70px;height:70px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size:2rem;color:#dc2626;"></i>
                </div>
                <h5 class="fw-bold mb-2">Konfirmasi Hapus</h5>
                <p class="text-secondary mb-0">Hapus transaksi</p>
                <p class="fw-bold mb-4" id="deleteItemName"></p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" style="border-radius:10px;" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="deleteLink" class="btn btn-danger px-4" style="border-radius:10px;">
                        <i class="bi bi-trash-fill me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function updateStatus(id, currentStatus) {
        document.getElementById('statusForm').action = '<?= base_url('/transaksi/update-status/') ?>' + id;
        document.getElementById('statusSelect').value = currentStatus;
        new bootstrap.Modal(document.getElementById('statusModal')).show();
    }

    function confirmDelete(id, kode) {
        document.getElementById('deleteItemName').textContent = '"' + kode + '"?';
        document.getElementById('deleteLink').href = '<?= base_url('/transaksi/delete/') ?>' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(a) {
            a.style.transition = 'opacity 0.5s ease'; a.style.opacity = '0';
            setTimeout(function() { a.remove(); }, 500);
        });
    }, 4000);
</script>
<?= $this->endSection() ?>
