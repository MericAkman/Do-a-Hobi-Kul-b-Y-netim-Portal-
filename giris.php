<?php
require_once 'config.php';

if (isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit;
}

$mesaj = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eposta = trim($_POST['eposta']);
    $sifre = $_POST['sifre'];

    $stmt = $pdo->prepare("SELECT id, isim, sifre FROM KULLANICILAR WHERE eposta = :eposta");
    $stmt->execute([':eposta' => $eposta]);
    $kullanici = $stmt->fetch();

    if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
        $_SESSION['kullanici_id'] = $kullanici['id'];
        $_SESSION['isim'] = $kullanici['isim'];
        header("Location: index.php");
        exit;
    } else {
        $mesaj = "<div class='alert alert-danger'>Hatalı e-posta veya şifre!</div>";
    }
}

require_once 'includes/header.php';
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center"><h4>Giriş Yap</h4></div>
            <div class="card-body">
                <?= $mesaj ?>
                <form action="giris.php" method="POST">
                    <div class="mb-3"><label class="form-label">E-posta</label><input type="email" class="form-control" name="eposta" required></div>
                    <div class="mb-3"><label class="form-label">Şifre</label><input type="password" class="form-control" name="sifre" required></div>
                    <button type="submit" class="btn btn-dark w-100">Giriş</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>