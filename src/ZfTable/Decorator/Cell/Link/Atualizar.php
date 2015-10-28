<?php

/**
 * Link atualizar
 *
 * @author    Vagner
 * @category  Decorator
 * @package   ZfTable\Decorator\Cell\Link
 * @copyright 2014 P21 Sistemas
 * @version   1.0.0
 */

namespace ZfTable\Decorator\Cell\Link;

use ZfTable\Decorator\Cell\Link;

class Atualizar extends Link
{
	/**
	 * Array of variable attribute for link
	 * @var array
	 */
	protected $vars = array('id');
	
	/**
	 * Helper
	 * @var string
	 */
	protected $helper = 'linkAtualizar';
	
	/**
	 * Action do controller
	 * @var string
	 */
	protected $action = 'atualizar';
}