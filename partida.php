<?php
$tr = $_GET['t'];
$partida = $_GET['p'];
$lock = "lock/$partida";
if($tr!=='0') {
    if (file_exists($lock)) {
        while (file_exists($lock)) {
            list($lo, $ttl) = explode(':', file_get_contents($lock));
            if ($lo == $tr) break;
            $ttl0 = $ttl*1;
            error_log($ttl0);
            if ($ttl0 < microtime(true)) {
                $ttl = microtime(true) + 0.2;
                break;
            }
            usleep(100);
        }
        //var_dump("$tr:$ttl", microtime(true) * 1000);die();
        file_put_contents($lock, "$tr:$ttl");
    } else {
        $ttl = microtime(true) + 0.2;
        //var_dump("$tr:$ttl", microtime(true) * 1000);die();
        file_put_contents($lock, "$tr:$ttl");
    }
}
$filename = "partidas/{$partida}.json";
if (file_exists($filename)) {
    $data = json_decode(file_get_contents($filename));
} else {
    $puerta = [];
    foreach (glob("img/Door/*.jpeg") as $f) {
        $puerta[] = "url('$f')";
    }
    $tesoros = [];
    foreach (glob("img/Treasures/*.jpeg") as $f) {
        $tesoros[] = "url('$f')";
    }
    shuffle($puerta);
    shuffle($tesoros);
    $data = new stdClass();
    $data->puertas = $puerta;
    $data->tesoros = $tesoros;
    $data->manos = [];
    $data->players = [];
    $data->trash1 = [];
    $data->trash2 = [];
    $data->puerta = "url('img/Scan 0.jpeg')";
    $data->tesoro = "url('img/Scan 96.jpeg')";
}
if (!empty($_POST['data'])) {
    $data = json_decode($_POST['data']);
}
$data->time = microtime(true);
$json = json_encode($data);
file_put_contents($filename, $json);
if($tr==='0') {
    file_put_contents($filename.'.bak', $json);
}
echo $json;
