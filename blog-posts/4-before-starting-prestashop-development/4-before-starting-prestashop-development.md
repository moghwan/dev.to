---
published: true
title: "Things you should know before starting Prestashop development"
cover_image:
description:
tags: Prestashop, php, modules, beginner
series:
canonical_url:
---

> Note: I'm only talking about PS1.7 version, not 1.6 or ealier.

So basically i'm writing this post for prestashop beginners developers to explain some **ways of doing things**' basics so they would't be in the 'Aha!' situations multiple times, like I did.

Developping in prestashop is just like programmig in any php framework, it relies heavely on the OOP programming, and MVC architecture with their their folders `classes`, `controllers` and `themes/<your-theme-name>`. you can learn more about folders architecture from [here](https://devdocs.prestashop.com/1.7/development/architecture/file-structure/) the documentation is very clear once you understand *Hooks* (because they are the most confusing, and, easy part).

These are the main lines you should know about:

# overrides 

Why overrides? why not changing directly in classes? simply because prestashop/modules updates will completely overwrite your changes.

The classes that you are able to override are all classes insides `classes`, `constrollers` and `modules` folders, and place them under `overrides` while respecting their original arborescence.

To take effect of your changes you should either clear your cache folder, or just deleting the `var/cache/<dev || prod>/class_index.php` file which is a simple mapping class of the different classes with their overrides.

For example:
```php
// code/ProductController.php

<?php
# controllers/front/ProductController.php

use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
...


class ProductControllerCore extends ProductPresentingFrontControllerCore
{

  public function anyFunction()
  {
    // function shouldn't be private or it won't work

    return 'parent value';
  }

}
```
Let's override the class and redifine any public/protected method:
```php
// code/ProductController-override.php

<?php

# overrides/controllers/front/ProductController.php

class ProductController extends ProductControllerCore
{

  public function anyFunction()
  {
    // use parent::anyFunction() to get parent function value

    return 'new value';
  }
}
```

# The `Tools` class

This class is as, its name saying, a class of tools and utilities functions. you'll find a set of useful static methods you'll use often. Before creating any utility function in your module make sure it's not present in the Tools class.  


# Hooks
Hooks, to be simple, help executing some code/change a template, on a specific event/position. 

There a two main types of hooks: display & action.

When using a hook in your module just do a quick check if it's compatible with all 1.7.x.x versions or it's a new one, just in case. Or if a hook is renamed you must register the hook for that specific version so you won't tell yourself later why it's not used.

The complete list of hooks is available [here](https://devdocs.prestashop.com/1.7/modules/concepts/hooks/#hooks)

# Deprecated functions
You'll notice a lot of them ducummented with `@deprecated` tag, some are even from prestashop 1.5 but technically they call the new defined ones.

Why? Backward compatibility. The other reason is, that people are always late to or never update their online store fearing to break it because, if you're non technical owner ad something goes wrong during an upgrade (or even and update sometimes) it'll cost some - if not only your time - money to fix it.


# PrestaShop & Github 
To quickly download a specific PS version directly head to [releases list](https://github.com/PrestaShop/PrestaShop/tags), no need to go to their site or google the desired version.

Faster? head to https://github.com/PrestaShop/PrestaShop/releases/tag/1.7.x.x and replace the `x` with your version.

Even faster with the direct link: https://github.com/PrestaShop/PrestaShop/releases/download/1.7.x.x/prestashop_1.7.x.x.zip

# Fixing update/upgrade issues
At first it seemed very complicated to me but in fact, it's simply tricky.

Besides replacing core folder such as classes, controller, src and the classic theme, updating the database is our main focus. Take a look at the folders `php` and `sql` inside the folder `[/install-dev/upgrade/](https://github.com/PrestaShop/PrestaShop/tree/develop/install-dev/upgrade)`, notice something? let me explain: 

- A prestashop **database** installation is just a serie of updates executing one after another. so, if a real upgrade is stuck at some point, open the corresponding php/sql file for the update you started earlier and just execute them this will surely fix the update issue.

# Some things you should know
- Any global parameter, rather it's proper to prestashop or to a module, can be stored and fetched or deleted with these methods:
```php
// code/configuration.php

Configuration::updateValue('YOUR_UNIQUE_PARAM_NAME', 'new value');

Configuration::get('YOUR_UNIQUE_PARAM_NAME');

Configuration::deleteByName('YOUR_UNIQUE_PARAM_NAME');
```
- Get any input value by name, sent in GET, POST or Ajax:
Tools::getValue('input_name') 
Context has many useful properties filled with data depending on, the current state, the context! here's some examples:
```php
// code/context.php
```
- Global variable are prefixed with `_PS_` and defined in `config/defines.inc.php`

- making a simple ajax call:

```php
// code/ajax/display.php

// returns the id of the current used language.
$this->context->language->id;

// assign variables from current controller to the view
$this->context->smarty->assign([
  'categories' => $categories,
]);

// the view
return $this->display(__FILE__, 'views/templates/admin/someadminhook.tpl');

// fetching the rendered content of a view,
$this->context->smarty->fetch('module:your_module_dir_name/views/templates/front/display.tpl')

// get current cart
$this->context->cart;
```

```js
// code/ajax/front.js

// preparing the ajax call inside a function
function getProductsByCategoryJs(categoryId) {
  $.ajax({
      url : AJAX_URL,
      type : 'POST',
      async: true,
      dataType : "json",
      data: {
          action: 'getProductsByCategoryPhp',
          categoryId: categoryId,
          ajax: 1
      },
      success : function (response) {
          console.log(response);
          $('#your-element').html(response.ajaxTpl);
      },
      error : function (error) {
          console.log(error);
      },
  });
}

```
```php
// code/ajax/ajax.php

# my_module/controllers/front/display.php

// making the request url for our contoller in initContent() function
$url = Context::getContext()->link->getModuleLink(
    'my_module', // module name
    'ajax', // contoller name, could be 'display'
    array( // we can define more parameters here
        // 'action' => 'DoSomeAction',
        // 'ajax' => 1,
    )
);

// making variable accessible in javascript
Media::addJsDef([
    'AJAX_URL' => $url,
]);
```

# Free modules in prestashop addons cost
- You can't upload your free module in prestashop addons store if you're not "Native module partnerships", it has to be paid.
- or, the funny thing, post it free on their forum: https://www.prestashop.com/forums/forum/144-free-modules-themes/

# That's it!

There are lots of things to talk about but I tried to put content from here and there for a better view for prestashop beginners (including me) and not getting confused because, it is, kinda.


If you have any recommendation, improvement, found a typo just let me know the comments or fork [this project](github.com/moghwan/dev.to) and make your edits, any contribution is welcome.
