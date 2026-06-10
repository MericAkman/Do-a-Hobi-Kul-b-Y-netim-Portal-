<?php
require_once 'config.php';
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: giris.php");
    exit;
}

$mesaj = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $tarih = $_POST['tarih'];
    $konum = $_POST['konum'];

    $sql = "INSERT INTO ETKINLIKLER (kullanici_id, baslik, aciklama, tarih, konum) VALUES (:kullanici_id, :baslik, :aciklama, :tarih, :konum)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        ':kullanici_id' => $_SESSION['kullanici_id'],
        ':baslik' => $baslik,
        ':aciklama' => $aciklama,
        ':tarih' => $tarih,
        ':konum' => $konum
    ])) {
        header("Location: index.php");
        exit;
    } else {
        $mesaj = "<div class='alert alert-danger'>Etkinlik eklenirken hata oluştu.</div>";
    }
}

require_once 'includes/header.php';
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">Yeni Etkinlik Ekle</div>
            <div class="card-body">
                <?= $mesaj ?>
                <form action="etkinlik-ekle.php" method="POST">
                    <div class="mb-3"><label>Başlık</label><input type="text" name="baslik" class="form-control" required></div>
                    <div class="mb-3"><label>Açıklama</label><textarea name="aciklama" class="form-control" rows="3" required></textarea></div>
                    <div class="mb-3"><label>Tarih & Saat</label><input type="datetime-local" name="tarih" class="form-control" required></div>
                    <div class="mb-3"><label>Konum</label><input type="text" name="konum" class="form-control" required></div>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                    <a href="index.php" class="btn btn-secondary">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>