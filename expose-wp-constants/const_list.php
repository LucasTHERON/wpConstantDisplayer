<?php

$const_list = [
    'WP_ADMIN',
    'WP_MEMORY_LIMIT',
    'WP_MAX_MEMORY_LIMIT',
    'DB_CHARSET',
    'DB_COLLATE',
    'DB_HOST',
    'DB_NAME',
    'DB_PASSWORD',
    'DB_USER',
    'WP_DEBUG',
    'WP_DEBUG_LOG',
    'WP_DEBUG_DISPLAY',
    'ABSPATH',
    'SAVEQUERIES',
    'ENFORCE_GZIP',
    'WP_HOME',
    'WP_SITEURL',
    'AUTOMATIC_UPDATER_DISABLED',
    'AUTOSAVE_INTERVAL',
    'SHORTINIT',
    'STYLESHEETPATH',
    'ADMIN_COOKIE_PATH',
    'ALLOW_UNFILTERED_UPLOADS',
    'AUTH_COOKIE',
    'AUTH_KEY',
    'AUTH_SALT',
    'COOKIEHASH',
    'COOKIE_DOMAIN',
    'CUSTOM_TAGS',
    'DISALLOW_FILE_EDIT',
    'DISALLOW_FILE_MODS',
    'DISALLOW_UNFILTERED_HTML',
    'FORCE_SSL_ADMIN',
    'FORCE_SSL_LOGIN',
    'LOGGED_IN_COOKIE',
    'LOGGED_IN_KEY',
    'LOGGED_IN_SALT',
    'NONCE_KEY',
    'NONCE_SALT',
    'PASS_COOKIE',
    'IMAGE_EDIT_OVERWRITE',
    'WP_AUTO_UPDATE_CORE',
    'WP_USE_THEMES',
    'WP_SANDBOX_SCRAPING',
    'WP_START_TIMESTAMP',
    'RECOVERY_MODE_EMAIL',
    'WP_CONTENT_URL',
    'WP_PLUGIN_DIR',
    'WP_PLUGIN_URL',
    'WPMU_PLUGIN_DIR',
    'WPMU_PLUGIN_URL',
];

sort($const_list);

// Add custom consts at the begging of the array
if($custom_consts){
    sort($custom_consts);
    $const_list = array_merge($custom_consts, $const_list);
}

define( 'WP_CONST_LIST', $const_list);

