<div class="tweet">
    <div class="media">
        <div class="media-left">
            <a href="<?= $href; ?>">
                <img class="media-object img-profil-tweet img-circle" alt="<?= $user_username; ?>" src="<?= $img_profil; ?>">
            </a>
        </div>
        <div class="media-body">
            <a class="media-heading tweet-user" href="<?= $href; ?>">
                <strong class="tweet-fullname"><?= $user_fullname; ?></strong>
                <span class="tweet-username"><?= $user_username; ?></span>
            </a>
            <time class="time timeago" datetime="<?= $date_timeago; ?>"><?= $date_publish; ?></time>
            <p class="tweet-text"><?= $tweet_text; ?></p>
            <?php if($img_tweet) { echo '<img class="tweet-imgpost" src="' . $img_tweet . '" data-lightbox="Tweet' . $idtweet . '">'; } ?>
            <div class="tweet-description">
                <div class="row">
                    <div class="col-xs-2">
                        <button type="button" class="tweet-button btn-reply"><i class="fa fa-reply"></i> <?= $nbr_reply; ?></button>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="tweet-button btn-fav"><i class="fa fa-star"></i> <?= $nbr_fav; ?></button>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="tweet-button btn-rt"><i class="fa fa-retweet"></i> <?= $nbr_rt; ?></button>
                    </div>
                    <div class="col-xs-2 col-xs-offset-4" style="text-align: right;padding-right: 30px;">
                        <button type="button" class="tweet-button"><i class="fa fa-ellipsis-h"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>