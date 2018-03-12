<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 08.03.18
 * Time: 16:33
 */

namespace CoreBundle\Service;

use CoreBundle\Model\Bundle;
use CoreBundle\Model\Configuration;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigurationService
 * @package CoreBundle\Service
 */
class ConfigurationService
{
    /** @var BundleService */
    private $bundleService;

    /** @var string */
    private $bundlesYamlDir;

    /**
     * ConfigurationService constructor.
     * @param BundleService $bundleService
     * @param string $bundlesYamlDir
     */
    public function __construct(BundleService $bundleService, string $bundlesYamlDir)
    {
        $this->bundleService = $bundleService;
        $this->bundlesYamlDir = $bundlesYamlDir;
    }

    /**
     * @return Configuration
     */
    public function createConfiguration()
    {
        return (new Configuration())->setBundles($this->bundleService->findUploadedBundles()->filter(
            function (Bundle $bundle) {
                if(!file_exists($this->bundlesYamlDir) || !is_array($bundlesConfig = Yaml::parseFile($this->bundlesYamlDir))){
                    return true;
                }
                return in_array($bundle->getClassName(), $bundlesConfig);
            }
        ));
    }
}
