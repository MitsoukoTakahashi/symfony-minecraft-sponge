<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/** @Route(service="app.default_controller", path="/") */
class DefaultController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

    }
}
