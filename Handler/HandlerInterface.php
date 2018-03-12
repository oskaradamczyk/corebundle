<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 09.03.18
 * Time: 09:48
 */

namespace CoreBundle\Handler;

use Symfony\Component\Form\FormInterface;

/**
 * Interface HandlerInterface
 * @package CoreBundle\Handler
 */
interface HandlerInterface
{
    /**
     * @param FormInterface $form
     * @return HandlerResponseInterface
     */
    public function handle(FormInterface $form): HandlerResponseInterface;
}
