# Front-end

Launchpad does not provide any front-end feature directly into its core.

However, it is possible to use some modules to help you at that point:
- A renderer module.
- A front-end module.

Depending on your needs one or the other, will suit your project better.

## Renderer module 

The renderer is a way to separate easier logic from the views inside your plugin.

This module is thought as a small library rather than a bulletproof approach.

### Install

To install it, it is possible to use the following command `composer require wp-launchpad/renderer-take-off --dev` inside the folder from the Launchpad project.

Once it is installed a new provider should be installed inside [`inc/providers.php`](https://github.com/wp-launchpad/launchpad-examples/blob/f95ed8d0fb15641a16e98d52a796379d5e507afd/renderer/configs/providers.php#L7) and a new folder should be present [`templates`](https://github.com/wp-launchpad/launchpad-examples/tree/main/renderer/templates).

### Create a new template

To create a new template a new template, we first need to call it and pass it some data.

For example, to call the template `my-template` with a parameter `title` and the value `My title` :

```php
    do_action("my_plugin_prefix_", 'my-template' ,[
    'parameters' => [
        'title' => 'My title'
    ]
]);
```

Once this is done, we need to create inside the folder [`templates`](https://github.com/wp-launchpad/launchpad-examples/tree/main/renderer/templates) the template file matching the template we called, [`templates/my-template.php`](https://github.com/wp-launchpad/launchpad-examples/blob/main/renderer/templates/my-template.php).

Finally, once this is done, it is possible to use parameters we passed to the template inside it:

```php
<div>
    <h2><?php echo $title ?></h2>
</div>
```

If you want to check the whole code at [the example repository](https://github.com/wp-launchpad/launchpad-examples/tree/main/renderer).

## Front-end module

The front-end module is thought more for the more complex front-end using some modern libraries and frameworks to handle it.

### Install 

To install it, it is possible to use the following command `composer require wp-launchpad/front-take-off --dev` inside the folder from the Launchpad project.

Unlike most modules, this module requires you to take an action once installed.

### Front-end technologies

Launchpad front-end modules propose you to pick one of the following technologies for your front-end:
- `Javascript vanilla`
- [`React.js`](https://react.dev/)
- [`Vue.js`](https://vuejs.org/)

### Install the correct front-end

To install the front-end library you want it is possible using the command `bin/generator front:install` with a parameter matching the version you want:
- `bin/generator front:install vanilla`: Javascript vanilla
- `bin/generator front:install react`: React.js
- `bin/generator front:install vue`: Vue.js

Once this is done then the command `bin/generator front:install` should have disappeared and a new folder [`_dev`](https://github.com/wp-launchpad/launchpad-examples/tree/main/front-end/_dev) should be present on the project.

### Working with assets

### Enqueuing assets