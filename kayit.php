<?php
require_once 'config.php';

if (isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit;
}

$bildirim_notu = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad_soyad = trim($_POST['isim_alani']);
    $mail_adresi = trim($_POST['eposta_alani']);
    $parola = $_POST['sifre_alani'];

    if (!empty($ad_soyad) && !empty($mail_adresi) && !empty($parola)) {
        $kriptolu_parola = password_hash($parola, PASSWORD_DEFAULT);
        $kayit_sql = "INSERT INTO KULLANICILAR (isim, eposta, sifre) VALUES (:ad, :mail, :parola)";
        $db_sorgusu = $pdo->prepare($kayit_sql);
        try {
            $db_sorgusu->execute([':ad' => $ad_soyad, ':mail' => $mail_adresi, ':parola' => $kriptolu_parola]);
            $bildirim_notu = "<div class='alert alert-success shadow-sm'>Aramıza katıldınız! Şimdi giriş yapabilirsiniz.</div>";
        } catch (PDOException $hata) {
            $bildirim_notu = "<div class='alert alert-danger shadow-sm'>Bu e-posta adresi zaten sistemimizde mevcut.</div>";
        }
    }
}

require_once 'includes/header.php';
?>
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header mercan-kart-baslik text-center py-3">
                <h5 class="mb-0">Kulüp Üyelik Formu</h5>
            </div>
            <div class="card-body p-4 bg-white">
                <?= $bildirim_notu ?>
                <form action="kayit.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Adınız Soyadınız</label>
                        <input type="text" class="form-control bg-light" name="isim_alani" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">E-posta Adresiniz</label>
                        <input type="email" class="form-control bg-light" name="eposta_alani" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Belirlediğiniz Parola</label>
                        <input type="password" class="form-control bg-light" name="sifre_alani" required>
                    </div>
                    <button type="submit" class="w-100 mercan-buton py-2">Kaydımı Tamamla</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>