# Uninstall 

The uninstall logic is some logic executed when the plugin is executed.

The idea behind that logic is often to clean up any possible left over the plugin would have left as such as:
- custom tables.
- options.
- transients.
- CRON jobs.

By default, Launchpad doesn't ship with a way to execute logic on uninstall.

However, it is possible to install a module to have uninstall logic.

## Install the module

To install [the module `wp-launchpad/uninstaller-take-off`](https://github.com/wp-launchpad/uninstaller-take-off)
you need to run the following command:
`composer require wp-launchpad/uninstaller-take-off`.

Once the command finished being executed [a new file `uninstall.php`](https://github.com/wp-launchpad/launchpad-examples/blob/main/uninstall/uninstall.php) should have been added to your project.

## Creating an uninstall logic

To create an uninstallor, any class can be used as the only requirement is to [use the `@uninstall` annotation](https://github.com/wp-launchpad/launchpad-examples/blob/316e6927e24339550a81879fdaf189d73a9acf4b/activate/inc/MyActivator.php#L12) inside the docblock of at least one of the methods:

```php
class MyUninstallor {
    /**
    * @uninstall
    */
    public function delete_options() {
        
    }
}
```

