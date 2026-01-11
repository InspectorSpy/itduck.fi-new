<?php
// Check if this is the frontpage
$is_frontpage = isset($is_frontpage) ? $is_frontpage : false;
?>
<header class="site-header <?php echo $is_frontpage ? "frontpage-header" : ""; ?>">
    <div class="header-content">
        <?php if ($is_frontpage): ?>
            <h1 class="site-title">Welcome to <?php echo SITE_NAME; ?></h1>
            <p class="site-tagline">Building amazing things with PGP</p>
        <?php else: ?>
            <h1 class="page-title"><?php echo isset($header_title) ? $header_title : $page_title; ?></h1>
        <?php endif; ?>
    </div>
</header>