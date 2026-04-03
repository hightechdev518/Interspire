<?php
/**
 * One-off diagnostic: open in the browser the same way you open the installer
 * (e.g. http://127.0.0.1:8080/install/check_env.php). Delete this file after setup.
 */
header('Content-Type: text/plain; charset=utf-8');
echo "PHP " . PHP_VERSION . " (" . PHP_SAPI . ")\n";
echo "extension_loaded('gd'): " . (extension_loaded('gd') ? 'yes' : 'NO — enable extension=gd in php.ini, then restart Apache or the PHP built-in server') . "\n";
echo "Loaded php.ini: " . (php_ini_loaded_file() ?: '(none)') . "\n";
echo "extension_dir: " . ini_get('extension_dir') . "\n";
