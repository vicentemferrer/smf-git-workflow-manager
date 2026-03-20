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

$rules = <<<EOT

# BEGIN GitWorkflowManager
/Sources/GitWorkflowManager/
/Themes/default/GitWorkflowManager.template.php
/Themes/default/languages/GitWorkflowManager.english.php
/Themes/default/languages/GitWorkflowManager.spanish_latin.php
/Packages/GitWorkflowManager*.zip
!/gwm_migrations/
# END GitWorkflowManager
EOT;

$content = '';
if (file_exists($gitignore_path)) {
    $content = file_get_contents($gitignore_path);
}

// Add the rules if they don't exist yet
if (strpos($content, '# BEGIN GitWorkflowManager') === false) {
    // If the file does not end with a newline, add one
    if (!empty($content) && substr($content, -1) !== "\n") {
        $content .= "\n";
    }
    $content .= $rules . "\n";
    file_put_contents($gitignore_path, $content);
}
