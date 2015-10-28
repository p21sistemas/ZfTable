<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace ZfTable\Decorator;

use ZfTable\AbstractCommon;
use ZfTable\Decorator\Condition\ConditionFactory;

abstract class AbstractDecorator extends AbstractCommon implements DecoratorInterface
{

    /**
     * Decorator is adding before cotext
     */
    const PRE_CONTEXT   = 'pre';


    /**
     * Decorator is adding after context
     */
    const POST_CONTEXT  = 'post';


    /**
     * Decorator reset context and return only new context
     */
    const RESET_CONTEXT = 'reset';

     /**
     * Collections of conditions objects
     * @var array
     */
    protected $conditions = array();

    /**
     * Add new condition to decorator
     *
     * @param string $name
     * @param array $options
     * @return $this|null
     */
    public function addCondition($name, $options)
    {
        if ($this instanceof DataAccessInterface) {
            $condition = ConditionFactory::factory($name, $options);
            $condition->setDecorator($this);
            $this->attachCondition($condition);
            return $this;
        }
    }

    /**
     * Attach new condition
     *
     * @param Condition\AbstractCondition $condition
     */
    protected function attachCondition($condition)
    {
        $this->conditions[] = $condition;
    }

    /**
     * Check if all conditions are valid
     *
     * @return boolean
     */
    public function validConditions()
    {
        if (!count($this->conditions)) {
            return true;
        }

        foreach ($this->conditions as $condition) {
            if (!$condition->isValid()) {
                return false;
            }
        }

        return true;
    }
    
    /**
     * Get View renderer
     *
     * @return \Zend\View\Renderer\PhpRenderer
     */
    public function getView()
    {
    	return $this->getTable()->getViewHelperManager()->getRenderer();
    }
    
    /**
     * Retorna a url params com controller atual
     *
     * Preenche também a action informada e também os parametros complementares da uri
     *
     * @param string $action
     * @param array $params (passar parametros para adicionar na uri, por exemplo, id)
     * @return array
     */
    protected function getUrlParams($action, $params = array())
    {
    	$routeMatch = $this->getTable()->getServiceLocator()
    	->get('application')
    	->getMvcEvent()
    	->getRouteMatch();
    
    	$controller = $routeMatch->getParam('__CONTROLLER__');
    	$urlParams = array(
    			'controller' => $controller,
    			'action' => $action
    	);
    
    	return array_merge($urlParams, $params);
    }
    
    /**
     * Retorna a rota atual
     *
     * @return string
     */
    protected function getRoute()
    {
    	$routeMatch = $this->getTable()->getServiceLocator()
    	->get('application')
    	->getMvcEvent()
    	->getRouteMatch();
    	return $routeMatch->getMatchedRouteName();
    }
}
