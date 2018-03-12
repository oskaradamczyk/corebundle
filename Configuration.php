<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 05.03.18
 * Time: 14:26
 */

namespace CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class Configuration
 * @package CoreBundle\Model
 */
class Configuration
{
    /** @var Collection */
    private $bundles;

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        $this->bundles = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getBundles()
    {
        return $this->bundles;
    }

    /**
     * @param Collection $bundles
     * @return Configuration
     */
    public function setBundles(Collection $bundles): Configuration
    {
        $this->bundles = $bundles;
        return $this;
    }

    /**
     * @param Bundle $bundle
     * @return Configuration
     */
    public function addBundle(Bundle $bundle): Configuration
    {
        if (!$this->bundles->contains($bundle)) {
            $this->bundles->add($bundle);
        }
        return $this;
    }

    /**
     * @param Bundle $bundle
     * @return Configuration
     */
    public function removeBundle(Bundle $bundle): Configuration
    {
        if ($this->bundles->contains($bundle)) {
            $this->bundles->removeElement($bundle);
        }
        return $this;
    }
}
