<?php

$mesaj = "Salut! Acesta este un mesaj din PHP 🎉";


if (PHP_SAPI === 'cli') {
    echo $mesaj . PHP_EOL;
    exit;
}


?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Mesaj PHP</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f0f4ff;
        }
        .card {
            background: white;
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 { color: #3b4cca; margin: 0 0 0.5rem; }
        p  { color: #555; margin: 0; }
    </style>
</head>
<body>
    <div class="card">
        <h1>📢 <?= htmlspecialchars($mesaj) ?></h1>
        <p>Afișat în browser via PHP</p>
    </div>
</body>
</html>

<?php
$sir=[1,2,3,4,5,6,7,8,9,10];
$sImpar = 0;
$sPar = 0;

for ($i=0;$i<10;$i++){
    if ($sir[$i]%2==0){
        $sPar++;
    }else{
        $sImpar++;
    }}
echo "<h3>total numere pare:".$sPar."</h3>";
echo "<h3>total numere impare:".$sImpar."</h3>";
?>