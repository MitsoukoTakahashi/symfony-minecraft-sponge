<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class CommandResponse
{
    /**
     * @Serializer\Type("string")
     */
    private $response;

    public function getResponse()
    {
        return $this->response;
    }
}
