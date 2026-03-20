[🇬🇧 Read in English](README.md) | 🇪🇸 Leer en Español

# Documentación de la API de Git Workflow Manager

Bienvenido a la documentación de **Git Workflow Manager** para SMF. Este documento proporciona una lista completa de todos los métodos auxiliares disponibles dentro de la clase `AbstractMigration`.

Cuando creas una nueva migración en tu carpeta `gwm_migrations`, tu clase debe extender `GitWorkflowManager\AbstractMigration`. Podrás utilizar los métodos `up()` y `down()`, dentro de los cuales puedes llamar de forma segura a cualquiera de los "helpers" (ayudantes) listados a continuación.

---

## 🏗️ Métodos Principales

### `up()`

**Descripción:** Este método abstracto es obligatorio. Contiene el código que se ejecutará cuando la migración sea "Aplicada" desde el panel de Administración de SMF.

### `down()`

**Descripción:** Este método abstracto es obligatorio. Contiene el código que se ejecutará cuando la migración sea "Revertida". Debería deshacer a la perfección todo lo que se hizo en `up()`.

### `description()`

**Descripción:** Método opcional. Sobrescríbelo para devolver un string (cadena de texto) que describa lo que hace tu migración.

---

## 🗄️ Ayudantes de Base de Datos

Estos métodos envuelven las funciones internas de estructura de base de datos de SMF, haciendo que los cambios de esquema sean fáciles y rastreables.

### `create_table($name, $columns, $indexes = [], $parameters = [], $if_exists = 'ignore')`

Crea una nueva tabla en la base de datos.

- **`$name`**: (string) Nombre de la tabla (sin el `{db_prefix}`).
- **`$columns`**: (array) Arreglo de definiciones de columnas.
- **`$indexes`**: (array) Arreglo de definiciones de índices.
- **`$parameters`**: (array) Parámetros de creación de la tabla.
- **`$if_exists`**: (string) Comportamiento si la tabla ya existe. Por defecto: `'ignore'`.

### `drop_table($name)`

Elimina una tabla existente.

- **`$name`**: (string) Nombre de la tabla a eliminar.

### `add_column($table, $column_info)`

Agrega una nueva columna a una tabla existente.

- **`$table`**: (string) Nombre de la tabla.
- **`$column_info`**: (array) Arreglo que define las propiedades de la nueva columna.

### `remove_column($table, $column_name)`

Elimina una columna de una tabla.

- **`$table`**: (string) Nombre de la tabla.
- **`$column_name`**: (string) Nombre de la columna a eliminar.

### `change_column($table, $column_name, $column_info)`

Modifica la definición de una columna existente.

- **`$table`**: (string) Nombre de la tabla.
- **`$column_name`**: (string) Nombre de la columna a cambiar.
- **`$column_info`**: (array) Arreglo que define las nuevas propiedades de la columna.

### `add_index($table, $index_info)`

Agrega un índice a una tabla existente.

- **`$table`**: (string) Nombre de la tabla.
- **`$index_info`**: (array) Arreglo que define las propiedades del índice.

### `remove_index($table, $index_name)`

Elimina un índice de una tabla existente.

- **`$table`**: (string) Nombre de la tabla.
- **`$index_name`**: (string) Nombre del índice a eliminar.

### `db_query($identifier, $query, $params = [])`

Ejecuta una consulta SQL pura. Útil para la manipulación de datos (CRUD) dentro de tus migraciones.

- **`$identifier`**: (string) Un identificador único para la consulta, normalmente vacío `''` para consultas estándar.
- **`$query`**: (string) La cadena de la consulta SQL.
- **`$params`**: (array) Parámetros a vincular (bind) a la consulta.

### `insert_data($method, $table, $columns, $data, $keys = [])`

Inserta datos en una tabla.

- **`$method`**: (string) Método de inserción (ej. `'ignore'`, `'replace'`, `'insert'`).
- **`$table`**: (string) Nombre de la tabla.
- **`$columns`**: (array) Arreglo definiendo los tipos de columna.
- **`$data`**: (array) Arreglo de arreglos que contienen las filas de datos a insertar.
- **`$keys`**: (array) Arreglo de claves primarias (útil para `'replace'`).

---

## 🪝 Ayudantes de Hooks

SMF depende en gran medida de los Hooks de Integración (Integration Hooks). Estos ayudantes hacen que registrarlos y anularlos sea pan comido.

### `add_hook($hook, $function, $file = '', $object = false)`

Registra un nuevo hook de integración.

- **`$hook`**: (string) El nombre del hook de SMF (ej. `'integrate_pre_include'`).
- **`$function`**: (string) El nombre de tu función o método a llamar.
- **`$file`**: (string) Ruta de archivo opcional a incluir antes de llamar a la función.
- **`$object`**: (bool) Define si la función es una llamada a método de objeto.

### `remove_hook($hook, $function, $file = '', $object = false)`

Desregistra un hook de integración. _Asegúrate siempre de que esto coincida exactamente con lo que proporcionaste en `add_hook()`._

- **`$hook`**: (string) El nombre del hook de SMF.
- **`$function`**: (string) El nombre de tu función.
- **`$file`**: (string) La ruta del archivo (debe coincidir con `add_hook`).
- **`$object`**: (bool) La bandera de objeto (debe coincidir con `add_hook`).

---

## ⚙️ Ayudantes de Configuración (Settings)

Gestiona `$modSettings` directamente desde tus migraciones.

### `update_settings($settings, $update = true)`

Actualiza o inserta nuevas configuraciones globales del foro.

- **`$settings`**: (array) Arreglo clave-valor de las configuraciones a actualizar (ej. `['my_mod_enabled' => '1']`).
- **`$update`**: (bool) Si es `true`, actualiza las claves existentes. Por defecto: `true`.
