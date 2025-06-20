<?php

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

session_start();

// Güvenlik: Admin girişi kontrol et
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Çıkış işlemi
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: eşrefruya_tekpanel.php');
    exit();
}

// Veritabanı bağlantısı
$db_config = [
    'host' => 'localhost',
    'name' => 'u165807241_ruhbalance', 
    'user' => 'u165807241_ayla',
    'pass' => 'aylaKesan22'
];

try {
    $pdo = new PDO("mysql:host={$db_config['host']};dbname={$db_config['name']};charset=utf8mb4", 
                   $db_config['user'], $db_config['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// İstatistikleri al - DÜZELTILDI
function getStats($pdo) {
    $stats = [];
    $queries = [
        'total_users' => "SELECT COUNT(*) FROM kullanicilar",
        'total_comment' => "SELECT COUNT(*) FROM yorumlar",
        'active_users' => "SELECT COUNT(*) FROM kullanici_profilleri WHERE son_giris_tarihi >= DATE_SUB(NOW(), INTERVAL 30 DAY)",
        'unread_messages' => "SELECT COUNT(*) FROM iletisim WHERE okundu = 0"
    ];
    
    foreach($queries as $key => $query) {
        try {
            $stmt = $pdo->query($query);
            $result = $stmt->fetchColumn();
            $stats[$key] = $result !== false ? $result : 0;
        } catch(PDOException $e) {
            $stats[$key] = 0;
            // Debug için hata mesajını göster
            error_log("İstatistik hatası ($key): " . $e->getMessage());
        }
    }
    return $stats;
}

// CRUD İşlemleri
$message = '';
$message_type = '';

// Kullanıcı silme
if (isset($_POST['delete_user']) && isset($_POST['user_id'])) {
    $user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
    if ($user_id) {
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("DELETE FROM kullanici_profilleri WHERE kullanici_id = ?");
            $stmt->execute([$user_id]);
            $stmt = $pdo->prepare("DELETE FROM kullanicilar WHERE id = ?");
            $stmt->execute([$user_id]);
            $pdo->commit();
            $message = "Kullanıcı başarıyla silindi.";
            $message_type = "success";
        } catch(PDOException $e) {
            $pdo->rollBack();
            $message = "Hata: " . $e->getMessage();
            $message_type = "error";
        }
    }
}

// Mesaj okundu işaretleme veya silme
if ((isset($_POST['mark_read']) || isset($_POST['delete_message'])) && isset($_POST['message_id'])) {
    $message_id = filter_var($_POST['message_id'], FILTER_VALIDATE_INT);
    if ($message_id) {
        try {
            if (isset($_POST['mark_read'])) {
                $stmt = $pdo->prepare("UPDATE iletisim SET okundu = 1 WHERE id = ?");
                $stmt->execute([$message_id]);
                $message = "Mesaj okundu olarak işaretlendi.";
            }

            if (isset($_POST['delete_message'])) {
                $stmt = $pdo->prepare("DELETE FROM iletisim WHERE id = ?");
                $stmt->execute([$message_id]);
                $message = "Mesaj silindi.";
            }

            $message_type = "success";
        } catch(PDOException $e) {
            $message = "Hata: " . $e->getMessage();
            $message_type = "error";
        }
    }
}


// Yorum onaylama işlemi
if (isset($_POST['approve_comment']) && isset($_POST['comment_id'])) {
    $comment_id = filter_var($_POST['comment_id'], FILTER_VALIDATE_INT);
    if ($comment_id) {
        try {
            $stmt = $pdo->prepare("UPDATE yorumlar SET durum = 'onaylandi' WHERE id = ?");
            $stmt->execute([$comment_id]);
            $message = "Yorum onaylandı.";
            $message_type = "success";
        } catch(PDOException $e) {
            $message = "Hata: " . $e->getMessage();
            $message_type = "error";
        }
    }
}

// Yorum silme işlemi
if (isset($_POST['delete_comment']) && isset($_POST['comment_id'])) {
    $comment_id = filter_var($_POST['comment_id'], FILTER_VALIDATE_INT);
    if ($comment_id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM yorumlar WHERE id = ?");
            $stmt->execute([$comment_id]);
            $message = "Yorum silindi.";
            $message_type = "success";
        } catch(PDOException $e) {
            $message = "Hata: " . $e->getMessage();
            $message_type = "error";
        }
    }
}

// İstatistikleri al
$stats = getStats($pdo);

// Verileri çek - DÜZELTİLDİ
$users = [];
$messages = [];
$comments = [];

try {
    // Kullanıcı profilleri sayfasından veriler alındı 
    $userQuery = "
        SELECT 
            k.id, 
            k.ad, 
            k.email, 
            k.kayit_tarihi, 
            k.son_giris_tarihi,
            COALESCE(kp.telefon, '') AS telefon,
            COALESCE(kp.bio, '') AS bio,
            kp.dogum_tarihi,
            kp.cinsiyet,
            kp.profil_foto,
            kp.olusturma_tarihi,
            kp.guncelleme_tarihi
        FROM kullanicilar k
        LEFT JOIN kullanici_profilleri kp ON k.id = kp.kullanici_id
        ORDER BY k.kayit_tarihi DESC
        LIMIT 20
    ";
    
    $stmt = $pdo->prepare($userQuery);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    $message .= " Kullanıcı verileri alınırken hata: " . $e->getMessage();
    $users = [];
}

try {
    //iletisim sayfasındaki mesajları çekiyoruz
    $messageQuery = "
        SELECT id, name, email, phone, message
        FROM iletisim
        ORDER BY id DESC
        LIMIT 10
    ";
    $stmt = $pdo->prepare($messageQuery);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $message .= " Mesaj verileri alınırken hata: " . $e->getMessage();
    $messages = [];
}


try {
    // Yorumları çek - tablo yapısına göre düzenlendi
    $commentQuery = "
        SELECT id, rating, opinion, tarih
        FROM yorumlar
        ORDER BY tarih DESC 
        LIMIT 20
    ";
    $stmt = $pdo->prepare($commentQuery);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $message .= " Yorum verileri alınırken hata: " . $e->getMessage();
    $comments = [];
}




?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuhaBalance - Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
        }

        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        .content {
            padding: 30px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section h2 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 2px;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status-unread {
            background: #fff3cd;
            color: #856404;
            font-weight: bold;
        }

        .status-read {
            background: #d4edda;
            color: #155724;
        }

        .debug-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-family: monospace;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 10px;
            }
            
            .content {
                padding: 20px;
            }
            
            .stats {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                gap: 10px;
            }
            
            table {
                font-size: 14px;
            }
            
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>🧘‍♀️ RuhBalance Admin Panel</h1>
                <small>Hoş geldin, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>!</small>
            </div>
            <a href="?logout=1" class="logout-btn" onclick="return confirm('Çıkış yapmak istediğinizden emin misiniz?')">
                🚪 Çıkış Yap
            </a>
        </div>

       
            <!-- Mesajlar -->
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- İstatistikler -->
            <div class="stats">
                <div class="stat-card">
                    <h3><?php echo $stats['total_users']; ?></h3>
                    <p>Toplam Üye</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $stats['total_comment']; ?></h3>
                    <p>Toplam Yorum</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $stats['active_users']; ?></h3>
                    <p>Aktif Üye</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $stats['unread_messages']; ?></h3>
                    <p>Okunmamış Mesaj</p>
                </div>
            </div>

            <!-- Kullanıcılar -->
            <div class="section">
                <h2>👥 Son Kullanıcılar (<?php echo count($users); ?>)</h2>
                <?php if (!empty($users)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kullanıcı Adı</th>
                            <th>Ad Soyad</th>
                            <th>Email</th>
                            <th>Kayıt Tarihi</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['kullanici_adi']); ?></td>
                            <td><?php echo htmlspecialchars(trim($user['ad'] . ' ' . $user['soyad']) ?: '-'); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo date('d.m.Y', strtotime($user['kayit_tarihi'])); ?></td>
                            <td>
                                <span class="status-badge <?php echo $user['durum'] == 'aktif' ? 'status-active' : 'status-inactive'; ?>">
                                    <?php echo ucfirst($user['durum']); ?>
                                </span>
                            </td>
                            <td>
                                <form method="post" style="display: inline;" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" name="delete_user" class="btn btn-danger">Sil</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p>Henüz kullanıcı bulunmuyor.</p>
                <?php endif; ?>
            </div>

            <!-- İletişim Mesajları -->
<div class="section">
    <h2>💬 Son İletişim Mesajları (<?php echo count($messages); ?>)</h2>
    <?php if (!empty($messages)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Email</th>
                <th>Konu</th>
                <th>Mesaj</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($messages as $msg): ?>
            <tr>
                <td><?php echo $msg['id']; ?></td>
                <td><?php echo htmlspecialchars($msg['ad']); ?></td>
                <td><?php echo htmlspecialchars($msg['email']); ?></td>
                <td><?php echo htmlspecialchars($msg['konu']); ?></td>
                <td><?php echo htmlspecialchars(substr($msg['mesaj'], 0, 50)) . '...'; ?></td>
                <td><?php echo date('d.m.Y', strtotime($msg['olusturma_tarihi'])); ?></td>
                <td>
                    <span class="status-badge <?php echo $msg['okundu'] ? 'status-read' : 'status-unread'; ?>">
                        <?php echo $msg['okundu'] ? 'Okundu' : 'Okunmadı'; ?>
                    </span>
                </td>
                <td>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
                        <?php if (!$msg['okundu']): ?>
                            <button type="submit" name="mark_read" class="btn btn-info">Okundu</button>
                        <?php endif; ?>
                        <button type="submit" name="delete_message" class="btn btn-danger" onclick="return confirm('Mesajı silmek istediğinize emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>Henüz mesaj bulunmuyor.</p>
    <?php endif; ?>
</div>


            <!-- Yorumlar -->
            <div class="section">
                <h2>💭 Son Yorumlar (<?php echo count($comments); ?>)</h2>
                <?php if (!empty($comments)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Puan</th>
                            <th>Yorum</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($comments as $comment): ?>
                        <tr>
                            <td><?php echo $comment['id']; ?></td>
                            <td><?php echo $comment['rating']; ?> ⭐</td>
                            <td><?php echo htmlspecialchars(substr($comment['opinion'], 0, 50)) . '...'; ?></td>
                            <td><?php echo date('d.m.Y H:i', strtotime($comment['olusturma_tarihi'])); ?></td>
                            <td>
                                <span class="status-badge <?php echo (isset($comment['durum']) && $comment['durum'] == 'onaylandi') ? 'status-active' : 'status-inactive'; ?>">
                                    <?php echo (isset($comment['durum']) && $comment['durum'] == 'onaylandi') ? 'Onaylı' : 'Beklemede'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!isset($comment['durum']) || $comment['durum'] != 'onaylandi'): ?>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <button type="submit" name="approve_comment" class="btn btn-success">Onayla</button>
                                </form>
                                <?php endif; ?>
                                
                                <form method="post" style="display: inline;" onsubmit="return confirm('Bu yorumu silmek istediğinizden emin misiniz?')">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                    <button type="submit" name="delete_comment" class="btn btn-danger">Sil</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p>Henüz yorum bulunmuyor.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>