# Doğa & Hobi Kulübü Yönetim Portalı

Açık havada ve hobi alanlarında faaliyet gösteren topluluklar için geliştirilmiş, etkinlik planlama ve üye yönetimini tek bir noktadan sağlayan dijital bir portaldır. Bu proje, ham PHP ve MySQL/MariaDB kullanılarak, modern yazılım geliştirme ve veri yönetimi prensiplerine uygun olarak inşa edilmiştir.

## 🔗 Canlı Demo & Video Sunumu

* [**Canlı Uygulama Linki**](http://95.130.171.20/~st23360859085/) (Hosting üzerinde sorunsuz çalışmaktadır)
* [**Video Sunumu (YouTube)**](https://youtu.be/RXZEpGguUgc)

## 🚀 Temel Özellikler (CRUD)

Uygulama, temel veri yönetimi (CRUD) işlemlerini ve güvenli üye oturumlarını tam olarak destekler:

1. **Kullanıcı Kaydı:** Yeni üyeler sisteme güvenli bir şekilde kaydolabilir .
2. **Güvenli Oturum (Session):** Kayıtlı kullanıcılar `$_SESSION` ile kontrol edilen güvenli bir oturum açıp kapatabilir .
3. **Faaliyet Oluşturma (Create):** Kullanıcılar yeni kulüp etkinlikleri planlayıp sisteme işleyebilir .
4. **Faaliyet Listeleme (Read):** Eklenen tüm etkinlikler ana sayfada dinamik bir tabloda görüntülenir .
5. **Faaliyet Düzenle (Update):** Etkinlik bilgileri (tarih, konum, içerik) güncellenebilir .
6. **Faaliyet Sil (Delete):** İptal olan etkinlikler onay adımından geçtikten sonra sistemden kaldırılabilir .

## 💻 Teknik Özellikler & Güvenlik

* **Arka Uç:** Tamamen yalın (pure) **PHP 8+** kullanıldı; harici bir framework kullanılmadı.
* **Veritabanı:** **MySQL/MariaDB** ile ilişkisel bir yapı kuruldu.
* **Ön Uç:** **Bootstrap 5** kütüphanesi üzerine özelleştirilmiş 'Coral' (Mercan) renk teması ve Flexbox (esnek kutu) mimarisi uygulandı.
* **PDO Mimarisi:** Tüm veritabanı bağlantıları **PDO (PHP Data Objects)** üzerinden sağlandı.
* **Güvenlik:** SQL Injection saldırılarını önlemek amacıyla tüm sorgularda **'Prepared Statements' (Hazırlanmış İfadeler)** yapısı kullanıldı. Şifreler veritabanına `password_hash()` ile kriptolanarak kaydedildi.

## 📊 Veritabanı Şeması

Veritabanımızda iki ilişkisel tablo bulunmaktadır:

1. **`KULLANICILAR`:** Üye bilgileri ve şifrelenmiş kimlik doğrulama verileri.
2. **`ETKINLIKLER`:** Üyelere ait faaliyetlerin detayları (`kullanici_id` ile `KULLANICILAR` tablosuna bağlıdır).

## 🖼 Arayüz Görselleri (Galeri)

### 1. Sisteme Giriş
<img src="web_1.png" alt="Sisteme Giriş 1" width="400"> <img src="web_2.png" alt="Sisteme Giriş 2" width="400">

### 2. Veri Girişi
<img src="web_3.png" alt="Veri Girişi 1" width="400"> <img src="web_4.png" alt="Veri Girişi 2" width="400">

### 3. Veri Güncelleme
<img src="web_5.png" alt="Veri Güncelleme 1" width="400"> <img src="web_6.png" alt="Veri Güncelleme 2" width="400">

### 4. Veri Silme
<img src="web_7.png" alt="Veri Silme 1" width="400"> <img src="web_8.png" alt="Veri Silme 2" width="400">

## 👨‍💻 Geliştirici

* **Meriç Akman** - [**GitHub Profili**](https://github.com/MericAkman)
