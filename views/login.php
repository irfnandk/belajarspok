<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-5">
                <h3 class="text-center mb-4">Selamat Datang</h3>
                <?php if (isset($_GET['action']) && $_GET['action'] == 'register'): ?>
                    <form method="POST" action="index.php?page=auth&action=register">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-4">Daftar</button>
                        <p class="text-center mt-3">Sudah punya akun? <a href="index.php?page=auth&action=login">Masuk</a></p>
                    </form>
                <?php else: ?>
                    <form method="POST" action="index.php?page=auth&action=login">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-4">Masuk</button>
                        <p class="text-center mt-3">Belum punya akun? <a href="index.php?page=auth&action=register">Daftar</a></p>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>