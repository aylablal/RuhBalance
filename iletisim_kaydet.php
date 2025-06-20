<?php
// Güvenlik başlıkları
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Content-Type: text/html; charset=UTF-8');

// POST kontrolü
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: iletişim.php");
    exit();
}

// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "u165807241_ayla";
$password = "aylaKesan22";
$dbname = "u165807241_ruhbalance";

try {
    // Veritabanı bağlantısı
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Bağlantı kontrolü
    if ($conn->connect_error) {
        throw new Exception("Veritabanı bağlantı hatası: " . $conn->connect_error);
    }
    
    // UTF-8 karakter seti ayarla
    $conn->set_charset("utf8");
    
    // POST verilerini al ve temizle
    $name = isset($_POST['name']) ? $conn->real_escape_string(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? $conn->real_escape_string(trim($_POST['phone'])) : '';
    $message = isset($_POST['message']) ? $conn->real_escape_string(trim($_POST['message'])) : '';
    
    // Zorunlu alanları kontrol et
    if (empty($name) || empty($email) || empty($message)) {
        throw new Exception("Lütfen tüm zorunlu alanları doldurun.");
    }
    
    // Email formatını kontrol et
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Geçerli bir email adresi girin.");
    }
    
    // Prepared statement kullanarak güvenli veri kaydetme
    $stmt = $conn->prepare("INSERT INTO iletisim (name, email, phone, message, created_at) VALUES (?, ?, ?, ?, NOW())");
    
    if (!$stmt) {
        throw new Exception("SQL hazırlama hatası: " . $conn->error);
    }
    
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    
    if ($stmt->execute()) {
        // Email gönderme işlemi
        $to = "ruhbalance@gmail.com";
        $subject = "Yeni İletişim Mesajı - RuhBalance";
        
        $email_message = "Yeni İletişim Mesajı Alındı\n\n";
        $email_message .= "Ad Soyad: " . $name . "\n";
        $email_message .= "Email: " . $email . "\n";
        $email_message .= "Telefon: " . $phone . "\n";
        $email_message .= "Mesaj: " . $message . "\n";
        $email_message .= "Tarih: " . date('Y-m-d H:i:s') . "\n";
        
        $headers = "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Ana email gönder
        $mail_sent = mail($to, $subject, $email_message, $headers);
        
        // Kullanıcıya teşekkür emaili
        if ($mail_sent) {
            $user_subject = "Mesajınız Alındı - RuhBalance";
            $user_message = "Sayın " . $name . ",\n\n";
            $user_message .= "Mesajınız başarıyla alınmıştır. En kısa sürede size geri dönüş yapacağız.\n\n";
            $user_message .= "RuhBalance ekibi olarak sağlıklı bir yaşam için yanınızdayız.\n\n";
            $user_message .= "Saygılarımızla,\nRuhBalance Ekibi";
            
            $user_headers = "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\n";
            $user_headers .= "Reply-To: ruhbalance@gmail.com\r\n";
            $user_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            mail($email, $user_subject, $user_message, $user_headers);
        }
        
        // Teşekkür sayfasına yönlendir
        header("Location: tesekkur.php");
        exit();
        
    } else {
        throw new Exception("Veritabanına kayıt sırasında hata oluştu: " . $stmt->error);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    // Hata durumunda
    error_log("İletişim formu hatası: " . $e->getMessage());
    $_SESSION['error_message'] = "Bir hata oluştu: " . $e->getMessage();
    header("Location: iletişim.php");
    exit();
    
} finally {
    // Bağlantıyı kapat
    if (isset($conn)) {
        $conn->close();
    }
}
?>