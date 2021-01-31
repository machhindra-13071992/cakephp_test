<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Component
 * @author Suresh.Maharana
 */
App::uses('Component', 'Controller');

class AccessComponent extends Component {

    private $accessOn = array('admin' => array(array('Controller' => 'Users', 'Action' => 'admin_login'),
            array('Controller' => 'Users', 'Action' => 'admin_index'),
            array('Controller' => 'Users', 'Action' => 'admin_add'),
            array('Controller' => 'Users', 'Action' => 'admin_view'),
            array('Controller' => 'Users', 'Action' => 'admin_edit'),
            array('Controller' => 'Users', 'Action' => 'admin_delete'),
            array('Controller' => 'Users', 'Action' => 'admin_logout'),
            array('Controller' => 'Users', 'Action' => 'admin_editprofile'),
           array('Controller' => 'Users', 'Action' => 'admin_profile'),
            array('Controller' => 'Users', 'Action' => 'admin_activate'),
            array('Controller' => 'Users', 'Action' => 'admin_dashboard'),
            array('Controller' => 'Users', 'Action' => 'admin_categories'),
            array('Controller' => 'posts', 'Action' => 'admin_index'),
            array('Controller' => 'posts', 'Action' => 'admin_add'),
            array('Controller' => 'posts', 'Action' => 'index'),
            array('Controller' => 'posts', 'Action' => 'admin_edit'),
            array('Controller' => 'posts', 'Action' => 'admin_delete'),
            array('Controller' => 'posts', 'Action' => 'admin_approve'),
            array('Controller' => 'posts', 'Action' => 'admin_archive'),

            array('Controller' => 'Loggers', 'Action' => 'admin_index')   
        ),
        'author' => array(array('Controller' => 'Users', 'Action' => 'admin_login'),
            array('Controller' => 'Users', 'Action' => 'admin_logout'),
            array('Controller' => 'Users', 'Action' => 'admin_editprofile'),
            array('Controller' => 'Users', 'Action' => 'admin_profile'),
            array('Controller' => 'dashboard', 'Action' => 'admin_index'),
            array('Controller' => 'Users', 'Action' => 'admin_dashboard'),
            array('Controller' => 'posts', 'Action' => 'admin_index'),
             array('Controller' => 'posts', 'Action' => 'admin_add'),
            array('Controller' => 'posts', 'Action' => 'index'),
            array('Controller' => 'posts', 'Action' => 'admin_edit'),
            array('Controller' => 'media', 'Action' => 'admin_index'),
            array('Controller' => 'media', 'Action' => 'admin_add')
        ) );

    public function initialize(Controller $controller) {
        $this->controller = $controller;
    }

    public function isAllowed() {
        $validUrl = false;
       //pr($this->controller->request); //to get controller name and Acton name
        if($this->controller->request->is('ajax')) {
            $validUrl = true;
        } else {
           App::import('model', 'User');
            $userRoleObj = new User();
            $userRoles = $userRoleObj->find('first', array('conditions' => array('role' => AuthComponent::user('role'))));
            $allowedActions = $this->accessOn[$userRoles['User']['role']];
            foreach ($userRoles as $userRole) {

                foreach ($allowedActions as $allowedAction) {
                    if(strtolower($allowedAction['Controller']) == strtolower($this->controller->request->params['controller']) &&
                            strtolower($allowedAction['Action']) == strtolower($this->controller->request->params['action'])) {
                            $validUrl = true;
                            break;
                    }
                }
            }
        }

        if($validUrl === true) {
            return true;
        } else {
            return false;
        }
    }
}
