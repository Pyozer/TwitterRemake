<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';
require Config::get('app.controller_paths') . 'Navbar.php';
?>
<div class="page">
    <?php flash(); ?>
    <div class="row"> <!-- Bannière -->
        <div class="col-xs-12" style="max-height: 400px;overflow: hidden;">
            <img src="https://pbs.twimg.com/profile_banners/3383462333/1437334100/1500x500" style="width: 100%;">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="userinfo centered" style="padding: 30px 25px 13px 25px;background-color: #2E3F51;color: #fafafa;border-bottom: 1px solid #23303E;">
                <div class="user-imgprofil">
                    <img class="img-circle" src="<?= $imgprofil; ?>" style="width: 80px;height: 80px;">
                </div>
                <div class="user_fullname" style="margin-top: 15px;">
                    <p><strong><?= $info_profil->prenom . " " . $info_profil->nom; ?></strong>
                    </p>
                </div>
                <div class="user_username" style="margin-top: -10px;">
                    <p><small>@<?= $info_profil->pseudo; ?></small>
                    </p>
                </div>
                <div clas="user_bio" style="text-align: left;color: #ffffff;font-size: 15px;word-wrap: break-word;word-break: break-word;">
                    <p><?= $info_profil->bio; ?></p>
                </div>
                <div class="follow_user" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-xs-10 col-sm-6 col-xs-offset-1 col-sm-offset-3">
                            <?php if($info_profil->id == $_SESSION['userid']) { ?>
                                <a class="btn btn-default-outline btn-block btn-smlarge" href="/edit-profil.php" style="border-radius: 50px;">Modifier mon profil</a>
                            <?php } elseif($follow->checkFollow() == true) { ?>
                                <form method="post">
                                    <input type="hidden" name="ProfilUserid" value="<?= $info_profil->id; ?>" />
                                    <button type="submit" class="btn btn-default-outline btn-block btn-smlarge" id="follow" name="SubmitUnFollow" style="border-radius: 50px;">Ne plus suivre</button>
                                </form>
                            <?php } else { ?>
                                <form method="post">
                                    <input type="hidden" name="ProfilUserid" value="<?= $info_profil->id; ?>" />
                                    <button type="submit" class="btn btn-default-outline btn-block btn-smlarge" id="follow" name="SubmitFollow" style="border-radius: 50px;">Suivre</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="stat-user-profilinfo" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-xs-4" style="border-right: 2px solid #B9B9B9;">
                            <p><strong><?= $nbrTweets; ?></strong><br> Tweets</p>
                        </div>
                        <div class="col-xs-4" style="border-right: 2px solid #B9B9B9;">
                            <p><strong><?= $nbrFollowers; ?></strong><br> Followers</p>
                        </div>
                        <div class="col-xs-4">
                            <p><strong><?= $nbrFollow; ?></strong><br> Following</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6"> <!-- Tweets Content -->
            <div class="tweets" style="padding: 50px 60px;">
                <style>
                    .start-user-bar-div .col-xs-3 {
                        border-bottom: 5px solid #fff;
                    }
                    .start-user-bar-div .col-xs-3.active {
                        border-bottom: 5px solid #2F88D4;
                    }
                    .start-user-bar-div .col-xs-3:hover {
                        border-bottom: 5px solid #2F88D4;
                    }
                </style>
                <div class="start-user-bar-div" style="text-align: center;font-size: 16px;"> <!-- Stat bar -->
                    <div class="row" style="background-color: #fff;">
                        <div class="col-xs-3 active">
                            <div class="stat-user-bar" style="padding: 25px 0 20px 0;">
                                <p style="margin: 0;">
                                    <strong><?= $nbrTweets; ?></strong><br />Tweets
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="stat-user-bar" style="padding: 25px 0 20px 0;">
                                <p style="margin: 0;">
                                    <strong><?= $nbrMedia; ?></strong><br />Photos / Vidéos
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="stat-user-bar" style="padding: 25px 0 20px 0;">
                                <p style="margin: 0;">
                                    <strong><?= $nbrFollowers; ?></strong><br />Followers
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="stat-user-bar" style="padding: 25px 0 20px 0;">
                                <p style="margin: 0;">
                                    <strong><?= $nbrFollow; ?></strong><br />Following
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all-tweets" style="margin-top: 25px;"> <!-- Tous les tweets -->
                    <div class="row">
                        <?php require Config::get('app.controller_paths') . 'UserTweets.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="padding-right: 0;"> <!-- Sidebar -->
            <?php require Config::get('app.controller_paths') . 'Sidebar.php'; ?>
        </div>
    </div>
</div>

<?php require Config::get('app.include_paths') . 'footer.php'; ?>