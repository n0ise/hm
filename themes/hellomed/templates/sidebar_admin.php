<div class="sidebar">
    <ul>
        <!-- check the page slug and make the correspondent <li> with class active -->
        <li class="<?php if (is_page('admin_dashboard')) { echo 'active'; } ?>"><a href="/admin_dashboard">Dashboard</a></li>
        <li class="<?php if (is_page('Nutzerverwaltung')) { echo 'active'; } ?>"><a href="/Nutzerverwaltung">Nutzerverwaltung</a></li>
        <li class="<?php if (is_page('Rezeptverwaltung')) { echo 'active'; } ?>"><a href="/Rezeptverwaltung">Rezeptverwaltung</a></li>
    </ul>
    <button type="button" class="btn btn-primary mb-3">Neuen Nutzer anlegen</button>
    <button type="button" class="btn btn-primary">Folgerezept erfassen</button>
  </div>