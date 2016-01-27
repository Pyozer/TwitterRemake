<?php
use Core\Config;
require Config::get('app.include_paths') . 'header.php';
?>

<p>Hello World !</p>

<?php require Config::get('app.include_paths') . 'footer.php'; ?>