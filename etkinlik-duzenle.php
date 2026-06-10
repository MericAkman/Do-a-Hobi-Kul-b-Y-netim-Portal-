<?php
require_once 'config.php';
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: giris.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$mesaj = '';

// Form gönderildiğinde güncelle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $tarih = $_POST['tarih'];
    $konum = $_POST['konum'];

    $sql = "UPDATE ETKINLIKLER SET baslik = :baslik, aciklama = :aciklama, tarih = :tarih, konum = :konum WHERE id = :id AND kullanici_id = :kullanici_id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        ':baslik' => $baslik,
        ':aciklama' => $aciklama,
        ':tarih' => $tarih,
        ':konum' => $konum,
        ':id' => $id,
        ':kullanici_id' => $_SESSION['kullanici_id']
    ])) {
        header("Location: index.php");
        exit;
    } else {
        $mesaj = "<div class='alert alert-danger'>Güncelleme hatası.</div>";
    }
}

// Mevcut verileri çek (Forma doldurmak için)
$stmt = $pdo->prepare("SELECT * FROM ETKINLIKLER WHERE id = :id AND kullanici_id = :kullanici_id");
$stmt->execute([':id' => $id, ':kullanici_id' => $_SESSION['kullanici_id']]);
$etkinlik = $stmt->fetch();

if (!$etkinlik) {
    header("Location: index.php");
    exit;
}

require_once 'includes/header.php';
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">Etkinliği Düzenle</div>
            <div class="card-body">
                <?= $mesaj ?>
                <form action="etkinlik-duzenle.php?id=<?= $id ?>" method="POST">
                    <div class="mb-3"><label>Başlık</label><input type="text" name="baslik" class="form-control" value="<?= htmlspecialchars($etkinlik['baslik']) ?>" required></div>
                    <div class="mb-3"><label>Açıklama</label><textarea name="aciklama" class="form-control" rows="3" required><?= htmlspecialchars($etkinlik['aciklama']) ?></textarea></div>
                    <div class="mb-3"><label>Tarih & Saat</label><input type="datetime-local" name="tarih" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($etkinlik['tarih'])) ?>" required></div>
                    <div class="mb-3"><label>Konum</label><input type="text" name="konum" class="form-control" value="<?= htmlspecialchars($etkinlik['konum']) ?>" required></div>
                    <button type="submit" class="btn btn-warning">Güncelle</button>
                    <a href="index.php" class="btn btn-secondary">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>