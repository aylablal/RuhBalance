<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Önbellek kontrolü - gerçek zamanlı veri için
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 27 May 2025 05:00:00 GMT');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stats = getCurrentMoodStatistics();
    echo json_encode($stats);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

function getCurrentMoodStatistics() {
    $csvFile = 'data/veri_temiz.csv';
    $stats = [
        'mutlu' => 0,
        'üzgün' => 0,
        'enerjik' => 0,
        'stresli' => 0,
        'toplam' => 0,
        'son_guncelleme' => date('Y-m-d H:i:s')
    ];
    
    if (!file_exists($csvFile)) {
        // CSV yoksa varsayılan değerler döndür
        return $stats;
    }
    
    try {
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            // İlk satırı atla (headers)
            $headers = fgetcsv($handle);
            
            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) >= count($headers)) {
                    $data = array_combine($headers, $row);
                    
                    // Mood sütununu kontrol et
                    $mood = isset($data['Mood']) ? strtolower(trim($data['Mood'])) : '';
                    
                    // Türkçe karakterleri temizle ve normalize et
                    $mood = normalizeText($mood);
                    
                    switch ($mood) {
                        case 'mutlu':
                        case 'happy':
                        case 'joyful':
                            $stats['mutlu']++;
                            break;
                            
                        case 'uzgun':
                        case 'üzgün':
                        case 'sad':
                        case 'depressed':
                            $stats['üzgün']++;
                            break;
                            
                        case 'enerjik':
                        case 'energetic':
                        case 'active':
                        case 'excited':
                            $stats['enerjik']++;
                            break;
                            
                        case 'stresli':
                        case 'stressed':
                        case 'anxious':
                        case 'worried':
                            $stats['stresli']++;
                            break;
                    }
                }
            }
            fclose($handle);
            
            // Toplam hesapla
            $stats['toplam'] = $stats['mutlu'] + $stats['üzgün'] + 
                              $stats['enerjik'] + $stats['stresli'];
                              
            // Gerçek zamanlı veri ekle (eğer session data varsa)
            $stats = addRealtimeData($stats);
            
        }
    } catch (Exception $e) {
        error_log("CSV okuma hatası: " . $e->getMessage());
        // Hata durumunda varsayılan değerler döndür
        return $stats;
    }
    
    return $stats;
}

function normalizeText($text) {
    // Türkçe karakterleri düzelt
    $turkish = ['ı', 'ğ', 'ü', 'ş', 'ö', 'ç', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç'];
    $english = ['i', 'g', 'u', 's', 'o', 'c', 'i', 'g', 'u', 's', 'o', 'c'];
    
    $text = str_replace($turkish, $english, $text);
    $text = strtolower(trim($text));
    
    return $text;
}

function addRealtimeData($stats) {
    // Session tabanlı gerçek zamanlı veri (eğer varsa)
    $sessionFile = 'data/session_moods.json';
    
    if (file_exists($sessionFile)) {
        try {
            $sessionData = json_decode(file_get_contents($sessionFile), true);
            
            if (is_array($sessionData)) {
                foreach ($sessionData as $mood => $count) {
                    if (isset($stats[$mood])) {
                        $stats[$mood] += $count;
                        $stats['toplam'] += $count;
                    }
                }
            }
        } catch (Exception $e) {
            error_log("Session veri okuma hatası: " . $e->getMessage());
        }
    }
    
    return $stats;
}

// Kullanıcı verilerini kaydetmek için helper fonksiyon
function saveMoodToSession($mood) {
    $sessionFile = 'data/session_moods.json';
    $sessionData = [];
    
    // Mevcut session verilerini oku
    if (file_exists($sessionFile)) {
        $content = file_get_contents($sessionFile);
        $sessionData = json_decode($content, true) ?: [];
    }
    
    // Veriyi güncelle
    $mood = normalizeText($mood);
    $sessionData[$mood] = ($sessionData[$mood] ?? 0) + 1;
    
    // Dosyaya kaydet
    if (!is_dir('data')) {
        mkdir('data', 0755, true);
    }
    
    file_put_contents($sessionFile, json_encode($sessionData, JSON_PRETTY_PRINT));
    
    return true;
}

// Test endpoint (debugging için)
if (isset($_GET['test'])) {
    echo json_encode([
        'status' => 'API çalışıyor',
        'csv_exists' => file_exists('data/veri_temiz.csv'),
        'current_time' => date('Y-m-d H:i:s'),
        'sample_stats' => getCurrentMoodStatistics()
    ]);
}
?>