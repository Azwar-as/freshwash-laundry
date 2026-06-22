<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card animate-fadeInUp" style="opacity:0">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-plus-fill me-2" style="color: #7c3aed;"></i>
                        Tambah Pelanggan Baru
                    </h5>
                    <a href="<?= base_url('/pelanggan') ?>" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->has('validation')) : ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <div>
                            <ul class="mb-0 mt-1">
                                <?php foreach (session('validation')->getErrors() as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/pelanggan/store') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Nama lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">No. Telepon / WhatsApp</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?= old('telepon') ?>" placeholder="Contoh: 08123456789">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap pelanggan..."><?= old('alamat') ?></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <hr class="mb-4" style="border-color: #e2e8f0;">
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary-gradient">
                                    <i class="bi bi-check-lg"></i> Simpan Pelanggan
                                </button>
                                <a href="<?= base_url('/pelanggan') ?>" class="btn btn-outline-secondary" style="border-radius:10px;padding:10px 24px;">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
