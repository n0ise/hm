<footer class="hm-footer">
    <div class="container">
        <div>
            <a href="/impressum" target="_blank">Impressum</a>
            <a href="/agb" target="_blank">AGB</a>
            <a href="/datenschutz" target="_blank">Datenschutz</a>
        </div>
        <div>
            <img src="https://hellomed.com/wp-content/uploads/2022/05/Artboard.svg">
            <img src="https://hellomed.com/wp-content/uploads/2022/05/Artboard-Copy.svg">
            <img src="https://hellomed.com/wp-content/uploads/2022/05/Artboard-Copy-2.svg">
            <img src="https://hellomed.com/wp-content/uploads/2022/05/Artboard-Copy-3.svg">
        </div>
    </div>
</footer>

<script src="https://ui.hellomed.com/src/v1.1/js/bootstrap.5.3.0.bundle.min.js"></script>

<!-- Custom js -->
<script src="https://ui.hellomed.com/src/v1.1/js/off-canvas.js"></script>
<script src="https://ui.hellomed.com/src/v1.1/js/ios-safari.js"></script>


<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

<!-- google GTM in all os pages, except /admin-* pages -->
<?php 
if (!preg_match('/^\/admin-/', $_SERVER['REQUEST_URI'])) {
  require( ABSPATH . 'wp-blog-header.php' );
  // $cookieStatus = BorlabsCookie\Cookie\Config::getInstance()->get('google-tag-manager');

  // this is the borlabs attribute for the google-tag-manager ID, ids can be seen in the Cookie settings in the borlabs plugin
  $GTM_track_consent=BorlabsCookieHelper()->gaveConsent('google-tag-manager');
  $FACEBOOK_track_consent=BorlabsCookieHelper()->gaveConsent('facebook-pixel');
// var_dump($FACEBOOK_track_consent);

  // var_dump($GTM_track_consent);

  // Check the status of the GTM cookie consent , it's a boolean
  if ($GTM_track_consent === false || $GTM_track_consent === 0) {
    
      // echo "This content requires cookies to be set.";
    
      
  } else {
      ?>
<!-- show GTM code  -->
<script>
(function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
        "gtm.start": new Date().getTime(),
        event: "gtm.js"
    });
    var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != "dataLayer" ? "&l=" + l : "";
    j.async = true;
    j.src =
        "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
    f.parentNode.insertBefore(j, f);
})(window, document, "script", "dataLayer", "GTM-P4KJF2M");
</script>
<?php
      // echo "cookie consented to view this content.";
  }

   // Check the status of the Facebook cookie consent , it's a boolean
   if ($FACEBOOK_track_consent === false || $FACEBOOK_track_consent === 0) {
    
    // echo "This content requires cookies to be set.";
    
} else { 
    ?>
<!-- Meta Pixel Code -->
<script>
! function(f, b, e, v, n, t, s) {
    if (f.fbq) return;
    n = f.fbq = function() {
        n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
    };
    if (!f._fbq) f._fbq = n;
    n.push = n;
    n.loaded = !0;
    n.version = '2.0';
    n.queue = [];
    t = b.createElement(e);
    t.async = !0;
    t.src = v;
    s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s)
}(window, document, 'script',
    'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '245524883760394');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=245524883760394&ev=PageView&noscript=1" /></noscript>
<!-- End Meta Pixel Code -->
<?php
    // echo "cookie consented to view this content.";
}
}
?>