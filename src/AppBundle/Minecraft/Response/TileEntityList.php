<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class TileEntityList
{
    /**
     * @Serializer\Type("array<AppBundle\Minecraft\Response\TileEntity>")
     */
    private $tileEntities;

    /** @return TileEntity[] */
    public function getTileEntities()
    {
        return $this->tileEntities;
    }
}
