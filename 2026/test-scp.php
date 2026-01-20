<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/security-headers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSP Test - <?php echo SITE_NAME; ?></title>
</head>
<body>
    <h1>CSP Security Test</h1>
    
    <h2>Current Nonce:  <?php echo htmlspecialchars($csp_nonce); ?></h2>
    
    <h3>This script should work (has nonce):</h3>
    <script nonce="<?php echo $csp_nonce; ?>">
        console.log("✅ Nonce script loaded successfully!");
        document.write("<p style='color: green;'>✅ Script with nonce executed</p>");
    </script>
    
    <h3>This script should be BLOCKED (no nonce):</h3>
    <script>
        console.log("❌ This should be blocked by CSP!");
        document.write("<p style='color: red;'>❌ Unauthorized script executed (CSP FAILED! )</p>");
    </script>
    
    <h3>Check browser console for CSP violations</h3>
    <p>Open Developer Tools (F12) → Console tab</p>
    <p>You should see CSP violation errors for blocked scripts</p>
    
    <hr>
    <a href="<?php echo $baseurl; ?>">Back to Home</a>
</body>
</html>