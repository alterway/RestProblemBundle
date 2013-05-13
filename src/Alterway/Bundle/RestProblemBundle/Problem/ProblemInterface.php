<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

/**
 * Problem
 * 
 * @see http://tools.ietf.org/html/draft-nottingham-http-problem-03
 */
interface ProblemInterface
{

    public function getProblemType();

    public function setProblemType($problemType);

    public function getTitle();

    public function setTitle($title);

    public function getDetail();

    public function setDetail($detail);

    public function getHttpStatus();

    public function setHttpStatus($httpStatus);
}
