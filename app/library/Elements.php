<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
    private $_headerMenu = [
        'navbar-left' => [
            'index' => [
                'caption' => 'Inicio',
                'action' => 'index'
            ],
            'invoices' => [
                'caption' => 'Registros',
                'action' => 'index'
            ],
            'about' => [
                'caption' => 'Sobre Nosotros',
                'action' => 'index'
            ],
        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Iniciar Sesión',
                'action' => 'index'
            ],
        ]
    ];

    private $_tabs = [
        'General' => [
            'controller' => 'invoices',
            'action' => 'index',
            'any' => true
        ],
        'Peliculas' => [
            'controller' => 'pelicula',
            'action' => 'index',
            'any' => true
        ],
        'Actores' => [
            'controller' => 'actor',
            'action' => 'index',
            'any' => true
        ],
        'Personajes' => [
            'controller' => 'personaje',
            'action' => 'index',
            'any' => true
        ],
        'Directores' => [
            'controller' => 'director',
            'action' => 'index',
            'any' => true
        ],
        'Tu Perfil' => [
            'controller' => 'invoices',
            'action' => 'profile',
            'any' => false
        ]
    ];

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = [
                'caption' => 'Cerrar Sesion',
                'action' => 'end'
            ];
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }

    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }
}
