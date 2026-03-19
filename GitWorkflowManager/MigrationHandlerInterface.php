<?php

/**
 * Git Workflow Manager for SMF
 * @author vicentemferrer
 * @copyright 2026 vicentemferrer
 * @license MIT License
 */

namespace GitWorkflowManager;

/**
 * Interface MigrationHandlerInterface
 * Defines the contract for migration handlers (Direct Execution vs Recording).
 */
interface MigrationHandlerInterface
{
    // Hooks
    public function add_hook($hook, $function, $file, $object);
    public function remove_hook($hook, $function, $file, $object);

    // Database DDL
    public function create_table($name, $columns, $indexes, $parameters, $if_exists);
    public function drop_table($name);
    public function add_column($table, $column_info);
    public function remove_column($table, $column_name);
    public function change_column($table, $column_name, $column_info);
    public function add_index($table, $index_info);
    public function remove_index($table, $index_name);

    // Database DML
    public function db_query($identifier, $query, $params);
    public function insert_data($method, $table, $columns, $data, $keys);

    // Settings
    public function update_settings($settings, $update);
}
