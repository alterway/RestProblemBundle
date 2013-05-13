<?php 

$loader = require(__DIR__.'/../../../../../vendor/autoload.php');
$loader->add('Alterway\\Bundle\\RestProblemBundle', __DIR__.'/../../../src');
$loader->add('Alterway\\DemoBundle', __DIR__.'/../src');
//$loader->add('Alterway\\DemoBundle\\AlterwayDemoBundle', __DIR__.'/../src');