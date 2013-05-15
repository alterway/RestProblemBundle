<?php

namespace Alterway\Bundle\RestProblemBundle\Response;

use Alterway\Bundle\RestProblemBundle\Problem\ProblemInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/*
 * (c) 2013 La Ruche Qui Dit Oui!
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ProblemResponse extends JsonResponse
{

    public function __construct(ProblemInterface $problem, $status = null, $headers = array())
    {
        $datas = array(
            'problemType' => $problem->getProblemType()
            , 'title' => $problem->getTitle()
            , 'detail' => $problem->getDetail()
        );

        if (null === $status) {
            $status = $problem->getHttpStatus();
        }

        parent::__construct($datas, $status, $headers);
    }

}
