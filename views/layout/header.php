<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar SPOK - Analisis Kalimat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="index.php">Belajar SPOK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=analyze">Analisis</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=quiz">Kuis</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=report">Laporan</a></li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item"><span class="nav-link text-white-50">Halo, <?= htmlspecialchars($_SESSION['username']) ?></span></li>
                        <li class="nav-item"><a class="nav-link btn btn-outline-light btn-sm px-3" href="index.php?page=auth&action=logout">Keluar</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=auth&action=login">Masuk</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container py-4">
        <?= $content ?>
    </main>
    <footer class="text-center text-muted py-3 border-top mt-5 bg-white">
        <div class="container">&copy; 2026 Belajar SPOK - Dibuat untuk pembelajaran bahasa Indonesia</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>