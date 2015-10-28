<?php

/**
 * Link Download
 *
 * @author    Jerfeson Guerreiro
 * @category  Decorator
 * @package   ZfTable\Decorator\Cell\Link
 * @copyright 2015 P21 Sistemas
 * @version   2.0.0
 */

namespace ZfTable\Decorator\Cell\Link;

use ZfTable\Decorator\Cell\Link;

class Download extends Link
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
	protected $helper = 'linkDownload';
	
	/**
	 * Action do controller
	 * @var string
	 */
	protected $action = 'download';

}