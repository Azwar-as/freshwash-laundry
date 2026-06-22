<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger animate-fadeInUp" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="card animate-fadeInUp" style="opacity:0">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-plus-circle-fill me-2" style="color: #7c3aed;"></i>
                Buat Transaksi Baru
            </h5>
            <a href="<?= base_url('/transaksi') ?>" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/transaksi/store') ?>" method="POST" id="formTransaksi">
            <?= csrf_field() ?>

            <div class="row g-3 mb-4">
                <!-- Pelanggan -->
                <div class="col-md-4">
                    <label for="pelanggan_id" class="form-label">Pelanggan <span class="text-danger">*</span></label>
                    <select class="form-select" id="pelanggan_id" name="pelanggan_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php foreach ($pelanggan as $p) : ?>
                            <option value="<?= $p['id'] ?>"><?= esc($p['nama']) ?> (<?= esc($p['telepon'] ?: 'No HP') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tanggal Masuk -->
                <div class="col-md-4">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= date('Y-m-d') ?>" required>
                </div>

                <!-- Tanggal Selesai (estimasi) -->
                <div class="col-md-4">
                    <label for="tanggal_selesai" class="form-label">Estimasi Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                </div>
            </div>

            <!-- ITEM LAYANAN -->
            <h6 class="fw-bold mb-3"><i class="bi bi-list-check me-2" style="color:#7c3aed;"></i>Item Layanan</h6>
            <div class="table-responsive mb-3">
                <table class="table" id="itemTable">
                    <thead>
                        <tr>
                            <th style="min-width:200px;">Jenis Layanan</th>
                            <th style="width:120px;">Harga</th>
                            <th style="width:100px;">Jumlah</th>
                            <th style="width:150px;">Subtotal</th>
                            <th style="width:60px;"></th>
                        </tr>
                    </thead>
                    <tbody id="itemBody">
                        <!-- Dynamic rows added by JS -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold" style="font-size:1rem;">Total Harga:</td>
                            <td class="price-tag" style="font-size:1.1rem;" id="totalDisplay">Rp 0</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <button type="button" class="btn btn-outline-primary mb-4" style="border-radius:10px;font-size:0.85rem;" onclick="addItem()">
                <i class="bi bi-plus-lg me-1"></i> Tambah Item
            </button>

            <!-- Catatan -->
            <div class="mb-4">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="2" placeholder="Catatan tambahan (opsional)..."></textarea>
            </div>

            <hr class="mb-4" style="border-color: #e2e8f0;">
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary-gradient">
                    <i class="bi bi-check-lg"></i> Simpan Transaksi
                </button>
                <a href="<?= base_url('/transaksi') ?>" class="btn btn-outline-secondary" style="border-radius:10px;padding:10px 24px;">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Layanan data from PHP
    var layananData = <?= json_encode($layanan) ?>;
    var itemIndex = 0;

    function addItem() {
        var row = document.createElement('tr');
        row.id = 'row-' + itemIndex;

        var optionsHtml = '<option value="">-- Pilih --</option>';
        layananData.forEach(function(l) {
            optionsHtml += '<option value="' + l.id + '" data-harga="' + l.harga + '" data-satuan="' + l.satuan + '">' + l.nama_layanan + ' (' + l.satuan + ')</option>';
        });

        row.innerHTML = `
            <td>
                <select class="form-select form-select-sm" name="items[${itemIndex}][jenis_layanan_id]" onchange="updateHarga(this, ${itemIndex})" required style="border-radius:8px;">
                    ${optionsHtml}
                </select>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm" id="harga-${itemIndex}" readonly style="background:#f8fafc;border-radius:8px;" placeholder="0">
            </td>
            <td>
                <input type="number" class="form-control form-control-sm" name="items[${itemIndex}][jumlah]" id="jumlah-${itemIndex}" min="0.1" step="0.1" value="1" onchange="calcSubtotal(${itemIndex})" oninput="calcSubtotal(${itemIndex})" required style="border-radius:8px;">
            </td>
            <td>
                <input type="text" class="form-control form-control-sm" id="subtotal-display-${itemIndex}" readonly style="background:#f8fafc;border-radius:8px;font-weight:600;color:#7c3aed;" placeholder="Rp 0">
                <input type="hidden" name="items[${itemIndex}][subtotal]" id="subtotal-${itemIndex}" value="0">
            </td>
            <td>
                <button type="button" class="btn-action btn-delete" onclick="removeItem(${itemIndex})" title="Hapus"><i class="bi bi-x-lg"></i></button>
            </td>
        `;

        document.getElementById('itemBody').appendChild(row);
        itemIndex++;
    }

    function updateHarga(select, idx) {
        var option = select.options[select.selectedIndex];
        var harga = option.getAttribute('data-harga') || 0;
        document.getElementById('harga-' + idx).value = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
        document.getElementById('harga-' + idx).setAttribute('data-raw', harga);
        calcSubtotal(idx);
    }

    function calcSubtotal(idx) {
        var hargaEl = document.getElementById('harga-' + idx);
        var harga = parseFloat(hargaEl.getAttribute('data-raw')) || 0;
        var jumlah = parseFloat(document.getElementById('jumlah-' + idx).value) || 0;
        var subtotal = harga * jumlah;

        document.getElementById('subtotal-' + idx).value = subtotal;
        document.getElementById('subtotal-display-' + idx).value = 'Rp ' + subtotal.toLocaleString('id-ID');

        calcTotal();
    }

    function removeItem(idx) {
        var row = document.getElementById('row-' + idx);
        if (row) row.remove();
        calcTotal();
    }

    function calcTotal() {
        var total = 0;
        document.querySelectorAll('[id^="subtotal-"]:not([id*="display"])').forEach(function(el) {
            total += parseFloat(el.value) || 0;
        });
        document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Add first item by default
    addItem();
</script>
<?= $this->endSection() ?>
