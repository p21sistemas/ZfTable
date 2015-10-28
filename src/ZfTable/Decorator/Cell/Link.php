<?php

namespace ZfTable\Decorator\Cell;

use ZfTable\Decorator\Exception;

/**
 * ZfTable ( Module for Zend Framework 2)
 * 
 * Customização da P21 para utilização de helpers da visão
 *
 * @author    Vagner
 * @copyright P21 Sistemas 2015
 */
class Link extends AbstractCellDecorator
{

    /**
     * Array of variable attribute for link
     * @var array
     */
    protected $vars;

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
     * Condição para renderizar o decorator
     * 
     * @var unknown
     */
    protected $condition;

    /**
     * Constructor
     *
     * @param array $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        $closure = function ($v, $c) {};
        
        if (isset($options['vars'])) {
            $this->vars = is_array($options['vars']) ? $options['vars'] : $this->vars;
        }
        $this->label = isset($options['label']) ? $options['label'] : $this->label;
        $this->helper = isset($options['helper']) ? $options['helper'] : $this->helper;
        $this->action = isset($options['action']) ? $options['action'] : $this->action;
        $this->condition = isset($options['condition']) ? $options['condition'] : $closure;
    }

    /**
     * (non-PHPdoc)
     * @see \ZfTable\Decorator\DecoratorInterface::render()
     */
    public function render($context)
	{
	    if (! $this->condition instanceof \Closure) {
	       throw new \Exception('Condition deve ser uma closure');  
	    }
	    
	    $closure = $this->condition;
	    
	    $condition = $closure($context, $this->getCell()->getActualRow());
	    
	    if ($condition === false) {
	        return;
	    }
	    
		$values = array();
		if (count($this->vars)) {
			$actualRow = $this->getCell()->getActualRow();
			foreach ($this->vars as $var) {
				if (is_array($actualRow)) {
					$values[$var] = $actualRow[$var];
				} else {
					$method = 'get' . ucfirst($var);
					$values[$var] = $actualRow->$method();
				}
			}
		}
		$attributes = $this->label ? array('value' => $this->label) : [];
		$helper = $this->helper;		
		return $this->getView()->$helper($this->getRoute(), $this->getUrlParams($this->action, $values), $attributes) . '&nbsp;';
	}
}
