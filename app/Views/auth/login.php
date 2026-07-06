<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FreshWash Laundry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 30%, #4338ca 60%, #6366f1 100%);
        position: relative;
        overflow: hidden;
    }

    /* Animated background shapes */
    body::before,
    body::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        opacity: 0.08;
    }

    body::before {
        width: 600px;
        height: 600px;
        background: #fff;
        top: -200px;
        right: -100px;
        animation: float 8s ease-in-out infinite;
    }

    body::after {
        width: 400px;
        height: 400px;
        background: #fff;
        bottom: -150px;
        left: -100px;
        animation: float 6s ease-in-out infinite reverse;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-30px) rotate(5deg);
        }
    }

    .login-container {
        width: 100%;
        max-width: 440px;
        padding: 20px;
        position: relative;
        z-index: 10;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 48px 40px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-logo {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-logo .icon-circle {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
    }

    .login-logo .icon-circle i {
        font-size: 2rem;
        color: #fff;
    }

    .login-logo h2 {
        font-weight: 800;
        font-size: 1.6rem;
        color: #1e1b4b;
        margin: 0;
    }

    .login-logo p {
        color: #64748b;
        font-size: 0.85rem;
        margin: 4px 0 0;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.82rem;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 12px 16px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.15);
    }

    .input-group-text {
        border-radius: 12px 0 0 12px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        color: #64748b;
        border-right: none;
    }

    .input-group .form-control {
        border-radius: 0 12px 12px 0;
        border-left: none;
    }

    .input-group .form-control:focus {
        border-left: none;
    }

    .input-group:focus-within .input-group-text {
        border-color: #818cf8;
    }

    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
        padding: 13px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        width: 100%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.45);
        color: #fff;
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .alert {
        border-radius: 12px;
        border: none;
        padding: 12px 16px;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
    }

    .alert-success {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
    }

    .demo-info {
        margin-top: 24px;
        padding: 16px;
        background: #f1f5f9;
        border-radius: 12px;
        text-align: center;
    }

    .demo-info p {
        font-size: 0.75rem;
        color: #64748b;
        margin: 0 0 4px;
    }

    .demo-info code {
        font-size: 0.78rem;
        background: #e2e8f0;
        padding: 2px 8px;
        border-radius: 4px;
        color: #4338ca;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <h2>FreshWash</h2>
                <p>Masuk ke sistem manajemen laundry</p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle-fill"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success mb-3">
                <i class="bi bi-check-circle-fill"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
            <?php endif; ?>

            <?php
                $validation = session()->getFlashdata('validation');
            ?>

            <form action="<?= base_url('/auth/authenticate') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email"
                            class="form-control <?= ($validation && $validation->hasError('email')) ? 'is-invalid' : '' ?>"
                            id="email" name="email" value="<?= old('email') ?>" placeholder="nama@email.com" autofocus>
                    </div>
                    <?php if ($validation && $validation->hasError('email')) : ?>
                    <div class="text-danger mt-1" style="font-size:0.8rem;">
                        <i class="bi bi-exclamation-circle me-1"></i><?= $validation->getError('email') ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password"
                            class="form-control <?= ($validation && $validation->hasError('password')) ? 'is-invalid' : '' ?>"
                            id="password" name="password" placeholder="Masukkan password">
                    </div>
                    <?php if ($validation && $validation->hasError('password')) : ?>
                    <div class="text-danger mt-1" style="font-size:0.8rem;">
                        <i class="bi bi-exclamation-circle me-1"></i><?= $validation->getError('password') ?>
                    </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk
                </button>
            </form>

            <div class="demo-info">
                <p><strong>Demo Account:</strong></p>
                <p>Admin: <code>admin@freshwash.com</code> / <code>admin123</code></p>
                <p>Kasir: <code>kasir@freshwash.com</code> / <code>kasir123</code></p>
            </div>
        </div>
    </div>
</body>

</html>