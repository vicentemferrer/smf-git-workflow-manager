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
 * Class DirectHandler
 * Executes migration instructions immediately using SMF globals.
 * Used for local development.
 */
class DirectHandler implements MigrationHandlerInterface
{
    public function add_hook($hook, $function, $file, $object)
    {
        add_integration_function($hook, $function, true, $file, $object);
    }

    public function remove_hook($hook, $function, $file, $object)
    {
        remove_integration_function($hook, $function, true, $file, $object);
    }

    public function create_table($name, $columns, $indexes, $parameters, $if_exists)
    {
        global $smcFunc;
        db_extend('packages');
        $smcFunc['db_create_table']($name, $columns, $indexes, $parameters, $if_exists);
    }

    public function drop_table($name)
    {
        global $smcFunc;
        db_extend('packages');
        $smcFunc['db_drop_table']($name);
    }

    public function add_column($table, $column_info)
    {
        global $smcFunc;
        db_extend('packages');
        $smcFunc['db_add_column']($table, $column_info);
    }

    public function remove_column($table, $column_name)
    {
        global $smcFunc;
        db_extend('packages');
        $smcFunc['db_remove_column']($table, $column_name);
    }

    public function change_column($table, $column_name, $column_info)
    {
        global $smcFunc;
        db_extend('packages');
        $smcFunc['db_change_column']($table, $column_name, $column_info);
    }

    public function add_index($table, $index_info)
    {
        global $smcFunc;
        db_extend('packages');
        $smcFunc['db_add_index']($table, $index_info);
    }

    public function remove_index($table, $index_name)
    {
        global $smcFunc;
        db_extend('packages');
        $smcFunc['db_remove_index']($table, $index_name);
    }

    public function db_query($identifier, $query, $params)
    {
        global $smcFunc;
        return $smcFunc['db_query']($identifier, $query, $params);
    }

    public function insert_data($method, $table, $columns, $data, $keys)
    {
        global $smcFunc;
        $smcFunc['db_insert']($method, $table, $columns, $data, $keys);
    }

    public function update_settings($settings, $update)
    {
        updateSettings($settings, $update);
    }
}
