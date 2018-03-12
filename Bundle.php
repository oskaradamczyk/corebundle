<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 06.03.18
 * Time: 09:39
 */

namespace CoreBundle\Model;

/**
 * Class Bundle
 * @package CoreBundle\Model
 */
class Bundle
{
    /** @var string */
    private $path;

    /** @var string|null */
    private $configPath;

    /** @var string|null */
    private $routingPath;

    /** @var string */
    private $className;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Bundle
     */
    public function setPath(string $path): Bundle
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getConfigPath()
    {
        return $this->configPath;
    }

    /**
     * @param null|string $configPath
     * @return Bundle
     */
    public function setConfigPath(?string $configPath)
    {
        $this->configPath = $configPath;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRoutingPath()
    {
        return $this->routingPath;
    }

    /**
     * @param null|string $routingPath
     * @return Bundle
     */
    public function setRoutingPath(?string $routingPath)
    {
        $this->routingPath = $routingPath;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     * @return Bundle
     */
    public function setClassName(string $className)
    {
        $this->className = $className;
        return $this;
    }
}