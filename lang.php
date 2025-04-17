<?php
// Get the 'HTTP_ACCEPT_LANGUAGE' header from the user's browser
 $preferred_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

// Extract the primary language code (e.g., "en", "jp")
echo $primary_language = substr($preferred_language, 0, 2);

exit;

// Check the extracted language code and redirect accordingly
if ($primary_language === 'jp') {
    // Redirect to the Japanese version of the site
    header("Location: /jp/");
    exit();
} else {
    // Default to the English version of the site
    header("Location: /en/");
    exit();
}
?>