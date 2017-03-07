<?php declare(strict_types = 1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HealthController
{
    /**
     * @Route("/health", name="health")
     */
    public function indexAction()
    {
        return new Response('');
    }
}
