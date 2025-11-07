<?php
// Simple 404 page content displayed when a route is not found.
?>

<main class="not-found" style="padding:60px 20px; text-align:center;">
  <h1 style="font-size:72px; margin:0;">404</h1>
  <p style="font-size:20px; margin:8px 0 20px;">Page Not Found</p>
  <p style="color:#666; margin-bottom:20px;">The requested URL <strong><?php echo htmlspecialchars($path ?? $_SERVER['REQUEST_URI']); ?></strong> was not found on this server.</p>
  <a href="/" class="btn" style="display:inline-block;padding:10px 18px;background:#4a4a4a;color:#fff;border-radius:4px;text-decoration:none;">Return to home</a>
</main>
