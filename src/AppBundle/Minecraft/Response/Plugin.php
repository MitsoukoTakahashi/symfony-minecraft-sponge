<?php declare(strict_types = 1);

namespace AppBundle\Minecraft\Response;

use JMS\Serializer\Annotation as Serializer;

class Plugin
{
    /**
     * @Serializer\Type("string")
     */
    private $id;

    /**
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @Serializer\Type("string")
     */
    private $description;

    /**
     * @Serializer\Type("string")
     */
    private $version;

    /**
     * @Serializer\Type("string")
     */
    private $url;

    /**
     * @Serializer\Type("array")
     */
    private $authors;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getAuthors()
    {
        return $this->authors;
    }
}
