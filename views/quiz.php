<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4">
                <h3 class="text-center">Kuis Adaptif</h3>
                <p class="text-muted text-center">Soal disesuaikan dengan level dan kesalahan yang sering Anda lakukan.</p>
            </div>
            <div class="card-body">
                <?php if (isset($score)): ?>
                    <div class="text-center py-4">
                        <h4>Skor Kamu</h4>
                        <div class="display-1 fw-bold text-primary"><?= $score['correct'] ?>/<?= $score['total'] ?></div>
                        <div class="progress mx-auto" style="height: 10px; max-width: 300px;">
                            <div class="progress-bar bg-success" style="width: <?= $score['percentage'] ?>%;"></div>
                        </div>
                        <p class="mt-3">Persentase: <?= round($score['percentage']) ?>%</p>
                        <?php if ($score['level_up']): ?>
                            <div class="alert alert-success">Selamat! Level Anda naik!</div>
                        <?php endif; ?>
                        <a href="index.php?page=quiz" class="btn btn-outline-primary mt-3">Ulangi Kuis</a>
                        <a href="index.php" class="btn btn-outline-secondary mt-3">Kembali ke Beranda</a>
                    </div>
                <?php elseif (!empty($questions)): ?>
                    <form method="POST">
                        <?php foreach ($questions as $index => $q): ?>
                            <div class="mb-4 p-3 bg-light rounded-3">
                                <p class="fw-bold"><?= ($index+1) ?>. <?= htmlspecialchars($q['question']) ?></p>
                                <div class="ms-3">
                                    <?php if ($q['type'] == 'bs'): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="0" id="q<?= $q['id'] ?>_salah" required>
                                            <label class="form-check-label" for="q<?= $q['id'] ?>_salah">Salah</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="1" id="q<?= $q['id'] ?>_benar" required>
                                            <label class="form-check-label" for="q<?= $q['id'] ?>_benar">Benar</label>
                                        </div>
                                    <?php else: ?>
                                        <?php 
                                        $options = json_decode($q['options'], true);
                                        foreach ($options as $key => $opt): 
                                        ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $key ?>" id="q<?= $q['id'] ?>_<?= $key ?>" required>
                                                <label class="form-check-label" for="q<?= $q['id'] ?>_<?= $key ?>"><?= htmlspecialchars($opt) ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-4">Kirim Jawaban</button>
                    </form>
                <?php else: ?>
                    <div class="text-center py-4">
                        <p>Belum ada soal untuk level ini. Silakan coba lagi nanti.</p>
                        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>