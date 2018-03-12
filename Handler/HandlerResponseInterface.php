<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 09.03.18
 * Time: 10:14
 */

namespace CoreBundle\Handler;

/**
 * Interface HandlerResponseInterface
 * @package CoreBundle\Handler
 */
interface HandlerResponseInterface
{
    /**
     * @return bool
     */
    public function isSubmitted(): bool;

    /**
     * @param bool $submitted
     * @return HandlerResponseInterface
     */
    public function setSubmitted(bool $submitted): HandlerResponseInterface;

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @param bool $submitted
     * @return HandlerResponseInterface
     */
    public function setValid(bool $submitted): HandlerResponseInterface;
}
