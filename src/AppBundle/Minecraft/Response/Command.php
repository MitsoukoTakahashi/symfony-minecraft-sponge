<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class Command
{
    /**
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @Serializer\Type("array")
     */
    private $aliases;

    /**
     * @Serializer\Type("string")
     */
    private $usage;

    /**
     * @Serializer\Type("string")
     */
    private $description;

    public function getName()
    {
        return $this->name;
    }

    public function getAliases()
    {
        return $this->aliases;
    }

    public function getUsage()
    {
        return $this->usage;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
