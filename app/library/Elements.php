<?php

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
		'php',
		'apache',
		'mysql',
		'java',
		'xml',
		'mongoDB',
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
                if (!empty($option['module'])) {
					$module = $option['module'].'/';
				} else {
					$module = '';
				}
				if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo \Phalcon\Tag::linkTo($module.$controller.'/'.$option['action'], $option['caption']);
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
			echo '<li><p class="tab-header">'.\Phalcon\Tag::linkTo('index/index/', 'Видео').'</p>';
			echo '<ul class="nav nav-tabs">';
			foreach ($this->_tabs as $option) {
				echo '<li>';
				echo \Phalcon\Tag::linkTo('index/tag/'.$option, $option), '<li>';
			}
			echo '</ul>';
			echo '</li>';
			echo '<li><p class="tab-header">'.\Phalcon\Tag::linkTo('utilits/index/', 'Онлайн сервисы').'</p>';
			echo '<ul class="nav nav-tabs">';
				echo '<li>'.\Phalcon\Tag::linkTo('utilits/index/', 'Date <=> Timestamp').'</li>';
			echo '</ul>';
			echo '</li>';
		echo '</ul>';
    }
}
