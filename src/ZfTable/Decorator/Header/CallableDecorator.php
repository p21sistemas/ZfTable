<?php

namespace ZfTable\Decorator\Header;

use ZfTable\Decorator\Exception;

/**
 * 
 * @author alfredo
 *
 */
class CallableDecorator extends AbstractHeaderDecorator
{

    /**
     *
     * @var \Closure
     */
    protected $options;

    /**
     * Constructor
     *
     * @param array $options
     * @throws \Exception
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['callable'])) {
            throw new \Exception('Please define closure');
        }
        $this->options = $options;

    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @return string
     */
    public function render($context)
    {
        $closure = $this->options['callable'];
        return $closure($context, $this->getHeader());
    }
}
