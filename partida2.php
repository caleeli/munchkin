<?php
$counter = $_GET['c'];
$partida = $_GET['p'];
$controlZ = isset($_GET['z']) ? $_GET['z'] * 1 : 0;
$filename = "partidas2/{$partida}.json";
if (!file_exists($filename)) {
    $moves = [];
    $puertas = glob("img/Door/*.jpeg");
    shuffle($puertas);
    foreach ($puertas as $f) {
        $moves[] = ['action' => 'addCardDo', 'arguments' => ["url('$f')", 'vm.puertas']];
    }
    $tesoros = glob("img/Treasures/*.jpeg");
    shuffle($tesoros);
    foreach ($tesoros as $f) {
        $moves[] = ['action' => 'addCardDo', 'arguments' => ["url('$f')", 'vm.tesoros']];
    }
} else {
    $moves = json_decode(file_get_contents($filename));
}
if (!empty($_POST['data'])) {
    $data = json_decode($_POST['data']);
    if (!empty($data)) {
        foreach ($data as $d) {
            $moves[] = $d;
        }
        $json = json_encode($moves);
        file_put_contents($filename, $json);
    }
}
if ($controlZ) {
    $moves = array_slice($moves, 0, -$controlZ);
}
echo json_encode(['counter' => count($moves), 'moves'   => array_slice($moves,
                                                                       $counter)]);
