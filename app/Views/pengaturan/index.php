<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success animate-fadeInUp" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="row">
    <!-- PENGATURAN MENU -->
    <div class="col-md-4 col-lg-3 animate-fadeInUp" style="opacity:0">
        <div class="card mb-4">
            <div class="card-body p-0">
                <div class="list-group list-group-flush" style="border-radius:16px;">
                    <a href="<?= base_url('/pengaturan') ?>" class="list-group-item list-group-item-action p-3 fw-semibold active" style="background:var(--primary-gradient);color:#fff;border:none;">
                        <i class="bi bi-shop me-2"></i> Pengaturan Toko
                    </a>
                    <a href="<?= base_url('/pengaturan/profile') ?>" class="list-group-item list-group-item-action p-3 fw-semibold text-secondary" style="border:none;">
                        <i class="bi bi-person-badge me-2"></i> Profil Saya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- PENGATURAN TOKO FORM -->
    <div class="col-md-8 col-lg-9 animate-fadeInUp animate-delay-1" style="opacity:0">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0 fw-bold"><i class="bi bi-shop me-2" style="color: #7c3aed;"></i>Pengaturan Toko</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('/pengaturan/update') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="nama_toko" class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="<?= esc($settings['nama_toko'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="jam_buka" class="form-label">Jam Operasional</label>
                            <input type="text" class="form-control" id="jam_buka" name="jam_buka" value="<?= esc($settings['jam_buka'] ?? '') ?>" placeholder="Misal: 08:00 - 20:00">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="telepon_toko" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="telepon_toko" name="telepon_toko" value="<?= esc($settings['telepon_toko'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email_toko" class="form-label">Email Kontak</label>
                            <input type="email" class="form-control" id="email_toko" name="email_toko" value="<?= esc($settings['email_toko'] ?? '') ?>">
                        </div>
                        
                        <div class="col-12">
                            <label for="alamat_toko" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat_toko" name="alamat_toko" rows="2"><?= esc($settings['alamat_toko'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi Toko (Footer)</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= esc($settings['deskripsi'] ?? '') ?></textarea>
                            <div class="form-text">Deskripsi singkat yang akan muncul pada nota atau info aplikasi.</div>
                        </div>
                        
                        <div class="col-12 mt-4">
                            <hr class="mb-4" style="border-color: #e2e8f0;">
                            <button type="submit" class="btn btn-primary-gradient">
                                <i class="bi bi-check-lg"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(a) {
            a.style.transition = 'opacity 0.5s ease'; a.style.opacity = '0';
            setTimeout(function() { a.remove(); }, 500);
        });
    }, 4000);
</script>
<?= $this->endSection() ?>
