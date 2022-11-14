<div class="sidebar">
    <ul>
        <!-- check the page slug and make the correspondent <li> with class active -->
        <li class="<?php if (is_page('Medikationsplan')) { echo 'active'; } ?>"><a href="/medikationsplan">Medikationsplan</a></li>
        <li class="<?php if (is_page('rezepte')) { echo 'active'; } ?>"><a href="/rezepte">Rezepte</a></li>
        <li class="<?php if (is_page('faq')) { echo 'active'; } ?>"><a href="/faq">FAQ &amp; Hilfe</a></li>
        <li class="<?php if (is_page('profile')) { echo 'active'; } ?>"><a href="/profile">Einstellungen</a></li>
    </ul>
  </div>