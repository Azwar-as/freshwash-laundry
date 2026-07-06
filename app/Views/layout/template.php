<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FreshWash Laundry - Sistem manajemen layanan laundry profesional">
    <title><?= isset($title) ? $title . ' | ' : '' ?>FreshWash Laundry</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-bg: linear-gradient(180deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --surface-bg: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--surface-bg);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
        }

        /* SIDEBAR   */
        .sidebar {
            width: 270px;
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: var(--transition-smooth);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 800;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
        }

        .sidebar-brand small {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            font-weight: 400;
            display: block;
            margin-top: 4px;
        }

        .sidebar-menu {
            padding: 20px 16px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-menu .menu-label {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0 12px;
            margin-bottom: 12px;
        }

        .sidebar-menu .nav-link {
            color: rgba(255, 255, 255, 0.65);
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 4px;
            font-weight: 500;
            font-size: 0.88rem;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-menu .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }

        .sidebar-menu .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar-menu .nav-link i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-footer p {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.72rem;
            text-align: center;
            margin: 0;
        }

        .main-content {
            margin-left: 270px;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: #fff;
            padding: 16px 32px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 500;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.9);
        }

        .page-title-area h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .page-title-area .breadcrumb {
            margin: 0;
            font-size: 0.8rem;
        }

        .page-title-area .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
        }

        .page-title-area .breadcrumb-item.active {
            color: #6366f1;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar-actions .btn-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: var(--transition-smooth);
            cursor: pointer;
            text-decoration: none;
        }

        .navbar-actions .btn-icon:hover {
            background: #f1f5f9;
            color: var(--text-primary);
        }

        .btn-logout {
            border-color: #fecaca !important;
            color: #dc2626 !important;
        }

        .btn-logout:hover {
            background: #fee2e2 !important;
            color: #dc2626 !important;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: var(--primary-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .user-info .user-name {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-primary);
        }

        .user-info .user-role {
            font-size: 0.72rem;
            color: var(--text-secondary);
            text-transform: capitalize;
        }

   
        .content-area {
            padding: 32px;
            flex: 1;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: var(--transition-smooth);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 24px;
        }

        .card-body {
            padding: 24px;
        }

        .btn-primary-gradient {
            background: var(--primary-gradient);
            border: none;
            color: #fff;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: #fff;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-smooth);
            font-size: 0.85rem;
        }

        .btn-action:hover { transform: translateY(-2px); }

        .btn-edit { background: #dbeafe; color: #2563eb; }
        .btn-edit:hover { background: #2563eb; color: #fff; box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35); }

        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #dc2626; color: #fff; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.35); }

        .btn-view { background: #e0e7ff; color: #4338ca; }
        .btn-view:hover { background: #4338ca; color: #fff; box-shadow: 0 4px 15px rgba(67, 56, 202, 0.35); }

        .btn-status { background: #fef3c7; color: #d97706; }
        .btn-status:hover { background: #d97706; color: #fff; box-shadow: 0 4px 15px rgba(217, 119, 6, 0.35); }

        .table { margin: 0; }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.88rem;
        }

        .table tbody tr {
            transition: var(--transition-smooth);
        }

        .table tbody tr:hover { background: #f8fafc; }

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .badge-aktif, .badge-selesai, .badge-diambil { background: #dcfce7; color: #16a34a; }
        .badge-nonaktif { background: #fef2f2; color: #dc2626; }
        .badge-antrian { background: #fef3c7; color: #d97706; }
        .badge-proses { background: #dbeafe; color: #2563eb; }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 10px 16px;
            font-size: 0.88rem;
            transition: var(--transition-smooth);
        }

        .form-control:focus, .form-select:focus {
            border-color: #818cf8;
            box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.15);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .form-text {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 16px 20px;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success { background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); color: #166534; }
        .alert-danger { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--card-shadow);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: 0.78rem;
            color: var(--text-secondary);
            font-weight: 500;
            margin-top: 4px;
        }

        .stat-purple::before { background: var(--primary-gradient); }
        .stat-purple .stat-icon { background: #ede9fe; color: #7c3aed; }

        .stat-blue::before { background: linear-gradient(135deg, #3b82f6, #06b6d4); }
        .stat-blue .stat-icon { background: #dbeafe; color: #2563eb; }

        .stat-green::before { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .stat-green .stat-icon { background: #dcfce7; color: #16a34a; }

        .stat-orange::before { background: linear-gradient(135deg, #f97316, #ef4444); }
        .stat-orange .stat-icon { background: #ffedd5; color: #ea580c; }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i { font-size: 4rem; color: #cbd5e1; margin-bottom: 16px; }
        .empty-state h5 { color: var(--text-secondary); font-weight: 600; }
        .empty-state p { color: #94a3b8; font-size: 0.88rem; }

        .price-tag { font-weight: 700; color: #7c3aed; }

        .main-footer {
            padding: 20px 32px;
            border-top: 1px solid #e2e8f0;
            background: #fff;
        }

        .main-footer p { margin: 0; font-size: 0.78rem; color: var(--text-secondary); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeInUp { animation: fadeInUp 0.5s ease-out forwards; }
        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .content-area { padding: 16px; }
            .top-navbar { padding: 12px 16px; }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body>

    <?php
        $currentUrl = uri_string();
        $userRole   = session()->get('user_role');
        $allMenuItems = [
            ['url' => 'dashboard',      'icon' => 'bi-grid-1x2-fill',  'label' => 'Dashboard',       'roles' => ['admin', 'kasir']],
            ['url' => 'jenis-layanan',  'icon' => 'bi-tags-fill',      'label' => 'Jenis Layanan',   'roles' => ['admin', 'kasir']],
            ['url' => 'pelanggan',      'icon' => 'bi-people-fill',    'label' => 'Pelanggan',       'roles' => ['admin', 'kasir']],
            ['url' => 'transaksi',      'icon' => 'bi-receipt',        'label' => 'Transaksi',       'roles' => ['admin', 'kasir']],
            ['url' => 'cart',           'icon' => 'bi-cart3',          'label' => 'Keranjang',       'roles' => ['admin', 'kasir']],
            ['url' => 'laporan',        'icon' => 'bi-bar-chart-fill', 'label' => 'Laporan',         'roles' => ['admin']],
            ['url' => 'pengaturan',     'icon' => 'bi-gear-fill',      'label' => 'Pengaturan',      'roles' => ['admin']],
        ];
        $menuItems = array_filter($allMenuItems, function ($item) use ($userRole) {
            return in_array($userRole, $item['roles']);
        });
        $menuItems = array_values($menuItems);
        $cartLib   = new \App\Libraries\Cart();
        $cartCount = $cartLib->totalQty();
    ?>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <h4>
                FreshWash
            </h4>
            <small>Laundry Management System</small>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Menu Utama</div>
            <?php foreach (array_slice($menuItems, 0, 5) as $item): ?>
                <a href="<?= base_url('/' . $item['url']) ?>"
                   class="nav-link <?= (strpos($currentUrl, $item['url']) === 0) ? 'active' : '' ?>"
                   style="position: relative;">
                    <i class="bi <?= $item['icon'] ?>"></i>
                    <?= $item['label'] ?>
                    <?php if ($item['url'] === 'cart' && $cartCount > 0) : ?>
                        <span style="margin-left:auto; background:#ef4444; color:#fff;
                                     border-radius:10px; padding:1px 7px;
                                     font-size:0.68rem; font-weight:700;">
                            <?= $cartCount ?>
                        </span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>

            <div class="menu-label mt-4">Lainnya</div>
            <?php foreach (array_slice($menuItems, 5) as $item): ?>
                <a href="<?= base_url('/' . $item['url']) ?>"
                   class="nav-link <?= (strpos($currentUrl, $item['url']) === 0) ? 'active' : '' ?>">
                    <i class="bi <?= $item['icon'] ?>"></i>
                    <?= $item['label'] ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <div class="sidebar-footer">
            <p>&copy; <?= date('Y') ?> FreshWash Laundry</p>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-navbar">
            <div class="page-title-area">
                <h1><?= $title ?? 'Dashboard' ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?? 'Dashboard' ?></li>
                    </ol>
                </nav>
            </div>
            <div class="navbar-actions">
                <a href="<?= base_url('/cart') ?>" class="btn-icon position-relative" title="Keranjang Belanja"
                   style="border-color: #ede9fe; color:#7c3aed; text-decoration:none;">
                    <i class="bi bi-cart3"></i>
                    <?php if ($cartCount > 0) : ?>
                        <span id="cartBadge"
                              style="position:absolute; top:-6px; right:-6px;
                                     background:#ef4444; color:#fff;
                                     border-radius:50%; width:18px; height:18px;
                                     font-size:0.65rem; font-weight:700;
                                     display:inline-flex; align-items:center; justify-content:center;
                                     line-height:1;">
                            <?= $cartCount ?>
                        </span>
                    <?php else : ?>
                        <span id="cartBadge"
                              style="position:absolute; top:-6px; right:-6px;
                                     background:#ef4444; color:#fff;
                                     border-radius:50%; width:18px; height:18px;
                                     font-size:0.65rem; font-weight:700;
                                     display:none; align-items:center; justify-content:center;
                                     line-height:1;">0</span>
                    <?php endif; ?>
                </a>
                <a href="<?= base_url('/auth/logout') ?>" class="btn-icon btn-logout" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
                <div class="user-info">
                    <div class="user-avatar" style="padding: 0; background: none;">
                        <img src="https://i.pravatar.cc/150?u=<?= urlencode(session()->get('user_nama') ?? 'Admin') ?>&background=7c3aed&color=fff" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                    </div>
                    <div>
                        <div class="user-name"><?= esc(session()->get('user_nama') ?? 'Admin') ?></div>
                        <div class="user-role"><?= esc(session()->get('user_role') ?? 'admin') ?></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-area">
            <?= $this->renderSection('content') ?>
        </div>

        <footer class="main-footer">
            <p>FreshWash Laundry &mdash; Sistem Manajemen Layanan Laundry &copy; <?= date('Y') ?></p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>
</html>
