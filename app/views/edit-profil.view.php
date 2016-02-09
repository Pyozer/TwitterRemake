<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';
require Config::get('app.controller_paths') . 'Navbar.php';
?>
<div class="page-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="profil_edit">
                    <h2 class="page-header centered">Modification de mon profil</h2>
                    <?php flash(); ?>
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputImg" class="col-sm-2 control-label"><strong>Image de profil</strong></label>
                            <div class="col-sm-10">
                                <input type="file" id="inputImg" name="inputImg">
                                <input type="text" class="form-control" placeholder="Votre image de profil" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputBio" class="col-sm-2 control-label"><strong>Bio</strong></label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control input-lg" id="inputBio" name="inputBio" rows="3" placeholder="Votre bio"><?= $bio ?></textarea>
                                <p style="text-align: right;"><span id="counter"></span> / 140 Caractères</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary-outline btn-smlarge" name="SubmitProfil">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require Config::get('app.include_paths') . 'footer.php'; ?>