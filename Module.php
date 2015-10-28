<?php
namespace ZfTable;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(

			
            ),
           'aliases' => array(
                'zfdb_adapter' => 'Zend\Db\Adapter\Adapter',
            ),
        );
    }    
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    

}