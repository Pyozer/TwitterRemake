<?php
use Core\Config;
require Config::get('app.include_paths') . 'header.php';

require Config::get('app.controller_paths') . 'navbar.php';
?>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
                <?php require Config::get('app.controller_paths') . 'tweet.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php require Config::get('app.include_paths') . 'footer.php'; ?>