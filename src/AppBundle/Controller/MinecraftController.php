<?php declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Minecraft\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/** @Route(service="app.minecraft_controller", path="/minecraft") */
class MinecraftController
{
    private $templating;
    private $client;

    public function __construct(EngineInterface $templating, Client $client)
    {
        $this->templating = $templating;
        $this->client = $client;
    }

    /**
     * @Route(path="/info", name="minecraft_info", methods={"GET"})
     */
    public function infoAction()
    {
        return $this->templating->renderResponse('minecraft/info.html.twig', [
            'info' => $this->client->info()->wait(),
        ]);
    }

    /**
     * @Route(path="/command", name="minecraft_command", methods={"GET"})
     */
    public function commandAction()
    {
        return $this->templating->renderResponse('minecraft/command.html.twig', [
            'commands' => $this->client->commands()->wait(),
        ]);
    }

    /**
     * @Route(path="/players", name="minecraft_players", methods={"GET"})
     */
    public function playersAction()
    {
        return $this->templating->renderResponse('minecraft/players.html.twig', [
            'players' => $this->client
                ->players()->wait()
        ]);
    }
}
