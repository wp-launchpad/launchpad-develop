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

All front-end resources required for developing are present within `_dev` folder for one simple reason: it is easier to remove these assets when [building the production version](./build.md) from the plugin.

Assets inside that folder are organised around a Node.js project using [Bud.js](https://bud.js.org/) to build assets.

The reason behind this choice is due to the fact Bud.js is thought for WordPress and its constraints and due to that it is hard to find a better fit.

#### Installing dependencies

As any Node.js project working with Launchpad front-end assets project requires to install its dependencies.

To do so make sure you are inside the `_dev` folder from your Launchpad project and execute the following command: `npm i`.

Once this command executed you should have a new folder `node_modules` inside the Launchpad front-end assets project.

#### Building assets

In the same fashion as Launchpad project, development resources are not intended to be directly used on production and so it is mandatory to pass by a building step before being able to have the real assets that will be used in the plugin.

For that it is possible to run the command `npm run build` inside the `_dev` folder.

Once it finished executing a new folder `assets` should have appeared inside your Launchpad project.

#### Editing resources

### Enqueueing assets

While having the assets built is one thing, having WordPress loading these assets is another.

To achieve this we would have to take advantage of the WordPress enqueue API and the helper given inside Launchpad front-end module to make it easier.

#### Understanding the assets folder



#### Enqueueing using Launchpad

