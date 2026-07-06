<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- FLASH MESSAGE -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success animate-fadeInUp" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-4 animate-fadeInUp animate-delay-1" style="opacity:0">
        <div class="stat-card stat-purple">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value"><?= count($pelanggan) ?></div>
            <div class="stat-label">Total Pelanggan</div>
        </div>
    </div>
</div>

<!-- TABLE CARD -->
<div class="card animate-fadeInUp" style="opacity:0; animation-delay: 0.2s">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-people-fill me-2" style="color: #7c3aed;"></i>
            Daftar Pelanggan
        </h5>
        <a href="<?= base_url('/pelanggan/create') ?>" class="btn btn-primary-gradient">
            <i class="bi bi-plus-lg"></i>
            Tambah Pelanggan
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($pelanggan)) : ?>
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <h5>Wah, daftar pelanggan masih kosong</h5>
                <p class="text-secondary mt-2">Mulai catat pelanggan pertama Anda dengan menekan tombol Tambah Pelanggan di atas.</p>
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table table-sm mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Terdaftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($pelanggan as $item) : ?>
                            <tr>
                                <td class="fw-semibold text-secondary"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://i.pravatar.cc/150?u=<?= esc($item['id']) ?>" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                        <div class="fw-semibold"><?= esc($item['nama']) ?></div>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($item['telepon']): ?>
                                        <i class="bi bi-telephone text-secondary me-1"></i>
                                        <?= esc($item['telepon']) ?>
                                    <?php else: ?>
                                        <span class="text-secondary">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="text-secondary" style="font-size: 0.82rem;">
                                        <?= esc($item['alamat'] ?: '-') ?>
                                    </span>
                                </td>
                                <td class="text-secondary" style="font-size: 0.82rem;">
                                    <?= date('d M Y', strtotime($item['created_at'])) ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="<?= base_url('/pelanggan/edit/' . $item['id']) ?>"
                                           class="btn-action btn-edit" title="Ubah Data">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <?php if (session()->get('user_role') === 'admin') : ?>
                                            <button type="button" class="btn-action btn-delete" title="Hapus Pelanggan"
                                                    onclick="confirmDelete(<?= $item['id'] ?>, '<?= esc($item['nama']) ?>')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        <?php endif; ?>
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

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-body text-center p-4">
                <div style="width:70px;height:70px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size:2rem;color:#dc2626;"></i>
                </div>
                <h5 class="fw-bold mb-2">Konfirmasi Hapus</h5>
                <p class="text-secondary mb-0">Apakah Anda yakin ingin menghapus pelanggan</p>
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
    function confirmDelete(id, name) {
        document.getElementById('deleteItemName').textContent = '"' + name + '"?';
        document.getElementById('deleteLink').href = '<?= base_url('/pelanggan/delete/') ?>' + id;
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
