<?php
$tr = $_GET['t'];
$partida = $_GET['p'];
$lock = "lock/$partida";
if(file_exists($lock) && ($lo=file_get_contents($lock))!=$tr) {
    $lo=$lo/1000;
    error_log("$lo <> ".microtime(true));
    while(microtime(true)<$lo){
        usleep(100);
    }
} else {
    file_put_contents($lock, $tr+500);
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
    $data->puerta = "url('img/Scan 0.jpeg')";
    $data->tesoro = "url('img/Scan 96.jpeg')";
}
if(!empty($_POST['data'])) {
    $data = json_decode($_POST['data']);
}
$data->time = microtime(true);
$json = json_encode($data);
file_put_contents($filename, $json);
echo $json;
