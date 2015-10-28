<?php
namespace ZfTable\Decorator\Cell;

use ZfTable\Decorator\Exception;

/**
 * 
 * @author alfredo
 *
 */
class DateFormat extends AbstractCellDecorator
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
        if (! isset($options['format'])) {
            throw new \Exception('Format not defined');
        }
        
        $this->options = $options;
    }

    /**
     * Rendering decorator
     *
     * @param \Datetime $context            
     * @return string
     */
    public function render($context)
    {
        if (! $context instanceof \Datetime) {
            return $context;
        }
        
        return $context->format($this->options['format']);
    }
}
