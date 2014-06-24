<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'CorePosts\CtrlController\Articles' =>
                'CorePosts\CtrlController\ArticlesController',
            'CorePosts\CtrlController\Authors' =>
                'CorePosts\CtrlController\AuthorsController',
        )
    ),

    'router' => array(
        'routes' => array(
            'ctrl-articles' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/ctrl/articles[/][:action][/:id[/]]',
                    'constraints' => array(
                        'action' => 'add|edit|srt',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'CorePosts\CtrlController\Articles',
                        'action' => 'index'
                    )
                )
            ),
            'ctrl-authors' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/ctrl/authors[/:action][/:id][/]',
                    'constraints' => array(
                        'action' => 'add|edit',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'CorePosts\CtrlController\Authors',
                        'action' => 'index'
                    )
                )
            ),
        ),
    ),

    'navigation' => array(
        'control' => array(
            array(
                'label' => 'Авторы',
                'route' => 'ctrl-authors',
            ),
            array(
                'label' => 'Статьи',
                'route' => 'ctrl-articles',
            ),
        )
    )
);
