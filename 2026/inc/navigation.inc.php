<?php
// Set current navigation item if not set
if (!isset($current_navi_item)) {
    $current_navi_item = '';
}
?>
<nav class="main-navigation">
    <div class="nav-container">
        <div class="logo">
            <a href="<?php echo $baseurl; ?>">
                <img src="<?php echo $baseurl; ?>img/ITDuck.png" alt="<?php echo SITE_NAME; ?> Logo">
                <span><?php echo SITE_NAME; ?></span>
            </a>
        </div>
        
        <button class="mobile-menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <ul class="nav-menu">
            <li>
                <a href="<?php echo $baseurl; ?>" 
                   class="<?php echo ($current_navi_item == 'home') ? 'active' : ''; ?>">
                    Home
                </a>
            </li>
            <li>
                <a href="<?php echo $baseurl; ?>about" 
                   class="<?php echo ($current_navi_item == 'about') ? 'active' : ''; ?>">
                    About
                </a>
            </li>
            <li>
                <a href="<?php echo $baseurl; ?>services" 
                   class="<?php echo ($current_navi_item == 'services') ? 'active' : ''; ?>">
                    Services
                </a>
            </li>
            <li>
                <a href="<?php echo $baseurl; ?>contact" 
                   class="<?php echo ($current_navi_item == 'contact') ? 'active' : ''; ?>">
                    Contact
                </a>
            </li>
        </ul>
    </div>
</nav>