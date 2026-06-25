<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4">
                <h3 class="text-center">Analisis Struktur Kalimat SPOK</h3>
                <p class="text-muted text-center">Ketik kalimat, sistem akan menganalisis SPOK, tata bahasa, kata baku, dan fitur lanjutan.</p>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="input-group input-group-lg">
                        <input type="text" name="sentence" class="form-control border-0 shadow-sm rounded-start-4" placeholder="Contoh: Ibu memasak sayur di dapur" required>
                        <button class="btn btn-primary rounded-end-4 px-5" type="submit">Analisis</button>
                    </div>
                </form>

                <?php if (isset($result)): ?>
                <div class="mt-5">
                    <div class="alert alert-light border-0 shadow-sm rounded-4">
                        <h5 class="fw-bold">Kalimat: <span class="text-primary">"<?= htmlspecialchars($result['sentence']) ?>"</span></h5>
                        <?php if (isset($result['sentiment'])): ?>
                            <span class="badge <?= $result['sentiment'] == 'positif' ? 'bg-success' : ($result['sentiment'] == 'negatif' ? 'bg-danger' : 'bg-secondary') ?>">
                                Sentimen: <?= ucfirst($result['sentiment']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-4">
                                <div class="card-body">
                                    <h6 class="border-bottom pb-2 mb-3">Struktur SPOK</h6>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between"><span class="fw-bold text-primary">Subjek</span> <span><?= $result['spok']['subject'] ?? '<span class="text-danger">Tidak ditemukan</span>' ?></span></li>
                                        <li class="list-group-item d-flex justify-content-between"><span class="fw-bold text-success">Predikat</span> <span><?= $result['spok']['predicate'] ?? '<span class="text-danger">Tidak ditemukan</span>' ?></span></li>
                                        <li class="list-group-item d-flex justify-content-between"><span class="fw-bold text-warning">Objek</span> <span><?= $result['spok']['object'] ?? '<span class="text-muted">Tidak ada</span>' ?></span></li>
                                        <li class="list-group-item d-flex justify-content-between"><span class="fw-bold text-info">Keterangan</span> <span><?= $result['spok']['adverb'] ?? '<span class="text-muted">Tidak ada</span>' ?></span></li>
                                    </ul>
                                    <?php if ($result['spok']['error']): ?>
                                        <div class="alert alert-danger mt-3"><?= $result['spok']['error'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-4">
                                <div class="card-body">
                                    <h6 class="border-bottom pb-2 mb-3">Pengecekan Tata Bahasa</h6>
                                    <?php if ($result['grammar']['is_valid']): ?>
                                        <div class="alert alert-success">Kalimat ini valid secara tata bahasa.</div>
                                    <?php else: ?>
                                        <?php foreach ($result['grammar']['issues'] as $issue): ?>
                                            <div class="alert alert-warning">
                                                <strong><?= $issue['type'] ?></strong>
                                                <p class="mb-1"><?= $issue['message'] ?></p>
                                                <small class="text-muted">Saran: <?= $issue['suggestion'] ?></small>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($result['words']['suggestions'])): ?>
                    <div class="card mt-4 border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h6>Pemeriksaan Kata Baku</h6>
                            <div class="alert alert-info">
                                <?php foreach ($result['words']['suggestions'] as $wrong => $correct): ?>
                                    <span class="badge bg-danger me-2"><?= $wrong ?></span> -> <span class="badge bg-success"><?= $correct ?></span><br>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($result['extra'])): ?>
                    <div class="row g-4 mt-2">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-body">
                                    <h6>Analisis Lanjutan</h6>
                                    <p><strong>Jenis Kalimat:</strong> <span class="badge bg-info"><?= $result['extra']['jenis_kalimat'] ?></span></p>
                                    <p><strong>Kalimat Aktif/Pasif:</strong> <span class="badge bg-secondary"><?= $result['extra']['aktif_pasif'] ?></span></p>
                                    <p><strong>Kalimat Majemuk:</strong> <span class="badge bg-primary"><?= $result['extra']['kalimat_majemuk'] ?></span></p>
                                    <p><strong>Klausa:</strong> <?= count($result['extra']['klausa']) ?> klausa</p>
                                    <ul>
                                    <?php foreach ($result['extra']['klausa'] as $klausa): ?>
                                        <li><?= htmlspecialchars($klausa) ?></li>
                                    <?php endforeach; ?>
                                    </ul>
                                    <h6 class="mt-3">Kelas Kata (POS)</h6>
                                    <ul class="list-unstyled small">
                                    <?php foreach ($result['extra']['pos_tags'] as $pos): ?>
                                        <li><span class="badge bg-light text-dark"><?= $pos['word'] ?></span> -> <?= $pos['tag'] ?></li>
                                    <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-body">
                                    <h6>Analisis Semantik & Gaya</h6>
                                    <p><strong>Pelaku:</strong> <?= $result['extra']['semantik']['pelaku'] ?></p>
                                    <p><strong>Tindakan:</strong> <?= $result['extra']['semantik']['tindakan'] ?></p>
                                    <p><strong>Sasaran:</strong> <?= $result['extra']['semantik']['sasaran'] ?></p>
                                    
                                    <h6 class="mt-3">Frasa</h6>
                                    <?php if (!empty($result['extra']['frasa'])): ?>
                                        <ul class="list-unstyled small">
                                        <?php foreach ($result['extra']['frasa'] as $f): ?>
                                            <li><span class="badge bg-warning text-dark"><?= $f['type'] ?></span> "<?= $f['words'] ?>"</li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="text-muted">Tidak terdeteksi frasa.</p>
                                    <?php endif; ?>

                                    <h6 class="mt-3">Imbuhan</h6>
                                    <?php if (!empty($result['extra']['imbuhan'])): ?>
                                        <ul class="list-unstyled small">
                                        <?php foreach ($result['extra']['imbuhan'] as $kata => $imb): ?>
                                            <li><strong><?= $kata ?></strong> : <?= implode(', ', $imb) ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="text-muted">Tidak ada imbuhan.</p>
                                    <?php endif; ?>

                                    <h6 class="mt-3">Efektifitas Kalimat</h6>
                                    <?php if ($result['extra']['efektifitas']['is_effective']): ?>
                                        <span class="badge bg-success">Kalimat efektif</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Perlu perbaikan</span>
                                        <ul class="small">
                                        <?php foreach ($result['extra']['efektifitas']['issues'] as $issue): ?>
                                            <li class="text-danger"><?= $issue ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <h6 class="mt-3">Tingkat Keterbacaan</h6>
                                    <ul class="list-unstyled small">
                                        <li>Jumlah kata: <?= $result['extra']['keterbacaan']['jumlah_kata'] ?></li>
                                        <li>Rata-rata huruf per kata: <?= $result['extra']['keterbacaan']['rata_huruf_per_kata'] ?></li>
                                        <li>Total suku kata: <?= $result['extra']['keterbacaan']['suku_kata_total'] ?></li>
                                        <li>Tingkat: <span class="badge bg-<?= $result['extra']['keterbacaan']['tingkat'] == 'Mudah' ? 'success' : ($result['extra']['keterbacaan']['tingkat'] == 'Sedang' ? 'warning' : 'danger') ?>"><?= $result['extra']['keterbacaan']['tingkat'] ?></span></li>
                                    </ul>

                                    <h6 class="mt-3">Saran Gaya Penulisan</h6>
                                    <?php if (!empty($result['extra']['saran_gaya'])): ?>
                                        <ul class="small">
                                        <?php foreach ($result['extra']['saran_gaya'] as $saran): ?>
                                            <li class="text-primary"><?= $saran ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="text-muted">Tidak ada saran perbaikan gaya.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>