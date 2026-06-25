<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4">
                <h3 class="text-center">Riwayat Perkembangan Belajar</h3>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['user_id']) && isset($report)): ?>
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-4 text-center">
                                <h5>Level</h5>
                                <h2 class="fw-bold"><?= $report['level'] ?></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-success bg-opacity-10 p-3 rounded-4 text-center">
                                <h5>Rata-rata Skor</h5>
                                <h2 class="fw-bold"><?= round($report['stats']['avg_score'] ?? 0) ?></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-warning bg-opacity-10 p-3 rounded-4 text-center">
                                <h5>Total Kuis</h5>
                                <h2 class="fw-bold"><?= $report['stats']['total_quizzes'] ?? 0 ?></h2>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-4">Kesalahan yang Sering Dilakukan</h6>
                    <?php if (!empty($report['common_mistakes'])): ?>
                        <ul class="list-group mb-4">
                            <?php foreach ($report['common_mistakes'] as $m): ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><?= $m['mistake_type'] ?></span>
                                    <span class="badge bg-danger"><?= $m['count'] ?> kali</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Belum ada data kesalahan.</p>
                    <?php endif; ?>

                    <h6>Riwayat Skor Terakhir</h6>
                    <?php if (!empty($report['scores'])): ?>
                        <ul class="list-group">
                            <?php foreach ($report['scores'] as $s): ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><?= $s['quiz_type'] ?></span>
                                    <span><?= $s['score'] ?>/<?= $s['total_questions'] ?> <span class="text-muted">(<?= date('d/m/Y', strtotime($s['date'])) ?>)</span></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Belum ada riwayat pengerjaan kuis.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-4">
                        <p>Silakan login untuk melihat laporan perkembangan belajar Anda.</p>
                        <a href="index.php?page=auth&action=login" class="btn btn-primary">Login</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>