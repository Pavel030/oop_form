<?php
use App\App;

require_once '../vendor/autoload.php';
require_once '../app/routes/web.php';
// Check if the request is for the root URL '/'
if ($_SERVER['REQUEST_URI'] === '/') {
    header('Location: /form');
    exit;
}
App::run();
