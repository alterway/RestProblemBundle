<?php

namespace Alterway\Bundle\RestProblemBundle\Controller\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Problem extends Annotation implements ConfigurationInterface
{

    public function allowArray()
    {
        return false;
    }

    public function getAliasName()
    {
        return 'rest_problem';
    }

}
