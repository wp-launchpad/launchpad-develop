# Beginner documentation

Even if the notions used in Launchpad can seem complex, its goal is to make these practices accessible to the most.

In this documentation, you will learn all the basis you need to know to start working with this framework.

## Starting with Launchpad

The first idea behind Launchpad is to offer an effective environment to develop a WordPress plugin in a couple of minutes.

### Generating the project

For that we will generate the project using [Composer](https://getcomposer.org/doc/00-intro.md) using the following command `composer create-project wp-launchpad/launchpad my-plugin` where `my-plugin` is the folder where you want to create the project.

Once this is done, you should end up with a content matching the one inside [this repository](https://github.com/wp-launchpad/launchpad-examples/tree/main/base).

### Initializing the project

Once the project is generated, the next step will be to transform a standard base into a base unique to your plugin.

This two-step start is specific to Launchpad due to constraints enforced by WordPress.

In a WordPress installation, multiple plugins can have to live together, and this is why some rules have been defined to prevent clashes between them.

It is to generate all these values that will be unique to your plugin that we need to run this second command `./bin/generate initialize`.

Once the command is executed, it will ask for the name of the plugin.

This name will be the name that will be displayed to the user on the interface and other values will be generated from that.

## Adding your logic

Now that the project is initialized, it is now possible to write our business logic.

For that, we will have to deal with two entities:
- Subscribers
- Providers

### Subscribers

Subscribers are a common pattern well known in the software engineering world that makes an excellent substitution to the `add_action` and the `add_filter` functions.

They are the central place of Launchpad for developers and where you will spend the most of your time while using the framework.

Any class can be a subscriber as long as they contain a callback method, and they are registered on a provider.

To register a method as a callback it is possible to use the annotation `@hook` inside the docblock from that method:

```php
/**
* @hook init
 */
public function my_callback() {
    
}
```

**Note:** A callback method should always have the `public` visibility otherwise WordPress won't be able to access it.

The `@hook` annotation accept the following parameters.

#### An hook name (mandatory)
The name from the hook the callback will be attached to.

It is the equivalent to the first parameter from the function `add_action` or `add_filter`.

For example:
```php
function add_sitemap_rule() {
    add_rewrite_rule('sitemap\.xml', 'index.php?sitemap=index', 'top');
}

add_action('init', 'add_sitemap_rule');
```

Is equivalent to:
```php
/**
* @hook init
 */
public function add_sitemap_rule() {
    add_rewrite_rule('sitemap\.xml', 'index.php?sitemap=index', 'top');
}
```

And:
```php
function change_sitemap_url($url, $path) {
    if( '/wp-sitemap.xml' !== $path) {
        return $url;
    }
    
    return str_replace($path, 'sitemap.xml', $url);
}

add_filter('home_url', 'change_sitemap_url', 10, 2);
```

Is equivalent to:

```php
/**
* @hook home_url
 */
public function change_sitemap_url($url, $path) {
    if( '/wp-sitemap.xml' !== $path) {
       return $url;
    }
    
    return str_replace($path, 'sitemap.xml', $url);
}
```

#### A priority (optional)

The priority is a parameter offered by WordPress to order callbacks on the same hook.

This helps to make sure certain callbacks are executed before others when the hook is fired.

With the `@hook` annotation it is possible to either:
- not indicate the priority from a hook which is going to make it have priority 10 like in regular WordPress.
- indicate the priority right after the name of the hook.

Due to that, both these syntaxes are valid:

```php
/**
* @hook init 2
 */
public function add_sitemap_rule() {
    add_rewrite_rule('sitemap\.xml', 'index.php?sitemap=index', 'top');
}

/**
* @hook home_url
 */
public function change_sitemap_url($url, $path) {
    if( '/wp-sitemap.xml' !== $path) {
       return $url;
    }
    
    return str_replace($path, 'sitemap.xml', $url);
}
```

#### Creating a subscriber

To create a subscriber, we will first have to create a regular class inside the [`inc` folder](https://github.com/wp-launchpad/launchpad-examples/tree/main/base/inc) from the project:

```php
class MyClass {

}
```

Once this is done, we will create one or multiple callback methods:
```php
class MyClass {
    /**
    * @hook init 2
     */
    public function add_sitemap_rule() {
        add_rewrite_rule('sitemap\.xml', 'index.php?sitemap=index', 'top');
    }
    
    /**
    * @hook home_url
     */
    public function change_sitemap_url($url, $path) {
        if( '/wp-sitemap.xml' !== $path) {
           return $url;
        }
        
        return str_replace($path, 'sitemap.xml', $url);
    }
}
```

**Note:** It is also possible to add methods on the subscriber which are not callback from an event.

```php
class MyClass {
    /**
    * @hook init 2
     */
    public function add_sitemap_rule() {
        add_rewrite_rule('sitemap\.xml', 'index.php?sitemap=index', 'top');
    }
    
    /**
    * @hook home_url
     */
    public function change_sitemap_url($url, $path) {
        if( '/wp-sitemap.xml' !== $path) {
           return $url;
        }
        
        return str_replace($path, 'sitemap.xml', $url);
    }
    
    public function my_method() {
    
    }
}
```

To know more about subscribers, it is possible to check [this documentation](./development-workflow/subscribers.md).

### Providers

Providers are for you a way to declare subscribers to the framework.

That way the framework will know their existence and load them when the plugin is initialized.

#### Register a subscriber

To declare a new subscriber on a provider, you will have to register it inside the method `define` from that provider.

For that it is possible to use another method from the provider, `register_common_subscriber`, which takes as argument the class name from the subscriber:

```php
public function define() {
    $this->register_common_subscriber(MyClass::class);
}
```

**Note:** All Launchpad projects are generated with a default provider located in [`inc/ServiceProvider.php` file](https://github.com/wp-launchpad/launchpad-examples/blob/main/base/inc/ServiceProvider.php).

### Build the plugin

Unlike most WordPress boilerplates that offer you a production ready code, Launchpad provides you a development environment which is not supposed to be pushed directly in production.

That is why it is important to rely on the command `build` to generate a build which will be releasable and never transfer the whole project.

To use the build command, you need to pass by the generator inside the project with the following command `bin/generator build`.

This should generate a `build` folder inside the project containing two things:
- A zip from the optimized plugin.
- A folder from the optimized plugin.

Depending on your needs, you can freely use one of them to deploy a new version from the plugin in production or on your client website.



