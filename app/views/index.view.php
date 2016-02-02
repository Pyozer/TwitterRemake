<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';
require Config::get('app.controller_paths') . 'navbar.php';
?>
<div class="page">
    <!-- === Bannière === -->
    <!-- <div class="row">
        <div class="col-xs-12" style="max-height: 400px;overflow: hidden;">
            <img src="https://pbs.twimg.com/profile_banners/3383462333/1437334100/1500x500" style="width: 100%;">
        </div>
    </div> -->
    <div class="row">
        <div class="col-sm-3">
            <div class="userinfo centered" style="padding: 30px 25px 13px 25px;background-color: #2E3F51;color: #fafafa;border-bottom: 1px solid #23303E;">
                <div class="user-imgprofil">
                    <img class="img-circle" src="https://yt3.ggpht.com/-sW50T4z6KE4/AAAAAAAAAAI/AAAAAAAAAAA/ciHc2W9nqlM/s88-c-k-no/photo.jpg" style="width: 80px;height: 80px;">
                </div>
                <div class="user_fullname" style="margin-top: 15px;">
                    <p><strong><?= $infouser->prenom . " " . $infouser->nom; ?></strong>
                    </p>
                </div>
                <div class="user_username" style="margin-top: -10px;">
                    <p><small>@<?= $infouser->pseudo; ?></small>
                    </p>
                </div>
                <div clas="user_bio" style="text-align: left;color: #ffffff;font-size: 15px;">
                    <p><?= $infouser->bio; ?></p>
                </div>
                <div class="follow_user" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-xs-10 col-sm-6 col-xs-offset-1 col-sm-offset-3">
                            <button class="btn btn-default-outline btn-block btn-smlarge" style="border-radius: 50px;">Follow</button>
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
                            <p><strong>3M</strong><br> Followers</p>
                        </div>
                        <div class="col-xs-4">
                            <p><strong>135</strong><br> Following</p>
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
                                    <strong>350</strong><br />Photos / Vidéos
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="stat-user-bar" style="padding: 25px 0 20px 0;">
                                <p style="margin: 0;">
                                    <strong>3M</strong><br />Followers
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="stat-user-bar" style="padding: 25px 0 20px 0;">
                                <p style="margin: 0;">
                                    <strong>135</strong><br />Following
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all-tweets" style="margin-top: 25px;"> <!-- Tous les tweets -->
                    <div class="row">
                        <?php require Config::get('app.controller_paths') . 'tweet.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3" style="padding-right: 0;"> <!-- Sidebar -->
            <div class="sidebar" style="background-color: #fff;padding: 20px 0 15px 40px;">
                <h4 class="page-header"><strong>Personnes que vous pourriez suivre</strong></h4>
                <ul style="list-style: none;padding: 0;">
                    <?php for($i=0;$i<4;$i++) { ?>
                    <li style="padding: 15px 0 10px 3px;">
                        <div class="row">
                            <div class="col-xs-7">
                                <img class="img-circle" src="https://yt3.ggpht.com/-sW50T4z6KE4/AAAAAAAAAAI/AAAAAAAAAAA/ciHc2W9nqlM/s88-c-k-no/photo.jpg" style="width: 40px;height: 40px;margin-right: 17px;float: left;">
                                <strong>Abraham Lincoln</strong><br />
                                <small>@lincoln</small>
                            </div>
                            <div class="col-xs-5">
                                <button class="btn btn-primary-outline btn-sm">Suivre</button>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <h4 class="page-header"><strong>Tendances</strong></h4>
                <ul style="list-style: none;padding: 0;">
                    <li style="padding: 8px 0;"><a href="#">Republique</a></li>
                    <li style="padding: 8px 0;"><a href="#">#VTEP</a></li>
                    <li style="padding: 8px 0;"><a href="#">#WeLoveDonaldTrump</a></li>
                    <li style="padding: 8px 0;"><a href="#">#TwitterRemake</a></li>
                    <li style="padding: 8px 0;"><a href="#">#Interminale</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require Config::get('app.include_paths') . 'footer.php'; ?>