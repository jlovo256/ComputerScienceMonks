
<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

require_once 'app.php';

$app = new App();
$app->addRoute('/users/josh', function () {
    $this->responseContentType = 'application/json;charset=utf8';
    $this->responseBody = '{"name": "Josh"}';
});
$app->dispatch('/users/josh');