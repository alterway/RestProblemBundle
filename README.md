# RestProblemBundle

Bundle to manage Problems in API with Symfony2.

This bundle follows the [Problem Details for HTTP APIs](http://tools.ietf.org/html/draft-nottingham-http-problem-03) 
recommandation.

## Installation

Edit your `composer.json`:

```json
"require": {
    "alterway/rest-problem-bundle" : "master"
}
```

And run Composer:

    php composer.phar update alterway/rest-problem-bundle

Enable your bundle in your `AppKernel.php`:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Alterway\Bundle\RestProblemBundle\AwRestProblemBundle(),
    );
}
```

## Usage


```php
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Alterway\Bundle\RestProblemBundle\Problem;

public function demoAction(Request $request)
{

    $form = // (...)

    $form->bind($request);
    if (!$form->isValid()) {
        return new Problem\InvalidQueryForm($form);
    }
}
```

Or

```php
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Alterway\Bundle\RestProblemBundle\Problem;

public function demoAction(Request $request)
{

    $form = // (...)

    $form->bind($request);
    if (!$form->isValid()) {
        $problem = new Problem\InvalidQueryForm($form);
        return new ProblemResponse($problem, 403);
    }
}
```

## Problem's types

You need to create your own problem types. There are by default the following problems:

+ Problem\InvalidQuery
+ Problem\InvalidQueryForm
+ ...

## Todo

Add controllers and route to provide `problemType`

## Contribute

Install dev dependencies:

    php composer.phar update --dev

Run Behat:

    ./vendor/bin/behat @AwProblemRestBundle

## Copyright

Copyright (c) 2013 Jean-François Lépine (Halleck45). See LICENSE for details.

##  Contributors

+ Jean-François Lépine (Problemleck45)

## Sponsors

+ [Alter Way](http://www.alterway.fr)
+ [La Ruche Qui Dit Oui!](http://www.laruchequiditoui.fr)
