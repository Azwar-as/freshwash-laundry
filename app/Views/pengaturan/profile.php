<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

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

<div class="row">
    <!-- PENGATURAN MENU (SIDE) -->
    <div class="col-md-4 col-lg-3 animate-fadeInUp" style="opacity:0">
        <div class="card mb-4">
            <div class="card-body p-0">
                <div class="list-group list-group-flush" style="border-radius:16px;">
                    <a href="<?= base_url('/pengaturan') ?>" class="list-group-item list-group-item-action p-3 fw-semibold text-secondary" style="border:none;">
                        <i class="bi bi-shop me-2"></i> Pengaturan Toko
                    </a>
                    <a href="<?= base_url('/pengaturan/profile') ?>" class="list-group-item list-group-item-action p-3 fw-semibold active" style="background:var(--primary-gradient);color:#fff;border:none;">
                        <i class="bi bi-person-badge me-2"></i> Profil Saya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- PROFIL FORM -->
    <div class="col-md-8 col-lg-9 animate-fadeInUp animate-delay-1" style="opacity:0">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-3">
                <div style="width:40px;height:40px;background:var(--primary-gradient);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                    <?= strtoupper(substr($user['nama'], 0, 2)) ?>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">Profil Pengguna</h5>
                    <small class="text-secondary">Kelola informasi akun Anda</small>
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->has('validation')) : ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session('validation')->getErrors() as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/pengaturan/update-profile') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $user['nama']) ?>" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $user['email']) ?>" required>
                        </div>

                        <div class="col-12">
                            <hr style="border-color:#e2e8f0;margin:1rem 0;">
                            <h6 class="fw-bold mb-3"><i class="bi bi-lock-fill me-2" style="color:#7c3aed;"></i>Ubah Password</h6>
                            <p class="form-text text-secondary mb-3">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter">
                        </div>
                        
                        <div class="col-12 mt-4">
                            <hr class="mb-4" style="border-color: #e2e8f0;">
                            <button type="submit" class="btn btn-primary-gradient">
                                <i class="bi bi-check-lg"></i> Simpan Profil
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
