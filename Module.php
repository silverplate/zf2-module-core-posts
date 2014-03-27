<?php

namespace CorePosts;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                __NAMESPACE__ . '\Mapper\Article' =>
                    __NAMESPACE__ . '\Mapper\Article',
                __NAMESPACE__ . '\Mapper\Author' =>
                    __NAMESPACE__ . '\Mapper\Author',
            ),
            'factories' => array(
                __NAMESPACE__ . '\Form\Article' => function($_sm) {
                    return new Form\Article($_sm);
                }
            )
        );
    }
}
