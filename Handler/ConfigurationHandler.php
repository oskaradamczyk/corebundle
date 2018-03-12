<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 09.03.18
 * Time: 09:47
 */

namespace CoreBundle\Handler;

use CoreBundle\Model\Bundle;
use CoreBundle\Model\Configuration;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigurationHandler
 * @package CoreBundle\Handler
 */
class ConfigurationHandler implements HandlerInterface
{
    /** @var string */
    private $successMessage = 'core.configuration.success_submit';

    /** @var string */
    protected $notSubmittedMessage = 'core.configuration.no_submit';

    /** @var string */
    private $configYamlDir;

    /** @var string */
    private $routingYamlDir;

    /** @var string */
    private $bundlesYamlDir;

    /**
     * ConfigurationHandler constructor.
     * @param string $configYamlDir
     * @param string $routingYamlDir
     * @param string $bundlesYamlDir
     */
    public function __construct(string $configYamlDir, string $routingYamlDir, string $bundlesYamlDir)
    {
        $this->configYamlDir = $configYamlDir;
        $this->routingYamlDir = $routingYamlDir;
        $this->bundlesYamlDir = $bundlesYamlDir;
    }

    /**
     * @param FormInterface $form
     * @return HandlerResponseInterface
     */
    public function handle(FormInterface $form): HandlerResponseInterface
    {
        $response = new HandlerResponse();
        if ($form->isSubmitted()) {
            $response->setSubmitted(true);
            if ($form->isValid()) {
                $response->setValid(true);
                $bundles = [];
                $config = [];
                $routing = [];
                /** @var Configuration $configuration */
                $configuration = $form->getData();
                /** @var Bundle $bundle */
                foreach ($configuration->getBundles() as $bundle) {
                    $bundles[] = $bundle->getClassName();
                    $bundle->getConfigPath() ? $config['imports'][] = ['resource' => $bundle->getConfigPath()] : $config = null;
                    $bundle->getRoutingPath() ? $routing['imports'][] = ['resource' => $bundle->getRoutingPath()] : $routing = null;
                }
                try {
                    file_put_contents($this->bundlesYamlDir, Yaml::dump($bundles));
                    file_put_contents($this->routingYamlDir, Yaml::dump($routing));
                    file_put_contents($this->configYamlDir, Yaml::dump($config));
                } catch (\Exception $e) {
                    return $response
                        ->setValid(false)
                        ->setAttributes(new ParameterBag([
                            'status' => 'error'
                        ]))
                        ->setMessage($e->getMessage());
                }
                return $response
                    ->setMessage($this->successMessage)
                    ->setAttributes(new ParameterBag([
                        'status' => 'success'
                    ]));
            };
            return $response
                ->setAttributes(new ParameterBag([
                    'status' => 'error',
                    'cause' => ($error = $form->getErrors(true)->current())->getCause()
                ]))
                ->setMessage($error->getMessage());
        }
        return $response
            ->setAttributes(new ParameterBag([
                'status' => 'error'
            ]))
            ->setMessage($this->notSubmittedMessage);
    }
}
