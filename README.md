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
        $problem = new Problem\InvalidQueryForm($form);
        return new ProblemResponse($problem, 403);
    }
}
```

## Usage with annotations

Remember to enable annotations :

```json
sensio_framework_extra:
router:  { annotations: true }
request: { converters: true }
view:    { annotations: true }
cache:   { annotations: true }
```

And to register the autoloader in your `app/autoload.php` file:

```php
Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass')); 
```

This will send an `application/api-problem+json` header:

```php
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Alterway\Bundle\RestProblemBundle\Controller\Annotations\Problem;

/**
* @Problem
*/
public function demoAction(Request $request)
{

    $form = // (...)

    $form->bind($request);
    if (!$form->isValid()) {
        return new Problem\InvalidQueryForm($form);
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

Copyright (c) 2013 La Ruche Qui Dit Oui!. See LICENSE for details.

##  Contributors

+ Lead: Jean-François Lépine (Halleck45)

## Sponsors

+ [Alter Way](http://www.alterway.fr)
+ [La Ruche Qui Dit Oui!](http://www.laruchequiditoui.fr)
