<?php
/*
Widget-title: Logo and Social links
Widget-preview-image: /assets/img/widgets_preview/footer_logo.jpg
*/
?>
<div class="col-lg-3 col-md-6 hidden-md-down">
    <div class="logo"><a href="{homepage_url_lang}"><img src="assets/img/logo_white.png" alt=""></a></div>
    <div class="social">
        <ul>
            <li><a href="https://www.facebook.com/share.php?u={homepage_url}&title=<?php echo urlencode($settings_websitetitle);?>"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook-f"></i></a></li>
            <li><a href="https://twitter.com/home?status=<?php echo urlencode($settings_websitetitle);?>%20{homepage_url}"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter"></i></a></li>
        </ul>
    </div>
</div>