<?php

namespace CoreBundle\Controller;

use CoreBundle\Form\ConfigurationType;
use CoreBundle\Handler\ConfigurationHandler;
use CoreBundle\Handler\FormHandlerResponseInterface;
use CoreBundle\Service\BundleService;
use CoreBundle\Service\ConfigurationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ConfigurationController
 * @package CoreBundle\Controller
 */
class ConfigurationController extends Controller
{
    /**
     * @param Request $request
     * @Route("/configure", name="configure")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ConfigurationType::class, null, [
            'uploaded_bundles' => ($bService = $this->get(BundleService::class))->findUploadedBundles(),
            'method' => Request::METHOD_PUT
        ]);
        $form->handleRequest($request);
        if ($request->getMethod() === Request::METHOD_PUT) {
            /** @var FormHandlerResponseInterface $response */
            $response = $this->get(ConfigurationHandler::class)->handle($form);
            $this->addFlash($response->getAttribute('status'), $response->getMessage());
        }
        return $this->render('@Core/Configuration/configure.html.twig', [
            'form' => $form->createView(),
            'configuration' => $this->get(ConfigurationService::class)->createConfiguration()
        ]);
    }
}
