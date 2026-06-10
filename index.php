<?php
require_once 'config.php';
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: giris.php");
    exit;
}

// Kayıt Silme Bloğu
if (isset($_GET['hedef_sil'])) {
    $silinecek_veri = $_GET['hedef_sil'];
    $silme_sorgusu = $pdo->prepare("DELETE FROM ETKINLIKLER WHERE id = :id AND kullanici_id = :oturum_id");
    $silme_sorgusu->execute([':id' => $silinecek_veri, ':oturum_id' => $_SESSION['kullanici_id']]);
    header("Location: index.php");
    exit;
}

// Verileri Çekme Bloğu
$veri_cek = $pdo->prepare("SELECT * FROM ETKINLIKLER WHERE kullanici_id = :oturum_id ORDER BY tarih DESC");
$veri_cek->execute([':oturum_id' => $_SESSION['kullanici_id']]);
$kayitli_faaliyetler = $veri_cek->fetchAll();

require_once 'includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
    <h4 class="text-secondary">Hoş geldin, <span style="color: var(--mercan-koyu);"><?= htmlspecialchars($_SESSION['isim']) ?></span></h4>
    <a href="etkinlik-ekle.php" class="mercan-buton px-4 py-2 text-decoration-none"> + Yeni Faaliyet Planla</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mercan-tablo mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Faaliyet Başlığı</th>
                        <th>Planlanan Tarih</th>
                        <th>Buluşma Noktası</th>
                        <th class="text-end pe-4">Aksiyonlar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($kayitli_faaliyetler) > 0): ?>
                        <?php foreach ($kayitli_faaliyetler as $satir): ?>
                            <tr>
                                <td class="ps-4 align-middle fw-medium"><?= htmlspecialchars($satir['baslik']) ?></td>
                                <td class="align-middle text-muted"><?= date('d M Y - H:i', strtotime($satir['tarih'])) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($satir['konum']) ?></td>
                                <td class="text-end pe-4 align-middle">
                                    <a href="etkinlik-duzenle.php?id=<?= $satir['id'] ?>" class="btn btn-sm btn-outline-secondary me-1">Revize Et</a>
                                    <a href="index.php?hedef_sil=<?= $satir['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bu faaliyeti tamamen iptal etmek istediğinize emin misiniz?');">Kaldır</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Sisteme henüz bir faaliyet girmediniz.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>