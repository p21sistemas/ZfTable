<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace ZfTable\Decorator\Cell;

use ZfTable\Decorator\Exception;

class Telefone extends AbstractCellDecorator
{

    /**
     *
     * @var array
     */
    protected $options;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
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
        // Filtro 
        $mask = new \Application\Filter\Mask();
        $length = strlen($context);
        
        // telefone
        if ($length == 10) {
            return $mask->mask($context, '(##) ####-####');
        } else if ($length == 11) {
            return $mask->mask($context, '(##) # ####-####');
        }
        
        return $context;
    }
}
