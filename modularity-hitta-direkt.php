<?php

declare(strict_types=1);

/**
 * Plugin Name:       Modularity Hitta direkt
 * Description:       A Modularity module for linked quick-access icon circles.
 * Version:           0.1.0
 * Author:            Consid Webbteamet
 * Text Domain:       modularity-hitta-direkt
 * Domain Path:       /languages
 */

namespace ModularityHittaDirekt;

if (!defined('WPINC')) {
    die;
}

define('MODULARITYHITTADIREKT_PATH', plugin_dir_path(__FILE__));
define('MODULARITYHITTADIREKT_URL', plugins_url('', __FILE__));
define('MODULARITYHITTADIREKT_MODULE_PATH', MODULARITYHITTADIREKT_PATH . 'source/php/Module/');
define('MODULARITYHITTADIREKT_MODULE_VIEW_PATH', MODULARITYHITTADIREKT_PATH . 'source/php/Module/views');

add_action('init', static function (): void {
    load_plugin_textdomain('modularity-hitta-direkt', false, plugin_basename(dirname(__FILE__)) . '/languages');
});

require_once MODULARITYHITTADIREKT_PATH . 'Public.php';

$autoload = MODULARITYHITTADIREKT_PATH . 'vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
} else {
    spl_autoload_register(static function (string $class): void {
        $prefix = __NAMESPACE__ . '\\';
        if (strpos($class, $prefix) !== 0) {
            return;
        }

        $relativeClass = substr($class, strlen($prefix));
        $relativePath = str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
        $file = MODULARITYHITTADIREKT_PATH . 'source/php/' . $relativePath;

        if (file_exists($file)) {
            require_once $file;
        }
    });
}

add_action('acf/init', static function (): void {
    if (class_exists('\\AcfExportManager\\AcfExportManager')) {
        $acfExportManager = new \AcfExportManager\AcfExportManager();
        $acfExportManager->setTextdomain('modularity-hitta-direkt');
        $acfExportManager->setExportFolder(MODULARITYHITTADIREKT_PATH . 'source/php/AcfFields/');
        $acfExportManager->autoExport([
            'hitta-direkt-settings' => 'group_modularity_hitta_direkt_settings',
        ]);
        $acfExportManager->import();

        return;
    }

    $acfFields = MODULARITYHITTADIREKT_PATH . 'source/php/AcfFields/php/hitta-direkt-settings.php';
    if (file_exists($acfFields)) {
        require_once $acfFields;
    }
});

add_action('plugins_loaded', static function (): void {
    if (!class_exists(App::class)) {
        return;
    }

    new App();
});
