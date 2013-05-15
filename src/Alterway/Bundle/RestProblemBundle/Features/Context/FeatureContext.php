<?php

namespace Alterway\Bundle\RestProblemBundle\Features\Context;

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Context\Step\Given;
use Behat\Behat\Context\Step\When;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;

//
// Require 3rd-party libraries here:
//
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext implements KernelAwareInterface
{

    private $response;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->useContext('mink', new MinkContext());
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @When /^I send a ([^"]*) request to "([^"]*)" with:$/
     */
    public function iSendARequestToWith($type, $uri, TableNode $post)
    {

        $fields = array();
        foreach ($post->getRowsHash() as $key => $val) {
            $fields[$key] = $val;
        }

        $driver = $this->getSubContext('mink')->getSession()->getDriver();
        $client = $driver->getClient();
        $this->response = $client->request($type, $uri, $fields);
    }

    /**
     * @When /^I send a ([^"]*) request to "([^"]*)"$/
     */
    public function iSendAGetRequestTo($type, $uri)
    {
        return array(
            new When(sprintf('I send a %s request to "%s" with:', $type, $uri), new TableNode())
        );

    }

}
