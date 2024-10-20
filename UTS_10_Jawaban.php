<?php
session_start();

// Daftar jawaban benar
$correctAnswers = ["Suhu badan Sankara saat ini 40 derajat celcius", "0", "1", "-172", "0", "96", "-189...-200", "-189,-190,-200,-1000", "-15,-13,-11,-9", "-2024...-24"];

// Hitung skor
$score = 0;
$debugInfo = []; // Array untuk menyimpan informasi debugging

foreach ($_SESSION['answers'] as $index => $answer) {
    $isCorrect = $answer === $correctAnswers[$index];
    if ($isCorrect) {
        $score += 10; // Setiap jawaban benar bernilai 10 poin
    }
    // Simpan informasi debugging
    $debugInfo[] = [
        'Pertanyaan' => $index + 1,
        'userAnswer' => $answer,
        'correctAnswer' => $correctAnswers[$index],
        'isCorrect' => $isCorrect
    ];
}

// Hapus sesi setelah diproses
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Kuis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #FF69B4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            font-size: 18px;
        }
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            overflow: auto;
            max-height: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hasil Kuis</h1>
        <p>Skor Anda: <?php echo $score; ?> dari 100</p>
    </div>
</body>
</html>