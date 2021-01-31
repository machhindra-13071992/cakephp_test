<?php

App::uses('AppController', 'Controller');

/**
 * SystemAllocations Controller
 *
 * @property SystemAllocation $SystemAllocation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SystemAllocationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->SystemAllocation->recursive = 0;
        $this->set('systemAllocations', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if(!$this->SystemAllocation->exists($id)) {
            throw new NotFoundException(__('Invalid system allocation'));
        }
        $options = array('conditions' => array('SystemAllocation.' . $this->SystemAllocation->primaryKey => $id));
        $this->set('systemAllocation', $this->SystemAllocation->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if($this->request->is('post')) {
            $this->SystemAllocation->create();
            if($this->SystemAllocation->save($this->request->data)) {
                $this->Session->setFlash(__('The system allocation has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The system allocation could not be saved. Please, try again.'));
            }
        }
        $systemDetails = $this->SystemAllocation->SystemDetail->find('list');
        $users = $this->SystemAllocation->User->find('list');
        $locations = $this->SystemAllocation->Location->find('list');
        $this->set(compact('systemDetails', 'users', 'locations'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if(!$this->SystemAllocation->exists($id)) {
            throw new NotFoundException(__('Invalid system allocation'));
        }
        if($this->request->is(array('post', 'put'))) {
            if($this->SystemAllocation->save($this->request->data)) {
                $this->Session->setFlash(__('The system allocation has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The system allocation could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('SystemAllocation.' . $this->SystemAllocation->primaryKey => $id));
            $this->request->data = $this->SystemAllocation->find('first', $options);
        }
        $systemDetails = $this->SystemAllocation->SystemDetail->find('list');
        $users = $this->SystemAllocation->User->find('list');
        $locations = $this->SystemAllocation->Location->find('list');
        $this->set(compact('systemDetails', 'users', 'locations'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->SystemAllocation->id = $id;
        if(!$this->SystemAllocation->exists()) {
            throw new NotFoundException(__('Invalid system allocation'));
        }
        $this->request->allowMethod('post', 'delete');
        if($this->SystemAllocation->delete()) {
            $this->Session->setFlash(__('The system allocation has been deleted.'));
        } else {
            $this->Session->setFlash(__('The system allocation could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
