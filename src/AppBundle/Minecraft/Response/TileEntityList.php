<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

class TileEntityList
{
    private $tileEntities;

    public function __construct(array $tileEntities)
    {
        $this->tileEntities = array_map(function (array $tileEntity) {
            return new TileEntity($tileEntity['type'], $tileEntity['location']);
        }, $tileEntities);
    }

    /** @return TileEntity[] */
    public function getTileEntities(): array
    {
        return $this->tileEntities;
    }
}
