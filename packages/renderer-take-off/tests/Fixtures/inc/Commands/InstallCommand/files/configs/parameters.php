
<?php

$plugin_name = 'Rocket launcher';

$plugin_launcher_path = dirname(__DIR__) . '/';

return [
    'plugin_name' => $plugin_name,
    'plugin_slug' => sanitize_key( $plugin_name ),
    'plugin_version' => '1.0.0',
    'plugin_launcher_file' => $plugin_launcher_path . '/' . basename($plugin_launcher_path) . '.php',
    'plugin_launcher_path' => $plugin_launcher_path,
    'plugin_inc_path' => realpath( $plugin_launcher_path . 'inc/' ) . '/',
    'prefix' => 'rocket_launcher',
    'template_path' => $plugin_launcher_path . 'templates/',
    'root_directory' =>  WP_CONTENT_DIR . '/cache/',
    'renderer_cache_enabled' => false,
    'renderer_caching_solution' => [],
];
