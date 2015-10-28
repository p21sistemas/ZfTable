<?php

/**
 * Link histórico
 *
 * @author    Alfredo
 * @category  Decorator
 * @package   ZfTable\Decorator\Cell\Link
 * @copyright 2015 P21 Sistemas
 * @version   1.6.0
 */

namespace ZfTable\Decorator\Cell\Link;

use ZfTable\Decorator\Cell\Link;

class Historico extends Link
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
	protected $helper = 'linkHistorico';
	
	/**
	 * Action do controller
	 * @var string
	 */
	protected $action = 'historico';

}