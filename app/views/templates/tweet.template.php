<div class="tweet">
    <div class="media">
        <div class="media-left">
            <a href="<?= $href; ?>">
                <img class="media-object img-profil-tweet img-circle" data-src="holder.js/70x70" alt="70x70" src="<?= $img_profil; ?>" data-holder-rendered="true">
            </a>
        </div>
        <div class="media-body">
            <a class="media-heading tweet-user" href="/connexion.php">
                <strong class="tweet-fullname"><?= $user_fullname; ?></strong>
                <span class="tweet-username"><?= $user_username; ?></span>
            </a>
            <small class="time"><?= $date_publish; ?></small>
            <p class="tweet-text"><?= $tweet_text; ?></p>
            <img class="tweet-imgpost" src="https://pbs.twimg.com/media/CZ6opzQWAAER_JL.jpg">
            <div class="tweet-description centered">
                <div class="row">
                    <div class="col-xs-4">
                        <button type="button" class="tweet-button btn-reply"><i class="fa fa-reply"></i></button> 4841
                    </div>
                    <div class="col-xs-4">
                        <button type="button" class="tweet-button btn-fav"><i class="fa fa-star"></i></button> 6841
                    </div>
                    <div class="col-xs-4">
                        <button type="button" class="tweet-button btn-rt"><i class="fa fa-retweet"></i></button> 1203
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>