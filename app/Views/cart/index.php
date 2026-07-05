<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="row g-4 mb-4">
    <div class="col-md-4 animate-fadeInUp animate-delay-1" style="opacity:0">
        <div class="stat-card stat-purple">
            <div class="stat-icon"><i class="bi bi-cart-fill"></i></div>
            <div class="stat-value"><?= $count ?></div>
            <div class="stat-label">Jenis Layanan</div>
        </div>
    </div>
    <div class="col-md-4 animate-fadeInUp animate-delay-2" style="opacity:0">
        <div class="stat-card stat-green">
            <div class="stat-icon"><i class="bi bi-bag-check-fill"></i></div>
            <div class="stat-value"><?= array_sum(array_column($items, 'qty')) ?></div>
            <div class="stat-label">Total Unit</div>
        </div>
    </div>
    <div class="col-md-4 animate-fadeInUp animate-delay-3" style="opacity:0">
        <div class="stat-card stat-blue">
            <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
            <div class="stat-value">Rp <?= number_format($total, 0, ',', '.') ?></div>
            <div class="stat-label">Total Harga</div>
        </div>
    </div>
</div>

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

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card animate-fadeInUp" style="opacity:0; animation-delay:0.2s;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-cart3 me-2" style="color:#7c3aed;"></i>
                        Keranjang Belanja
                    </h5>
                </div>
                <?php if (! empty($items)) : ?>
                    <button class="btn btn-outline-danger btn-sm" id="btnDestroyCart"
                            style="border-radius:8px; font-size:0.8rem;">
                        <i class="bi bi-trash3 me-1"></i> Kosongkan
                    </button>
                <?php endif; ?>
            </div>
            <div class="card-body p-0">
                <?php if (empty($items)) : ?>
                    <div class="empty-state">
                        <i class="bi bi-cart-x" style="font-size:3rem; color:#cbd5e1;"></i>
                        <h5 class="mt-3">Keranjang Masih Kosong</h5>
                        <p class="text-secondary">Tambahkan layanan dari halaman <a href="<?= base_url('/jenis-layanan') ?>">Jenis Layanan</a>.</p>
                    </div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table" id="cartTable">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th class="text-center">Harga Satuan</th>
                                    <th class="text-center" style="width:160px;">Quantity</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cartBody">
                                <?php foreach ($items as $item) : ?>
                                    <tr id="row-<?= $item['id'] ?>">
                                        <td>
                                            <div class="fw-semibold"><?= esc($item['nama']) ?></div>
                                            <small class="text-secondary">per <?= esc($item['satuan']) ?></small>
                                        </td>
                                        <td class="text-center">
                                            <span class="price-tag">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <button class="btn-qty btn-qty-minus"
                                                        data-id="<?= $item['id'] ?>"
                                                        data-qty="<?= $item['qty'] ?>">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <span class="qty-display fw-bold" id="qty-<?= $item['id'] ?>">
                                                    <?= $item['qty'] ?>
                                                </span>
                                                <button class="btn-qty btn-qty-plus"
                                                        data-id="<?= $item['id'] ?>"
                                                        data-qty="<?= $item['qty'] ?>">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-center fw-semibold" id="subtotal-<?= $item['id'] ?>">
                                            Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-action btn-delete btn-remove-item"
                                                    data-id="<?= $item['id'] ?>"
                                                    title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr style="background:#f8fafc;">
                                    <td colspan="3" class="fw-bold text-end pe-3">TOTAL</td>
                                    <td class="text-center fw-bold" id="grandTotal"
                                        style="font-size:1.05rem; color:#4338ca;">
                                        Rp <?= number_format($total, 0, ',', '.') ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card animate-fadeInUp" style="opacity:0; animation-delay:0.35s;">
            <div class="card-header">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-receipt me-2" style="color:#7c3aed;"></i>
                    Checkout
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($items)) : ?>
                    <div class="text-center text-secondary py-3" style="font-size:0.88rem;">
                        Tambahkan layanan ke keranjang untuk melakukan checkout.
                    </div>
                <?php else : ?>
                    <form action="<?= base_url('/cart/checkout') ?>" method="POST" id="checkoutForm">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="pelanggan_id">Pilih Pelanggan</label>
                            <select name="pelanggan_id" id="pelanggan_id" class="form-select" required
                                    style="border-radius:10px; border:1.5px solid #e2e8f0;">
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php foreach ($pelanggan as $p) : ?>
                                    <option value="<?= $p['id'] ?>"><?= esc($p['nama']) ?> – <?= esc($p['telepon']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold" for="catatan">Catatan (opsional)</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3"
                                      placeholder="Misal: pakaian warna terang pisahkan..."
                                      style="border-radius:10px; border:1.5px solid #e2e8f0; resize:none;"></textarea>
                        </div>

                        <div class="checkout-summary mb-4 p-3"
                             style="background:#f8fafc; border-radius:12px; border:1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem;">
                                <span class="text-secondary">Jumlah Layanan</span>
                                <span class="fw-semibold"><?= $count ?> jenis</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem;">
                                <span class="text-secondary">Total Unit</span>
                                <span class="fw-semibold"><?= array_sum(array_column($items, 'qty')) ?> unit</span>
                            </div>
                            <hr style="border-color:#e2e8f0; margin:8px 0;">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Bayar</span>
                                <span class="fw-bold" style="color:#4338ca; font-size:1.05rem;" id="checkoutTotal">
                                    Rp <?= number_format($total, 0, ',', '.') ?>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-gradient w-100"
                                style="border-radius:12px; padding:12px; font-weight:700;">
                            <i class="bi bi-bag-check-fill me-2"></i>
                            Proses Pesanan
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-3 text-center">
            <a href="<?= base_url('/jenis-layanan') ?>" class="text-secondary"
               style="font-size:0.85rem; text-decoration:none;">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Layanan
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<style>
    .btn-qty {
        width: 30px; height: 30px;
        border-radius: 8px;
        border: 1.5px solid #e2e8f0;
        background: #fff;
        color: #4338ca;
        font-size: 0.85rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-qty:hover {
        background: #4338ca;
        color: #fff;
        border-color: #4338ca;
    }
    .qty-display {
        min-width: 36px;
        text-align: center;
        font-size: 0.95rem;
    }
</style>
<script>
    const CSRF_NAME  = '<?= csrf_token() ?>';
    const CSRF_HASH  = '<?= csrf_hash() ?>';
    const BASE_URL   = '<?= base_url() ?>';

    function formatRupiah(num) {
        return 'Rp ' + Math.round(num).toLocaleString('id-ID');
    }

    function refreshCartHeader(count) {
        const badge = document.getElementById('cartBadge');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'inline-flex' : 'none';
        }
    }

    function postCart(url, data, callback) {
        data[CSRF_NAME] = CSRF_HASH;
        fetch(BASE_URL + url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(data),
        })
        .then(r => r.json())
        .then(callback)
        .catch(err => console.error(err));
    }

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-qty-plus, .btn-qty-minus');
        if (!btn) return;

        const id     = btn.dataset.id;
        const isPlus = btn.classList.contains('btn-qty-plus');
        const qtyEl  = document.getElementById('qty-' + id);
        let qty      = parseInt(qtyEl.textContent);

        qty = isPlus ? qty + 1 : qty - 1;
        if (qty < 0) qty = 0;

        postCart('cart/update', { id, qty }, function(res) {
            if (qty === 0) {
                document.getElementById('row-' + id)?.remove();
                if (document.querySelectorAll('#cartBody tr').length === 0) {
                    location.reload();
                }
            } else {
                qtyEl.textContent = qty;
                document.querySelectorAll('[data-id="' + id + '"]').forEach(b => b.dataset.qty = qty);
                document.getElementById('subtotal-' + id).textContent = formatRupiah(res.item_subtotal);
            }
            document.getElementById('grandTotal').textContent   = formatRupiah(res.cart_total);
            document.getElementById('checkoutTotal') && (document.getElementById('checkoutTotal').textContent = formatRupiah(res.cart_total));
            refreshCartHeader(res.cart_count);
        });
    });

    document.querySelectorAll('.btn-remove-item').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            postCart('cart/remove', { id }, function(res) {
                document.getElementById('row-' + id)?.remove();
                document.getElementById('grandTotal').textContent = formatRupiah(res.cart_total);
                document.getElementById('checkoutTotal') && (document.getElementById('checkoutTotal').textContent = formatRupiah(res.cart_total));
                refreshCartHeader(res.cart_count);
                if (document.querySelectorAll('#cartBody tr').length === 0) {
                    location.reload();
                }
            });
        });
    });

    const destroyBtn = document.getElementById('btnDestroyCart');
    if (destroyBtn) {
        destroyBtn.addEventListener('click', function() {
            if (!confirm('Yakin ingin mengosongkan seluruh keranjang belanja?')) return;
            postCart('cart/destroy', {}, function(res) {
                refreshCartHeader(0);
                location.reload();
            });
        });
    }

    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(a) {
            a.style.transition = 'opacity 0.5s ease';
            a.style.opacity = '0';
            setTimeout(() => a.remove(), 500);
        });
    }, 4000);
</script>
<?= $this->endSection() ?>
