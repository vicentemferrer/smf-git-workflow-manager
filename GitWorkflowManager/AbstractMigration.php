<?php

/**
 * Git Workflow Manager for SMF
 * @author vicentemferrer
 * @copyright 2026 vicentemferrer
 * @license MIT License
 */

namespace GitWorkflowManager;

/**
 * Class AbstractMigration
 * Base class for all user migrations. Wraps SMF global functions into cleaner methods.
 * Delegates execution to an injected Handler.
 */
abstract class AbstractMigration
{
    /**
     * @var MigrationHandlerInterface
     */
    protected $handler;

    /**
     * Sets the handler (Direct or Recording).
     *
     * @param MigrationHandlerInterface $handler
     */
    public function setHandler(MigrationHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Applies the changes.
     */
    abstract public function up();

    /**
     * Reverts the changes.
     */
    abstract public function down();

    /**
     * Optional description.
     */
    public function description()
    {
        return '';
    }

    // -------------------------------------------------------------------------
    // DATABASE HELPERS
    // -------------------------------------------------------------------------

    protected function create_table($name, $columns, $indexes = [], $parameters = [], $if_exists = 'ignore')
    {
        $this->handler->create_table($name, $columns, $indexes, $parameters, $if_exists);
    }

    protected function drop_table($name)
    {
        $this->handler->drop_table($name);
    }

    protected function add_column($table, $column_info)
    {
        $this->handler->add_column($table, $column_info);
    }

    protected function remove_column($table, $column_name)
    {
        $this->handler->remove_column($table, $column_name);
    }

    protected function change_column($table, $column_name, $column_info)
    {
        $this->handler->change_column($table, $column_name, $column_info);
    }

    protected function add_index($table, $index_info)
    {
        $this->handler->add_index($table, $index_info);
    }

    protected function remove_index($table, $index_name)
    {
        $this->handler->remove_index($table, $index_name);
    }

    protected function db_query($identifier, $query, $params = [])
    {
        return $this->handler->db_query($identifier, $query, $params);
    }

    protected function insert_data($method, $table, $columns, $data, $keys = [])
    {
        $this->handler->insert_data($method, $table, $columns, $data, $keys);
    }

    // -------------------------------------------------------------------------
    // HOOK HELPERS
    // -------------------------------------------------------------------------

    protected function add_hook($hook, $function, $file = '', $object = false)
    {
        $this->handler->add_hook($hook, $function, $file, $object);
    }

    protected function remove_hook($hook, $function, $file = '', $object = false)
    {
        $this->handler->remove_hook($hook, $function, $file, $object);
    }

    // -------------------------------------------------------------------------
    // SETTINGS HELPERS
    // -------------------------------------------------------------------------

    protected function update_settings($settings, $update = true)
    {
        $this->handler->update_settings($settings, $update);
    }
}
