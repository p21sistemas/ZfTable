<?php

/**
 * Link inserir 
 *
 * @author    Alfredo
 * @category  Decorator
 * @package   ZfTable\Decorator\Cell\Link
 * @copyright 2014 P21 Sistemas
 * @version   1.0.0
 */

namespace ZfTable\Decorator\Header\Link;

use ZfTable\Decorator\Header\Link;

class Inserir extends Link
{
	/**
	 * Helper
	 * @var string
	 */
	protected $helper = 'linkInserir';
	
	/**
	 * Action do controller
	 * @var string
	 */
	protected $action = 'inserir';
}