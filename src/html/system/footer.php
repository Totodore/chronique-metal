<footer id="footer">
    <div id="social_network">
<!--         <h3 class="title_social_network">Contactez-nous :</h3> -->
        <ul class="social-links">
            <li class="social-icon fb">
                <a href="https://www.facebook.com/ChroniqueMetal/" target="_blank"><img src="/src/images/social-icons/facebook_icon.png" class="social-image fb"/></a>
            </li>
            <li class="social-icon yt">
                <a href="https://www.youtube.com/c/ChroniqueMetal" target="_blank"><img src="/src/images/youtube_full_color_icon/social/128px/red/youtube_social_circle_red.png" class="social-image"/></a>
            </li>
            <li class="social-icon spotify">
                <a href="https://open.spotify.com/user/chronique.metal" target="_blank"><img src="/src/images/social-icons/spotify_icon.png" class="social-image" /></a>
            </li>
            <li class="social-icon mail">
                <a href="mailto:cronique.metal@gmail.com" target="_blank"><img src="/src/images/social-icons/mail_icon.png" class="social-image"/></a>
        </ul>
    </div>
    <span class="change_notif">
            <?php if (isset($_COOKIE['notif']) AND $_COOKIE['notif'] == 'true') 
                echo "<a href='/fr/?notif=false'>Désactiver les notifications</a>"; 
            else 
                echo "<a href='/fr/?notif=true'>Activer les notifications</a>";?></a>
    </span>
    <p class="terms">En naviguant sur ce site vous acceptez <a href="https://www.youtube.com/t/terms">les conditions d'utilisation de Youtube</a></p>
    <p class="credit">Site Web développé par <a href="mailto:prevottheodore@gmail.com" class="contact_mail">Théodore Prévot.</a></p>
</footer>