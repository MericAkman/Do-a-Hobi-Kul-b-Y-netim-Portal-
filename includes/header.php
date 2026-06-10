<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doğa & Hobi Kulübü Portalı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Özelleştirilmiş Coral Renk Paleti ve Tasarım Şeması */
        :root {
            --mercan-ana: #FF7F50;
            --mercan-koyu: #E06036;
            --mercan-acik: #FFF0EB;
            --yazi-koyu: #2D3436;
        }
        
        body {
            background-color: #F8F9FA;
            color: var(--yazi-koyu);
        }

        /* Flexbox ile Yapılandırılmış Arayüz */
        .esnek-kutu-kapsayici {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .mercan-navbar {
            background-color: var(--mercan-ana) !important;
            box-shadow: 0 4px 12px rgba(255, 127, 80, 0.2);
        }

        .mercan-buton {
            background-color: var(--mercan-ana);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .mercan-buton:hover {
            background-color: var(--mercan-koyu);
            color: #fff;
            transform: translateY(-2px);
        }

        .mercan-kart-baslik {
            background-color: var(--mercan-ana);
            color: white;
            border-bottom: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .mercan-tablo thead {
            background-color: var(--mercan-koyu);
            color: white;
        }
    </style>
</head>
<body>

<div class="esnek-kutu-kapsayici">
    <nav class="navbar navbar-expand-lg navbar-dark mercan-navbar mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Hobi Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuAlani">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuAlani">
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if(isset($_SESSION['kullanici_id'])): ?>
                        <li class="nav-item mx-2"><a class="nav-link" href="index.php">Faaliyetlerim</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="etkinlik-ekle.php">Yeni Faaliyet Ekle</a></li>
                        <li class="nav-item ms-3">
                            <a class="btn btn-sm btn-light text-danger fw-bold" href="cikis.php">Sistemden Çık</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item mx-2"><a class="nav-link" href="giris.php">Sisteme Gir</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="kayit.php">Yeni Üye Ol</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container flex-grow-1">