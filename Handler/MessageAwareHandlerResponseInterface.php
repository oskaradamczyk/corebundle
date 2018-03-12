<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 09.03.18
 * Time: 10:12
 */

namespace CoreBundle\Handler;

/**
 * Interface MessageAwareHandlerResponseInterface
 * @package CoreBundle\Handler
 */
interface MessageAwareHandlerResponseInterface
{
    /**
     * @param string $message
     * @return MessageAwareHandlerResponseInterface
     */
    public function setMessage(string $message): MessageAwareHandlerResponseInterface;

    /**
     * @return null|string
     */
    public function getMessage(): ?string;
}
