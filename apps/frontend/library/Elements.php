<?php

namespace Shagtv\Frontend\Library;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends \Phalcon\Mvc\User\Component
{

    private $_headerMenu = array(
        'pull-left' => array(
            'about' => array(
                'caption' => 'Об авторе',
                'action' => 'index'
            ),
            'contact' => array(
                'caption' => 'Контакты',
                'action' => 'index'
            ),
        ),
        'pull-right' => array(
            'session' => array(
                'caption' => 'Войти',
                'action' => 'index'
            ),
        )
    );

    private $_tabs = array(
		'Видео' => array(
                'controller' => 'video',
                'action' => 'index',
				'any' => false
            ),
        'Статьи' => array(
                'controller' => 'post',
                'action' => 'index',
				'any' => true
        ),
    );

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['pull-right']['session'] = array(
                'caption' => 'Выйти',
                'action' => 'end'
            );
        } else {
            //unset($this->_headerMenu['pull-left']['invoices']);
        }

        echo '<div class="nav-collapse">';
        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<ul class="nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo \Phalcon\Tag::linkTo($controller.'/'.$option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
        }
        echo '</div>';
    }

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
            echo \Phalcon\Tag::linkTo($option['controller'].'/'.$option['action'], $caption), '<li>';
        }
        echo '</ul>';
    }
}
