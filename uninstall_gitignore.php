<?php

/**
 * Git Workflow Manager
 *
 * @author vicentemferrer
 * @license MIT License
 * @copyright Copyright (c) vicentemferrer
 */

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
    require_once(dirname(__FILE__) . '/SSI.php');
elseif (!defined('SMF'))
    die('Hacking attempt...');

global $boarddir;

$gitignore_path = $boarddir . '/.gitignore';

if (file_exists($gitignore_path)) {
    $content = file_get_contents($gitignore_path);

    // Regex to match the block, accounting for possible varying whitespace
    $pattern = '/\n?# BEGIN GitWorkflowManager.*?# END GitWorkflowManager\n?/s';

    $new_content = preg_replace($pattern, "\n", $content);

    // Clean up if it just left a single newline at the beginning or extra at the end
    $new_content = trim($new_content) . "\n";

    // If the file is now empty (or just whitespace), maybe delete it or leave it empty.
    if (trim($new_content) === '') {
        unlink($gitignore_path);
    } else {
        file_put_contents($gitignore_path, $new_content);
    }
}
