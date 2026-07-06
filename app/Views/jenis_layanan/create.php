<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card animate-fadeInUp" style="opacity:0">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-plus-circle-fill me-2" style="color: #7c3aed;"></i>
                        Tambah Jenis Layanan Baru
                    </h5>
                    <a href="<?= base_url('/jenis-layanan') ?>" class="btn btn-sm btn-outline-secondary"
                        style="border-radius: 8px;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Validation Errors -->
                <?php if (session()->has('validation')) : ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-1">
                            <?php foreach (session('validation')->getErrors() as $error) : ?>
                            <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('/jenis-layanan/store') ?>" method="POST" id="form-layanan">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <!-- Nama Layanan -->
                        <div class="col-md-8">
                            <label for="nama_layanan" class="form-label">
                                Nama Layanan <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control <?= session('validation') && session('validation')->hasError('nama_layanan') ? 'is-invalid' : '' ?>"
                                id="nama_layanan" name="nama_layanan" value="<?= old('nama_layanan') ?>"
                                placeholder="Contoh: Cuci Kering, Cuci Setrika" required>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label for="status" class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="aktif" <?= old('status') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="nonaktif" <?= old('status') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif
                                </option>
                            </select>
                        </div>

                        <!-- Harga -->
                        <div class="col-md-4">
                            <label for="harga" class="form-label">
                                Harga (Rp) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="border-radius: 10px 0 0 10px; border: 1.5px solid #e2e8f0; background: #f8fafc; font-size: 0.85rem; font-weight: 600; color: #64748b;">Rp</span>
                                <input type="number"
                                    class="form-control <?= session('validation') && session('validation')->hasError('harga') ? 'is-invalid' : '' ?>"
                                    id="harga" name="harga" value="<?= old('harga') ?>" placeholder="0" min="0"
                                    step="500" style="border-radius: 0 10px 10px 0;" required>
                            </div>
                        </div>

                        <!-- Satuan -->
                        <div class="col-md-4">
                            <label for="satuan" class="form-label">
                                Satuan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="satuan" name="satuan" required>
                                <option value="">-- Pilih Satuan --</option>
                                <option value="kg" <?= old('satuan') === 'kg' ? 'selected' : '' ?>>Kilogram (kg)
                                </option>
                                <option value="pcs" <?= old('satuan') === 'pcs' ? 'selected' : '' ?>>Pieces (pcs)
                                </option>
                                <option value="m²" <?= old('satuan') === 'm²' ? 'selected' : '' ?>>Meter Persegi (m²)
                                </option>
                                <option value="set" <?= old('satuan') === 'set' ? 'selected' : '' ?>>Set</option>
                                <option value="pasang" <?= old('satuan') === 'pasang' ? 'selected' : '' ?>>Pasang
                                </option>
                            </select>
                        </div>

                        <!-- Estimasi Waktu -->
                        <div class="col-md-4">
                            <label for="estimasi_waktu" class="form-label">
                                Estimasi Waktu (Jam) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number"
                                    class="form-control <?= session('validation') && session('validation')->hasError('estimasi_waktu') ? 'is-invalid' : '' ?>"
                                    id="estimasi_waktu" name="estimasi_waktu" value="<?= old('estimasi_waktu') ?>"
                                    placeholder="24" min="1" style="border-radius: 10px 0 0 10px;" required>
                                <span class="input-group-text"
                                    style="border-radius: 0 10px 10px 0; border: 1.5px solid #e2e8f0; background: #f8fafc; font-size: 0.85rem; font-weight: 600; color: #64748b;">Jam</span>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                placeholder="Deskripsi singkat mengenai jenis layanan ini..."><?= old('deskripsi') ?></textarea>
                            <div class="form-text">Opsional. Berikan penjelasan singkat tentang layanan.</div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-12 mt-4">
                            <hr class="mb-4" style="border-color: #e2e8f0;">
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary-gradient">
                                    <i class="bi bi-check-lg"></i>
                                    Simpan Layanan
                                </button>
                                <a href="<?= base_url('/jenis-layanan') ?>" class="btn btn-outline-secondary"
                                    style="border-radius: 10px; padding: 10px 24px;">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>