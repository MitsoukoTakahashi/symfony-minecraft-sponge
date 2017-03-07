<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $minecraft = $this->get('app.minecraft.client');
        return $this->render('default/index.html.twig', [
            'infos' => $minecraft->info(),
            'messages' => $minecraft->chat()->getMessages(),
            'entities' => $minecraft->entity()->getEntities(),
            'players' => $minecraft->player()->getPlayers(),
            'plugins' => $minecraft->plugin()->getPlugins(),
            'tile_entities' => $minecraft->tileEntity()->getTileEntities(),
            'worlds' => $minecraft->world()->getWorlds(),
        ]);
    }
}
