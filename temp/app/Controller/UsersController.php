<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $components = array('Paginator', 'Session', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'add');
    }

    public function login() {
        $this->layout = 'pre_login';
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')) {
            $this->redirect(array('action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if($this->request->is('post')) {
            if($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, ' . $this->Auth->user('username')));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                //$this->Session->setFlash(__('Invalid username or password'));
                $this->set('error', 'Invalid username or password');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->Paginator->settings = array(
            'conditions' => array('User.status' => 1, 'User.username !=' => 'admin')
        );

        $users = $this->Paginator->paginate();
        App::import('model', 'SystemAllocation');
        $allocationObj = new SystemAllocation();

        foreach ($users as $key => $user) {
            $users[$key]['allocation'] = $allocationObj->find('count', array('conditions' => array('SystemAllocation.user_id' => $user['User']['id'])));
        }
        $this->set(compact('users'));
    }

    public function add() {
        if($this->request->is('post')) {

            $this->User->create();
            $this->request->data['User']['username'] = $this->request->data['User']['email'];

            if($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been created'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        if(!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user detail'));
        }

        if($this->request->is(array('post', 'put'))) {
            if($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user detail has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user detail could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    public function delete($id = null) {

        if(!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action' => 'index'));
        }

        $this->User->id = $id;
        if(!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action' => 'index'));
        }
        if($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function activate($id = null) {

        if(!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action' => 'index'));
        }

        $this->User->id = $id;
        if(!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action' => 'index'));
        }
        if($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }

    public function systems($id = null) {
        App::import('model', 'SystemAllocation');
        $allocationObj = new SystemAllocation();
        $systemAllocations = $allocationObj->find('all', array(
            'conditions' => array('user_id' => $id)));
        $this->set(compact('systemAllocations'));
    }

    public function search() {
        if($this->request->is('post')) {
            $searchKey = $this->request->data['search'];
            $this->Paginator->settings = array(
                'conditions' => array(
                    'User.name like' => "%$searchKey%"
                )
            );

            $users = $this->Paginator->paginate();
            App::import('model', 'SystemAllocation');
            $allocationObj = new SystemAllocation();

            foreach ($users as $key => $user) {
                $users[$key]['allocation'] = $allocationObj->find('count', array('conditions' => array('SystemAllocation.user_id' => $user['User']['id'])));
            }
            $this->set(compact('users'));
            $this->render('index');

        } else {
            $this->redirect(array('action' => 'index'));
        }
    }

}

?>