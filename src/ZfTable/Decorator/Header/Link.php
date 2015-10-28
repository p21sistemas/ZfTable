<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace ZfTable\Decorator\Header;

use ZfTable\Decorator\Exception;

class Link extends AbstractHeaderDecorator
{
    /**
     * Label
     * @var string
     */
    protected $label;
    
    /**
     * Helper
     * @var string
     */
    protected $helper = 'link';
    
    /**
     * Action do controller
     * @var string
     */
    protected $action;

    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        $this->label = isset($options['label']) ? $options['label'] : $this->label;
        $this->helper = isset($options['helper']) ? $options['helper'] : $this->helper;
        $this->action = isset($options['action']) ? $options['action'] : $this->action;
    }

    /**
     * (non-PHPdoc)
     * @see \ZfTable\Decorator\DecoratorInterface::render()
     */
    public function render($context)
	{
		$attributes = $this->label ? array('value' => $this->label) : [];
		$helper = $this->helper;		
		return $this->getView()->$helper($this->getRoute(), $this->getUrlParams($this->action), $attributes) . '&nbsp;';
	}
}
