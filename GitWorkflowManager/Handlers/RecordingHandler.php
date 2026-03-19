<?php

/**
 * Git Workflow Manager for SMF
 * @author vicentemferrer
 * @copyright 2026 vicentemferrer
 * @license MIT License
 */

namespace GitWorkflowManager\Handlers;

use GitWorkflowManager\MigrationHandlerInterface;

/**
 * Class RecordingHandler
 * Records migration instructions for later export (e.g., to package-info.xml or install scripts).
 * Does NOT execute any changes on the current environment.
 */
class RecordingHandler implements MigrationHandlerInterface
{
    protected $hooks = [];
    protected $db_actions = [];
    protected $settings_actions = [];

    // --- Hooks ---
    public function add_hook($hook, $function, $file, $object)
    {
        $this->hooks[] = [
            'type' => 'add',
            'hook' => $hook,
            'function' => $function,
            'file' => $file,
            'object' => $object
        ];
    }

    public function remove_hook($hook, $function, $file, $object)
    {
        $this->hooks[] = [
            'type' => 'remove',
            'hook' => $hook,
            'function' => $function,
            'file' => $file,
            'object' => $object
        ];
    }

    // --- Database ---
    public function create_table($name, $columns, $indexes, $parameters, $if_exists)
    {
        $this->db_actions[] = [
            'method' => 'db_create_table',
            'args' => [$name, $columns, $indexes, $parameters, $if_exists]
        ];
    }

    public function drop_table($name)
    {
        $this->db_actions[] = [
            'method' => 'db_drop_table',
            'args' => [$name]
        ];
    }

    public function add_column($table, $column_info)
    {
        $this->db_actions[] = [
            'method' => 'db_add_column',
            'args' => [$table, $column_info]
        ];
    }

    public function remove_column($table, $column_name)
    {
        $this->db_actions[] = [
            'method' => 'db_remove_column',
            'args' => [$table, $column_name]
        ];
    }

    public function change_column($table, $column_name, $column_info)
    {
        $this->db_actions[] = [
            'method' => 'db_change_column',
            'args' => [$table, $column_name, $column_info]
        ];
    }

    public function add_index($table, $index_info)
    {
        $this->db_actions[] = [
            'method' => 'db_add_index',
            'args' => [$table, $index_info]
        ];
    }

    public function remove_index($table, $index_name)
    {
        $this->db_actions[] = [
            'method' => 'db_remove_index',
            'args' => [$table, $index_name]
        ];
    }

    public function db_query($identifier, $query, $params)
    {
        $this->db_actions[] = [
            'method' => 'db_query',
            'args' => [$identifier, $query, $params]
        ];
    }

    public function insert_data($method, $table, $columns, $data, $keys)
    {
        $this->db_actions[] = [
            'method' => 'db_insert',
            'args' => [$method, $table, $columns, $data, $keys]
        ];
    }

    // --- Settings ---
    public function update_settings($settings, $update)
    {
        $this->settings_actions[] = [
            'args' => [$settings, $update]
        ];
    }

    // --- Getters for the recorded data ---

    public function get_hooks()
    {
        return $this->hooks;
    }

    public function get_db_actions()
    {
        return $this->db_actions;
    }

    public function get_settings_actions()
    {
        return $this->settings_actions;
    }
}
