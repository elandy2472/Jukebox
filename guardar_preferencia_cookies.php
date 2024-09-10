<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cookies_accepted'], $_POST['nickname'])) {

    $cookiesAccepted = $_POST['cookies_accepted'] === 'true' ? 1 : 0;
    
    $nickname = $_POST['nickname'];

    echo "Preferencia de cookies recibida: " . ($cookiesAccepted ? "Aceptada" : "Rechazada") . ". Nickname: " . $nickname;

    // Comentamos o eliminamos la lógica para guardar en la base de datos
    /*
    $mainModel = new \app\models\mainModel();

    $datos = [
        [
            'campo_nombre' => 'nickname',
            'campo_marcador' => ':nickname',
            'campo_valor' => $nickname
        ],
        [
            'campo_nombre' => 'aceptarCookies',
            'campo_marcador' => ':aceptarCookies',
            'campo_valor' => $cookiesAccepted
        ],
        [
            'campo_nombre' => 'fechaRegistro',
            'campo_marcador' => ':fechaRegistro',
            'campo_valor' => date('Y-m-d')
        ]
    ];

    $mainModel->guardarDatos('clientes', $datos);
    */

} else {
    echo "No se ha recibido ninguna preferencia de cookies o el nickname.";
}
?>

