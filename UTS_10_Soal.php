<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Pilihan Ganda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:#FFF0F5;
            margin: 0;
            display: flex;
            padding: 20px;
        }
        .quiz-container {
            flex: 1;
            margin-left: 20px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .index-container {
            width: 200px;
            background-color: #FF69B4;
            padding: 10px;
            border-radius: 8px;
            color: white;
            height: fit-content;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .index-item {
            margin: 5px 0;
        }
        .index-item a {
            text-decoration: none;
            color: white;
        }
        .answered-link {
            color: #ccc; /* Warna abu-abu untuk link soal yang sudah dijawab */
        }
        .question {
            margin-bottom: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .option {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .option:hover {
            background: #e1e1e1;
        }
        .option input {
            margin-right: 10px;
        }
        .answered {
            background-color:  #DB7093; /* Warna merah muda untuk soal yang sudah dijawab */
        }
        input[type="submit"] {
            background-color:#DB7093 ;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #DB7093;
        }
        .feedback {
            margin-top: 20px;
            font-size: 1em;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    // Jika session belum ada, inisialisasi array untuk menyimpan status jawaban
    if (!isset($_SESSION['answered'])) {
        $_SESSION['answered'] = array_fill(0, 9, false);
    }
    $soal = [
        [
            'pertanyaan' => 'Pernyataan berikut ini yang memiliki bilangan bulat negatif, kecuali...',
            'pilihan' => ['Suhu udara di Bromo 3 derajat di bawah nol', 'Hiu menyelam di kedalaman 13 meter di bawah permukaan air laut', 'Betari melangkah mundur 4 langkah','Suhu badan Sankara saat ini 40 derajat celcius'],
            'jawaban_benar' => 'Suhu badan Sankara saat ini 40 derajat celcius'
        ],
        [
            'pertanyaan' => 'Berikut yang bukan termasuk bilanagan bulat positif adalah...',
            'pilihan' => ['4', '0', '100', '2024'],
            'jawaban_benar' => '0'
        ],
        [
            'pertanyaan' => 'Bilangan bulat yang terletak antara 10 dan -1...',
            'pilihan' => ['1.5','1/2','10%','1'],
            'jawaban_benar' => '1'

        ],
        [
            'pertanyaan' => 'Berikut ini bilangan yang lebih kecil dari -170 adalah...',
            'pilihan' => ['-172','-120', '-168', '-167'],
            'jawaban_benar' => '-172'
        ],
        [
            'pertanyaan' => 'Berikut yang bukan termasuk bilangan bulat negatif adalah...',
            'pilihan' => ['-100', '-2024', '-1', '0'],
            'jawaban_benar' => '0'
        ],
        [
            'pertanyaan' => 'Berikut yang termasuk bilangan bulat positif adalah...',
            'pilihan' => ['96', '-364', '-109000', '-96'],
            'jawaban_benar' => '96'
        ],
        [
            'pertanyaan' => 'Pernyataan berikut ini yang tepat apabila diberi tanda pembanding berupa > adalah...',
            'pilihan' => ['-800...-79', '-9000...900', '-189...-200', '-50...-5'],
            'jawaban_benar' => '-189...-200'
        ],
        [
            'pertanyaan' => 'Urutan bilangan di bawah ini yang paling tepat jika diurutkan dari yang paling besar ke paling kecil adalah...',
            'pilihan' => ['-189,-190,-200,-1000', '91,-9,100,0','0,1,2,2', '100,101,107,108'],
            'jawaban_benar' => '-189,-190,-200,-1000'
        ],
        [
            'pertanyaan' => 'Urutan bilangan di bawah ini yang paling tepat jika diurutkan dari yang paling kecil ke paling besar adalah...',
            'pilihan' => ['-15,-13,-11,-9','-9,-11,-13,-15','15,13,11,9','4,3,2,1'],
            'jawaban_benar' => '-15,-13,-11,-9'
        ],
        [
            'pertanyaan' => 'Pernyataan berikut ini yang tepat apabila diberi tanda pembanding berupa < adalah...',
            'pilihan' => ['5...4', '-10...-14', '-189...-200', '-2024...-24'],
            'jawaban_benar' => '-2024...-24'
        ]
    ];


// Inisialisasi sesi untuk menyimpan jawaban
if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = array_fill(0, count($soal), null);
}
// Tampilkan indeks soal
echo '<div class="index-container">';
echo '<h2>Indeks Soal</h2>';
echo '<ul>';
foreach ($soal as $index => $item)
{
    $class = $_SESSION['answered'][$index] ? 'answered-link' : '';
    echo '<li class="index-item"><a href="?soal=' . $index . '" class="' . $class . '">Soal ' . ($index + 1) . '</a></li>';
}
echo '</ul>';
echo '</div>';

// Dapatkan indeks pertanyaan saat ini
$currentQuestionIndex = isset($_SESSION['currentQuestionIndex']) ? $_SESSION['currentQuestionIndex'] : 0;

// Proses navigasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['answer'])) {
        // Simpan jawaban pengguna
        $_SESSION['answers'][$currentQuestionIndex] = $_POST['answer'];
    }
    
    if (isset($_POST['next'])) {
        $currentQuestionIndex++;
    } elseif (isset($_POST['previous'])) {
        $currentQuestionIndex--;
    }
    
    // Pastikan indeks tidak keluar dari batas
    $currentQuestionIndex = max(0, min($currentQuestionIndex, count($soal) - 1));
    
    $_SESSION['currentQuestionIndex'] = $currentQuestionIndex;
}

// Dapatkan pertanyaan dan opsi saat ini
$currentQuestion = $soal[$currentQuestionIndex];
$pilihan = $currentQuestion['pilihan'];
shuffle($pilihan);

// Tampilkan soal
echo '<div class="quiz-container">';
echo '<div class="question">';

?>
<div class="container">
        <h1>Kuis Matematika</h1>
        <form action="UTS_10_Soal.php" method="post">
            <p><?php echo ($currentQuestionIndex + 1) . ". " . $currentQuestion['pertanyaan']; ?></p>
            <?php foreach ($pilihan as $index => $pilihan): ?><br>
                <input type="radio" name="answer" value="<?php echo $pilihan; ?>" <?php echo isset($_SESSION['answers'][$currentQuestionIndex]) && $_SESSION['answers'][$currentQuestionIndex] === $pilihan ? 'checked' : ''; ?>> <?php echo chr(65 + $index) . ". " . $pilihan; ?><br>
            <?php endforeach; ?>
            <div class="navigation">
                <?php if ($currentQuestionIndex > 0): ?> <br>
                    <input type="submit" name="previous" value="Previous"><br>
                <?php endif; ?>
                <?php if ($currentQuestionIndex < count($soal) - 1): ?> <br>
                    <input type="submit" name="next" value="Next"> <br><br>
                <?php else: ?> <br>
                    <input type="submit" formaction="UTS_10_Jawaban.php" value="Submit">
                <?php endif; ?>
            </div>
        </form>
    </div>