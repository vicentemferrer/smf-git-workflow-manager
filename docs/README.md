🇬🇧 Read in English | [🇪🇸 Leer en Español](README.es.md)

# Git Workflow Manager API Documentation

Welcome to the **Git Workflow Manager** documentation for SMF. This document provides a comprehensive list of all the helper methods available within the `AbstractMigration` class.

When you create a new migration in your `gwm_migrations` folder, your class must extend `GitWorkflowManager\AbstractMigration`. You will be able to use the `up()` and `down()` methods, inside of which you can safely call any of the helpers listed below.

---

## 🏗️ Core Methods

### `up()`

**Description:** This abstract method is mandatory. It contains the code that will be executed when the migration is "Applied" from the SMF Admin panel.

### `down()`

**Description:** This abstract method is mandatory. It contains the code that will be executed when the migration is "Reverted". It should perfectly undo everything that was done in `up()`.

### `description()`

**Description:** Optional method. Override this to return a string describing what your migration does.

---

## 🗄️ Database Helpers

These methods wrap SMF's internal database structure functions, making schema changes easy and trackable.

### `create_table($name, $columns, $indexes = [], $parameters = [], $if_exists = 'ignore')`

Creates a new database table.

- **`$name`**: (string) Table name (without the `{db_prefix}`).
- **`$columns`**: (array) Array of column definitions.
- **`$indexes`**: (array) Array of index definitions.
- **`$parameters`**: (array) Table creation parameters.
- **`$if_exists`**: (string) Behavior if the table already exists. Default: `'ignore'`.

### `drop_table($name)`

Drops an existing table.

- **`$name`**: (string) Table name to drop.

### `add_column($table, $column_info)`

Adds a new column to an existing table.

- **`$table`**: (string) Table name.
- **`$column_info`**: (array) Array defining the new column properties.

### `remove_column($table, $column_name)`

Removes a column from a table.

- **`$table`**: (string) Table name.
- **`$column_name`**: (string) Name of the column to remove.

### `change_column($table, $column_name, $column_info)`

Alters an existing column's definition.

- **`$table`**: (string) Table name.
- **`$column_name`**: (string) Name of the column to change.
- **`$column_info`**: (array) Array defining the new column properties.

### `add_index($table, $index_info)`

Adds an index to an existing table.

- **`$table`**: (string) Table name.
- **`$index_info`**: (array) Array defining the index properties.

### `remove_index($table, $index_name)`

Removes an index from an existing table.

- **`$table`**: (string) Table name.
- **`$index_name`**: (string) Name of the index to remove.

### `db_query($identifier, $query, $params = [])`

Executes a raw database query. Useful for data manipulation (CRUD) within your migrations.

- **`$identifier`**: (string) A unique identifier for the query, usually empty `''` for standard queries.
- **`$query`**: (string) The SQL query string.
- **`$params`**: (array) Parameters to bind to the query.

### `insert_data($method, $table, $columns, $data, $keys = [])`

Inserts data into a table.

- **`$method`**: (string) Insertion method (e.g., `'ignore'`, `'replace'`, `'insert'`).
- **`$table`**: (string) Table name.
- **`$columns`**: (array) Array defining the column types.
- **`$data`**: (array) Array of arrays containing the data rows to insert.
- **`$keys`**: (array) Array of primary keys (useful for `'replace'`).

---

## 🪝 Hook Helpers

SMF relies heavily on Integration Hooks. These helpers make registering and unregistering them a breeze.

### `add_hook($hook, $function, $file = '', $object = false)`

Registers a new integration hook.

- **`$hook`**: (string) The name of the SMF hook (e.g., `'integrate_pre_include'`).
- **`$function`**: (string) The name of your function or method to call.
- **`$file`**: (string) Optional file path to include before calling the function.
- **`$object`**: (bool) Whether the function is an object method call.

### `remove_hook($hook, $function, $file = '', $object = false)`

Unregisters an integration hook. _Always ensure this matches exactly what you provided in `add_hook()`._

- **`$hook`**: (string) The name of the SMF hook.
- **`$function`**: (string) The name of your function.
- **`$file`**: (string) The file path (must match `add_hook`).
- **`$object`**: (bool) The object flag (must match `add_hook`).

---

## ⚙️ Settings Helpers

Manage `$modSettings` directly from your migrations.

### `update_settings($settings, $update = true)`

Updates or inserts new global forum settings.

- **`$settings`**: (array) Key-value array of settings to update (e.g., `['my_mod_enabled' => '1']`).
- **`$update`**: (bool) If `true`, updates existing keys. Default: `true`.
