<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 08.03.18
 * Time: 16:41
 */

namespace CoreBundle\Service;

use CoreBundle\Model\Bundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Finder\Finder;

/**
 * Class BundleService
 * @package CoreBundle\Service
 */
class BundleService
{
    const TOO_MANY_CONFIGS_EXCEPTION = 'Too many config.yaml files found "%s" in bundle\'s "Resources/config" directory.';
    const TOO_MANY_ROUTINGS_EXCEPTION = 'Too many routing.yaml files found "%s" in bundle\'s "Resources/config" directory.';
    const NO_CONFIG_DIR_EXCEPTION = 'Config directory "/Resources/config" does not exist in "%s" bundle directory.';
    const CLASS_NOT_FOUND_EXCEPTION = 'Class "%s" not found for bundle "%s".';

    /** @var string */
    private $searchDir;

    /** @var string */
    private $coreBundleName;

    /**
     * BundleService constructor.
     * @param string $searchDir
     * @param string $coreBundleName
     */
    public function __construct(string $searchDir, string $coreBundleName)
    {
        $this->searchDir = $searchDir;
        $this->coreBundleName = $coreBundleName;
    }

    /**
     * @return Collection
     * @throws \LogicException
     */
    public function findUploadedBundles(): Collection
    {
        $bundlesFinder = (new Finder())
            ->in($this->searchDir)
            ->directories()
            ->depth('== 0')
            ->notName($this->coreBundleName);
        $bundles = new ArrayCollection();
        /**
         * @var int $key
         * @var \SplFileInfo $dir
         */
        foreach ($bundlesFinder as $key => $dir) {
            $bundle = new Bundle();
            $bundle
                ->setPath($path = $dir->getRealPath());
            if (!is_dir($path . '/Resources/config')) {
                throw new \LogicException(sprintf(self::NO_CONFIG_DIR_EXCEPTION, $dir->getFilename()));
            }

            $this->setBundleConfiguration($bundle, 'configPath', 'config');
            $this->setBundleConfiguration($bundle, 'routingPath', 'routing');

            if (!class_exists($class = ($dir->getFilename() . '\\' . $dir->getFilename()))) {
                throw new \LogicException(sprintf(self::CLASS_NOT_FOUND_EXCEPTION, $class, $dir->getFilename()));
            }

            $bundle->setClassName($class);
            $bundles->add($bundle);
        }
        return $bundles;
    }

    /**
     * @param Bundle $bundle
     * @param string $fieldName
     * @param string $configName
     * @param string $configExtension
     */
    private function setBundleConfiguration(Bundle $bundle, string $fieldName, string $configName, string $configExtension = '.yml'){
        $setter = 'set' . ucfirst($fieldName);
        $yamlFinder = (new Finder())
            ->files()
            ->in($bundle->getPath() . '/Resources/config')
            ->name($configName . $configExtension);
        /** @var \SplFileInfo $yml */
        foreach ($yamlFinder as $yml) {
            $bundle->$setter($yml->getRealPath());
        }
    }
}