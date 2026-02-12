<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3><?php echo SITE_NAME; ?></h3>
            <p>Official website of <?php echo SITE_NAME; ?></p>
        </div>

        <div class="footer-section">
            <h3>Quick links</h3>
            <ul>
                <li><a href="<?php echo $baseurl; ?>">Home</a></li>
                <li><a href="<?php echo $baseurl; ?>about">About</a></li>
                <li><a href="<?php echo $baseurl; ?>contact">Contact</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Connect</h3>
            <p>Email: <?php echo CONTACT_EMAIL; ?></p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
    </div>
</footer>

<!-- scripts -->
<script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>