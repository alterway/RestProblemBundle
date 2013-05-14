<?php

namespace Alterway\Bundle\RestProblemBundle\Response;

use Alterway\Bundle\RestProblemBundle\Problem\ProblemInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

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
