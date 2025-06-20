<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input || !isset($input['mood'])) {
            throw new Exception('Mood verisi bulunamadı');
        }
        
        $mood = $input['mood'];
        $prediction = predictYogaPose($mood);
        
        echo json_encode($prediction);
        
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['test'])) {
        echo json_encode([
            'status' => 'Mood Prediction API çalışıyor',
            'time' => date('Y-m-d H:i:s')
        ]);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'mood' => isset($mood) ? $mood : 'undefined'
    ]);
}

function predictYogaPose($mood) {
    $predictions = [
        'mutlu' => [
            'pose' => 'Güneşe Selam Sekansı',
            'confidence' => rand(85, 95),
            'userCount' => rand(200, 300),
            'description' => 'Pozitif enerjinizi artırmak için dinamik yoga pozları',
            'benefits' => ['Enerji Artışı', 'Endorfin Salınımı', 'Kas Tonifikasyonu']
        ],
        'üzgün' => [
            'pose' => 'Restoratif Yoga Serisi',
            'confidence' => rand(88, 96),
            'userCount' => rand(150, 250),
            'description' => 'Duygusal dengeyi sağlayan yavaş ve nazik hareketler',
            'benefits' => ['Duygusal Denge', 'Stres Azaltma', 'İç Huzur']
        ],
        'enerjik' => [
            'pose' => 'Güç Yoga Akışı',
            'confidence' => rand(90, 98),
            'userCount' => rand(180, 280),
            'description' => 'Yüksek enerjinizi kontrollü şekilde kanalize eden güçlü pozlar',
            'benefits' => ['Kas Kuvveti', 'Odaklanma', 'Enerji Kontrolü']
        ],
        'stresli' => [
            'pose' => 'Nefes Odaklı Yin Yoga',
            'confidence' => rand(92, 99),
            'userCount' => rand(220, 320),
            'description' => 'Stres azaltmaya odaklanan derin nefes ve uzun duruş pozları',
            'benefits' => ['Stres Azaltma', 'Kortizol Dengesi', 'Derin Rahatlama']
        ]
    ];
    
    $moodKey = normalizeText($mood);
    if ($moodKey === 'uzgun') $moodKey = 'üzgün';
    
    if (!isset($predictions[$moodKey])) {
        $moodKey = 'mutlu'; 
    }
    
    $result = $predictions[$moodKey];
    $result['totalUsers'] = rand(800, 1200);
    $result['timestamp'] = date('Y-m-d H:i:s');
    
    return $result;
}

function normalizeText($text) {
    $turkish = ['ı', 'ğ', 'ü', 'ş', 'ö', 'ç', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç'];
    $english = ['i', 'g', 'u', 's', 'o', 'c', 'i', 'g', 'u', 's', 'o', 'c'];
    
    $text = str_replace($turkish, $english, $text);
    return strtolower(trim($text));
}
?>