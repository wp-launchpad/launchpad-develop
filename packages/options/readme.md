## Options

This library offers OOP facades to work with options and transients in WordPress.

### Install

Just run the command `composer require wp-launchpad/options`

Note: It is easier to work with that library using the [Launchpad framework](https://github.com/wp-launchpad/launchpad).

### Options

Options are a way to save a simple and light value in WordPress.

To use options with that library you need first to instantiate the class and provide it a prefix:
```php
$options = new \LaunchpadOptions\Options('my_prefix');
```

Note: By convention your prefix should be your plugin or theme name.

Once this is done then you can directly access, update or delete options using the following API:

| Method   | Description             | Example                              |
|----------|-------------------------|--------------------------------------|
| `get`    | Fetch the option value  | `$options->get('my_option', false )` |
| `set`    | Update the option value | `$options->set('my_option', true )`  |
| `delete` | Delete the option value | `$options->delete('my_option' )`     |

### Site options
Site options are a way to save a simple and light value in WordPress just as regular options.
However, the main difference resides in the fact in case of a  multisite it will be present at the level of the website and not at the level from the network.

To use options with that library you need first to instantiate the class and provide it a prefix:
```php
$options = new \LaunchpadOptions\SiteOptions('my_prefix');
```

Note: By convention your prefix should be your plugin or theme name.

Once this is done then you can directly access, update or delete options using the following API:

| Method   | Description             | Example                              |
|----------|-------------------------|--------------------------------------|
| `get`    | Fetch the option value  | `$options->get('my_option', false )` |
| `set`    | Update the option value | `$options->set('my_option', true )`  |
| `delete` | Delete the option value | `$options->delete('my_option' )`     |

### Transients

Transients are a way to save simple and light value but at the difference of options they expire after a certain time.

To use transients with that library you need first to instantiate the class and provide it a prefix:
```php
$transients = new \LaunchpadOptions\Transients('my_prefix');
```

Note: By convention your prefix should be your plugin or theme name.

Once this is done then you can directly access, update or delete transients using the following API:

| Method   | Description                | Example                                          |
|----------|----------------------------|--------------------------------------------------|
| `get`    | Fetch the transient value  | `$transients->get('my_transient', false, HOUR )` |
| `set`    | Update the transient value | `$transients->set('my_transient', true )`        |
| `delete` | Delete the transient value | `$transients->delete('my_transient' )`           |


### Settings

Settings are a way to easily save configurations for a plugin or a theme.

The advantage compared to options is that it is possible to mass update them or export them in one time.

To use settings with that library you need first to instantiate the class and provide it a prefix:
```php
$settings = new \LaunchpadOptions\Settings(new \LaunchpadOptions\Options('my_prefix'), 'my_settings_prefix');
```

Note: By convention your prefix should be your plugin or theme name.

Once this is done then you can directly access, update or delete settings using the following API:

| Method   | Description                     | Example                                       |
|----------|---------------------------------|-----------------------------------------------|
| `get`    | Fetch the setting value         | `$settings->get('my_setting', false )`        |
| `set`    | Update the setting value        | `$settings->set('my_setting', true )`         |
| `delete` | Delete the setting value        | `$settings->delete('my_setting' )`            |
| `dumps`  | Dumps all settings values       | `$settings->dumps()`                          |
| `import` | Import multiple settings values | `$settings->imports(['my_setting' => false])` |

### Set

Sets are a way to easily interact with array data coming from an option.

To use set with that library you need first to instantiate the class and provide it a prefix:
```php
$set = new \LaunchpadOptions\Set([
    'key' => 'value'
], 'my_prefix');
```

Note: The prefix is actually important for filters within the class.

Once this is done then you can directly access, update or delete values within the set using the following API:

| Method       | Description                | Example                                     |
|--------------|----------------------------|---------------------------------------------|
| `get`        | Fetch the set value        | `$set->get('my_setting', false )`           |
| `set`        | Update the set value       | `$set->set('my_setting', true )`            |
| `delete`     | Delete the set value       | `$set->delete('my_setting' )`               |
| `get_values` | Dumps all set values       | `$set->get_values()`                        |
| `set_values` | Import multiple set values | `$set->set_values(['my_setting' => false])` |

Note: The key difference between settings and sets is that Settings handle the saving in the database themselves when Set won't.