<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

/*
 * (c) 2013 La Ruche Qui Dit Oui!
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
