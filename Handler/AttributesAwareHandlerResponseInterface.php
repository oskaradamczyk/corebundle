<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 09.03.18
 * Time: 10:11
 */

namespace CoreBundle\Handler;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface AttributesAwareHandlerResponseInterface
 * @package CoreBundle\Handler
 */
interface AttributesAwareHandlerResponseInterface
{
    /**
     * @return ParameterBag
     */
    public function getAttributes(): ParameterBag;

    /**
     * @param ParameterBag $attributes
     * @return AttributesAwareHandlerResponseInterface
     */
    public function setAttributes(ParameterBag $attributes): AttributesAwareHandlerResponseInterface;

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getAttribute(string $key);

    /**
     * @param string $key
     * @return bool
     */
    public function hasAttribute(string $key): bool;

    /**
     * @param string $key
     * @param $value
     * @return AttributesAwareHandlerResponseInterface
     */
    public function setAttribute(string $key, $value): AttributesAwareHandlerResponseInterface;

    /**
     * @param array $attributes
     * @return AttributesAwareHandlerResponseInterface
     */
    public function addAttribute(array $attributes): AttributesAwareHandlerResponseInterface;
}
