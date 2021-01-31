<?php

App::uses('AppController', 'Controller');

/**
 * Locations Controller
 *
 * @property Location $Location
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LocationsController extends AppController {

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
        $this->Location->recursive = 0;
        $locations = $this->Paginator->paginate();

        $systemByLocations = array();
        foreach ($locations as $location) {
            $systemByLocations[$location['Location']['id']] = $this->Location->SystemDetail->find('count', array('conditions' => array('location_id' => $location['Location']['id'])));
        }

        $this->set(compact('locations', 'systemByLocations'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if(!$this->Location->exists($id)) {
            throw new NotFoundException(__('Invalid location'));
        }
        $options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
        $this->set('location', $this->Location->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if($this->request->is('post')) {
            $this->Location->create();
            if($this->Location->save($this->request->data)) {
                $this->Session->setFlash(__('The location has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The location could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if(!$this->Location->exists($id)) {
            throw new NotFoundException(__('Invalid location'));
        }
        if($this->request->is(array('post', 'put'))) {
            if($this->Location->save($this->request->data)) {
                $this->Session->setFlash(__('The location has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The location could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
            $this->request->data = $this->Location->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Location->id = $id;
        if(!$this->Location->exists()) {
            throw new NotFoundException(__('Invalid location'));
        }
        $this->request->allowMethod('post', 'delete');
        if($this->Location->delete()) {
            $systems = $this->Location->SystemDetail->find('all', array('conditions' => array('SystemDetail.location_id' => $id)));

            foreach ($systems as $system) {
                $sysData = array('id' => $system['SystemDetail']['id'], 'status' => 'W', 'location_id' => 0);
                $this->Location->SystemDetail->save($sysData);
            }
            $this->Session->setFlash(__('The location has been deleted.'));
        } else {
            $this->Session->setFlash(__('The location could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function search() {
        if($this->request->is('post')) {
            $searchKey = $this->request->data['search'];
            $this->Paginator->settings = array(
                'conditions' => array(
                    'Location.location_name like' => "%$searchKey%"
                )
            );

            $locations = $this->Paginator->paginate();
            $this->set(compact('locations'));
            $this->render("index");
        } else {
            $this->redirect(array('action' => 'index'));
        }
    }

}
