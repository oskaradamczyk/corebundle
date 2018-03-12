<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 09.03.18
 * Time: 09:56
 */

namespace CoreBundle\Handler;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class HandlerResponse
 * @package CoreBundle\Handler
 */
class HandlerResponse implements FormHandlerResponseInterface
{
    /** @var bool */
    protected $submitted = false;

    /** @var bool */
    protected $valid = false;

    /** @var string|null */
    protected $message;

    /** @var ParameterBag */
    protected $attributes;

    /**
     * HandlerResponse constructor.
     */
    public function __construct()
    {
        $this->attributes = new ParameterBag();
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getAttribute(string $key)
    {
        return $this->attributes->get($key);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasAttribute(string $key): bool
    {
        return $this->attributes->has($key);
    }

    /**
     * @param ParameterBag $attributes
     * @return AttributesAwareHandlerResponseInterface|self
     */
    public function setAttributes(ParameterBag $attributes): AttributesAwareHandlerResponseInterface
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function getAttributes(): ParameterBag
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return AttributesAwareHandlerResponseInterface|self
     */
    public function addAttribute(array $attributes): AttributesAwareHandlerResponseInterface
    {
        $this->attributes->add($attributes);
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return AttributesAwareHandlerResponseInterface|self
     */
    public function setAttribute(string $key, $value): AttributesAwareHandlerResponseInterface
    {
        $this->attributes->set($key, $value);
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return MessageAwareHandlerResponseInterface|self
     */
    public function setMessage(string $message): MessageAwareHandlerResponseInterface
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubmitted(): bool
    {
        return $this->submitted;
    }

    /**
     * @param bool $submitted
     * @return HandlerResponseInterface|self
     */
    public function setSubmitted(bool $submitted): HandlerResponseInterface
    {
        $this->submitted = $submitted;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     * @return HandlerResponseInterface|self
     */
    public function setValid(bool $valid): HandlerResponseInterface
    {
        $this->valid = $valid;
        return $this;
    }
}
