<?php

namespace Alterway\Bundle\RestProblemBundle\Controller\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;

/*
 * (c) 2013 La Ruche Qui Dit Oui!
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @Annotation
 * @Target("METHOD")
 * 
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
