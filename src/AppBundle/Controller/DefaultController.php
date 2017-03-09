<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/** @Route(service="app.default_controller", path="/") */
class DefaultController
{
    private $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->templating->renderResponse('default/index.html.twig');
    }
}
