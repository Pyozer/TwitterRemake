    <!-- jQuery 2.2.0 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Lightbox (custom) -->
    <script src="/assets/lightbox/js/lightbox.js"></script>
    <!-- Material Design -->
    <script src="/assets/js/material.js"></script>
    <script src="/assets/js/ripples.js"></script>
    <!-- TimeAgo (custom) -->
    <script src="/assets/js/jquery.timeago.js" type="text/javascript"></script>
    <script src="/assets/js/twitter.js" type="text/javascript"></script>
    <script src="/assets/js/twitter.js" type="text/javascript"></script>
    <!-- Initialisation des scripts -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            /* On initialise Material Design */
            $.material.init();
            /* On initialise TimeAgo */
            jQuery("time.timeago").timeago();
            /* Initialise le compteur de caractère */
            $('#inputBio').simplyCountable({
                counter: '#counter',
                countType: 'characters',
                maxCount: 160,
                strictMax: true,
                countDirection: 'up',
                safeClass: 'safe',
                overClass: 'over',
                thousandSeparator: ' ',
                onOverCount: function(count, countable, counter){},
                onSafeCount: function(count, countable, counter){},
                onMaxCount: function(count, countable, counter){}
            });
        });
    </script>
    </body>
</html>