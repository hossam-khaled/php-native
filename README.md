# php-native

## Helpers

The `includes/helpers/` directory contains utility functions to simplify common tasks in your PHP application:

- **db.php**: Database helper functions for CRUD operations.
  - `db_create($table, $data)`: Insert data into a table.
  - `db_update($table, $data, $id)`: Update a row by ID.
  - `db_delete($table, $id)`: Delete a row by ID.
  - `db_find($table, $id)`: Find a row by ID.
  - `db_search($table, $query_str)`: Search for a single row.
  - `db_get($table, $query_str)`: Get multiple rows.
  - `db_paginate($table, $query_str, $limit, $orderby)`: Paginate results.

- **helper.php**: General utility functions.
  - `config($key)`: Get config value by key.
  - `base_path($path)`: Get absolute path.
  - `is_localhost()`: Check if running on localhost.

- **mail.php**: Email sending helper.
  - `send_mail($mails, $subject, $message)`: Send an email.

- **request.php**: Request data helper.
  - `request($request)`: Get a value from the request.

- **routing.php**: Routing helpers.
  - `route_get($segment, $view)`: Register a GET route.
  - `route_post($segment, $view)`: Register a POST route.
  - `route_init()`: Initialize routing.
  - `redirect($path)`: Redirect to a path.
  - `url($path)`: Generate a URL.
  - `sagment()`: Get the current URI segment.

- **session.php**: Session management helpers.
  - `session($key, $value)`: Get/set a session value.
  - `session_has($key)`: Check if a session key exists.
  - `session_flash($key, $value)`: Flash a session value.
  - `session_forget($key)`: Remove a session key.
  - `session_delete_all()`: Destroy all sessions.

- **translation.php**: Language translation helpers.
  - `lang($key, $replace)`: Get a translation string.
  - `set_locale($lang)`: Set the current locale.

- **view.php**: View rendering helper.
  - `view($path, $data)`: Render a view file with data.