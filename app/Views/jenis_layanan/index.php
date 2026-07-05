<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    <?php
        $totalLayanan = count($layanan);
        $totalAktif   = count(array_filter($layanan, fn($l) => $l['status'] === 'aktif'));
        $totalNonaktif = $totalLayanan - $totalAktif;
        $avgHarga = $totalLayanan > 0 ? array_sum(array_column($layanan, 'harga')) / $totalLayanan : 0;
    ?>
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-1" style="opacity:0">
        <div class="stat-card stat-purple">
            <div class="stat-icon"><i class="bi bi-tags-fill"></i></div>
            <div class="stat-value"><?= $totalLayanan ?></div>
            <div class="stat-label">Total Layanan</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-2" style="opacity:0">
        <div class="stat-card stat-green">
            <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-value"><?= $totalAktif ?></div>
            <div class="stat-label">Layanan Aktif</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-3" style="opacity:0">
        <div class="stat-card stat-orange">
            <div class="stat-icon"><i class="bi bi-x-circle-fill"></i></div>
            <div class="stat-value"><?= $totalNonaktif ?></div>
            <div class="stat-label">Layanan Nonaktif</div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 animate-fadeInUp animate-delay-4" style="opacity:0">
        <div class="stat-card stat-blue">
            <div class="stat-icon"><i class="bi bi-currency-exchange"></i></div>
            <div class="stat-value">Rp <?= number_format($avgHarga, 0, ',', '.') ?></div>
            <div class="stat-label">Rata-rata Harga</div>
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

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger animate-fadeInUp" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- TABLE CARD -->
<div class="card animate-fadeInUp" style="opacity:0; animation-delay: 0.3s">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-tags-fill me-2" style="color: #7c3aed;"></i>
                Daftar Jenis Layanan
            </h5>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('/jenis-layanan/export-pdf') ?>" target="_blank"
               class="btn btn-sm" title="Export ke PDF"
               style="border-radius:8px; border:1.5px solid #7c3aed; color:#7c3aed; font-size:0.82rem; font-weight:600; padding:6px 14px;">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF
            </a>
            <a href="<?= base_url('/jenis-layanan/create') ?>" class="btn btn-primary-gradient">
                <i class="bi bi-plus-lg"></i>
                Tambah Layanan
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <?php if (empty($layanan)) : ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h5>Belum Ada Data</h5>
                <p>Belum ada jenis layanan yang terdaftar. Klik tombol "Tambah Layanan" untuk menambahkan.</p>
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table" id="tabel-layanan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Satuan</th>
                            <th>Estimasi</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($layanan as $item) : ?>
                            <tr>
                                <td class="fw-semibold text-secondary"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-semibold"><?= esc($item['nama_layanan']) ?></div>
                                </td>
                                <td>
                                    <span class="text-secondary" style="font-size: 0.82rem;">
                                        <?= esc(character_limiter($item['deskripsi'] ?? '-', 50)) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="price-tag">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                </td>
                                <td><?= esc($item['satuan']) ?></td>
                                <td>
                                    <i class="bi bi-clock text-secondary me-1"></i>
                                    <?= $item['estimasi_waktu'] ?> jam
                                </td>
                                <td>
                                    <span class="badge-status badge-<?= $item['status'] ?>">
                                        <?= ucfirst($item['status']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <?php if ($item['status'] === 'aktif') : ?>
                                            <button type="button" class="btn-action btn-add-cart"
                                                    title="Tambah ke Keranjang"
                                                    style="background:#ede9fe; color:#7c3aed; border:1px solid #ddd6fe;"
                                                    data-id="<?= $item['id'] ?>"
                                                    data-nama="<?= esc($item['nama_layanan']) ?>">
                                                <i class="bi bi-cart-plus-fill"></i>
                                            </button>
                                        <?php endif; ?>
                                        <a href="<?= base_url('/jenis-layanan/edit/' . $item['id']) ?>"
                                           class="btn-action btn-edit" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button type="button" class="btn-action btn-delete"
                                                title="Hapus"
                                                onclick="confirmDelete(<?= $item['id'] ?>, '<?= esc($item['nama_layanan']) ?>')">
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

<!-- DELETE CONFIRMATION MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-body text-center p-4">
                <div style="width: 70px; height: 70px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 2rem; color: #dc2626;"></i>
                </div>
                <h5 class="fw-bold mb-2">Konfirmasi Hapus</h5>
                <p class="text-secondary mb-0">Apakah Anda yakin ingin menghapus layanan</p>
                <p class="fw-bold mb-4" id="deleteItemName"></p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px;" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="deleteLink" class="btn btn-danger px-4" style="border-radius: 10px;">
                        <i class="bi bi-trash-fill me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<div id="toastContainer" style="position:fixed; top:20px; right:20px; z-index:9999; display:flex; flex-direction:column; gap:10px;"></div>

<script>
    const CSRF_NAME = '<?= csrf_token() ?>';
    let   CSRF_HASH = '<?= csrf_hash() ?>';
    const BASE_URL  = '<?= base_url() ?>';

    function showToast(msg, type = 'success') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        const isSuccess = type === 'success';
        toast.style.cssText = `
            background: ${isSuccess ? '#f0fdf4' : '#fef2f2'};
            border: 1px solid ${isSuccess ? '#bbf7d0' : '#fecaca'};
            color: ${isSuccess ? '#166534' : '#991b1b'};
            border-radius: 12px; padding: 12px 16px;
            font-size: 0.85rem; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            animation: slideIn 0.3s ease;
            min-width: 280px;
        `;
        toast.innerHTML = `<i class="bi bi-${isSuccess ? 'check-circle-fill' : 'exclamation-circle-fill'}"></i> ${msg}`;
        container.appendChild(toast);
        setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.4s'; setTimeout(() => toast.remove(), 400); }, 3000);
    }

    document.querySelectorAll('.btn-add-cart').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id   = this.dataset.id;
            const nama = this.dataset.nama;
            const me   = this;

            me.disabled = true;
            me.innerHTML = '<i class="bi bi-hourglass-split"></i>';

            const body = new URLSearchParams();
            body.append('id', id);
            body.append('qty', 1);
            body.append(CSRF_NAME, CSRF_HASH);

            fetch(BASE_URL + 'cart/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body,
            })
            .then(r => r.json())
            .then(function(res) {
                CSRF_HASH = res.csrf_hash ?? CSRF_HASH; 
                if (res.status === 'success') {
                    showToast(res.message, 'success');
                    const badge = document.getElementById('cartBadge');
                    if (badge) {
                        badge.textContent = res.cart_count;
                        badge.style.display = 'inline-flex';
                    }
                } else {
                    showToast(res.message ?? 'Terjadi kesalahan.', 'error');
                }
                me.disabled = false;
                me.innerHTML = '<i class="bi bi-cart-plus-fill"></i>';
            })
            .catch(function() {
                showToast('Koneksi gagal.', 'error');
                me.disabled = false;
                me.innerHTML = '<i class="bi bi-cart-plus-fill"></i>';
            });
        });
    });

    function confirmDelete(id, name) {
        document.getElementById('deleteItemName').textContent = '"' + name + '"?';
        document.getElementById('deleteLink').href = '<?= base_url('/jenis-layanan/delete/') ?>' + id;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function() { alert.remove(); }, 500);
        });
    }, 4000);
</script>
<?= $this->endSection() ?>
