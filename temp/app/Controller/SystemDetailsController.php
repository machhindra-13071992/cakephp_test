<?php

App::uses('AppController', 'Controller');

/**
 * SystemDetails Controller
 *
 * @property SystemDetail $SystemDetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SystemDetailsController extends AppController {

    public $helpers = array('PhpExcel');

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session', 'PhpExcel');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->SystemDetail->recursive = 1;
        $systemDetails = $this->Paginator->paginate();
        App::import('model', 'User');
        $userObj = new User();

        foreach ($systemDetails as $key => $systemDetail) {
            if($systemDetail['SystemDetail']['status'] == 'W') {
                $systemDetails[$key]['SystemDetail']['usename'] = 'Spare';
            } else if($systemDetail['SystemDetail']['status'] == 'NW') {
                $systemDetails[$key]['SystemDetail']['usename'] = 'Dead/Faulty';
            } else {
                foreach ($systemDetail['SystemAllocation'] as $allocation) {
                    if(isset($allocation['unassigned_date']) && ($allocation['unassigned_date'] == NULL) || empty($allocation['unassigned_date'])) {
                        $userInfo = $userObj->find('first', array('conditions' => array('User.' . $userObj->primaryKey => $allocation['user_id'])));
                        $systemDetails[$key]['SystemDetail']['usename'] = $userInfo['User']['name'];
                    }
                }
            }
        }

        $this->set('systemDetails', $systemDetails);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if(!$this->SystemDetail->exists($id)) {
            throw new NotFoundException(__('Invalid system detail'));
        }
        $options = array('conditions' => array('SystemDetail.' . $this->SystemDetail->primaryKey => $id));
        $this->set('systemDetail', $this->SystemDetail->find('first', $options));
        $this->set('systemAllocations', $this->SystemDetail->SystemAllocation->find('all', array('conditions' => array('system_detail_id' => $id), 'order' => array('SystemAllocation.assigned_date DESC'), 'limit' => 5)));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if($this->request->is('post')) {
            $this->SystemDetail->create();
            if($this->SystemDetail->save($this->request->data)) {
                $this->Session->setFlash(__('The system detail has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The system detail could not be saved. Please, try again.'));
            }
        }

        $locationDetails = $this->SystemDetail->Location->find('all', array('recursive' => 0));
        $locatonDropdown = array();
        foreach ($locationDetails as $locationDetail) {
            $locatonDropdown[$locationDetail['Location']['id']] = $locationDetail['Location']['location_name'];
        }

        $this->set(compact('locatonDropdown'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if(!$this->SystemDetail->exists($id)) {
            throw new NotFoundException(__('Invalid system detail'));
        }
        if($this->request->is(array('post', 'put'))) {
            if($this->SystemDetail->save($this->request->data)) {
                $this->Session->setFlash(__('The system detail has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The system detail could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('SystemDetail.' . $this->SystemDetail->primaryKey => $id));
            $this->request->data = $this->SystemDetail->find('first', $options);

            $locationDetails = $this->SystemDetail->Location->find('all', array('recursive' => 0));
            $locatonDropdown = array();
            foreach ($locationDetails as $locationDetail) {
                $locatonDropdown[$locationDetail['Location']['id']] = $locationDetail['Location']['location_name'];
            }

            $this->set(compact('locatonDropdown'));
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
        $this->SystemDetail->id = $id;
        if(!$this->SystemDetail->exists()) {
            throw new NotFoundException(__('Invalid system detail'));
        }
        $this->request->allowMethod('post', 'delete');
        if($this->SystemDetail->delete()) {
            $this->Session->setFlash(__('The system detail has been deleted.'));
        } else {
            $this->Session->setFlash(__('The system detail could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function allocate($systemId = null) {
        App::import('model', 'User');
        $userObj = new User();

        if($this->request->is('post')) {
            if($this->request->data['SystemAllocation']['newuser'] == 1) {
                $name = $this->request->data['SystemAllocation']['new_user_id'];
				$department = $this->request->data['SystemAllocation']['department'];
                $email = $this->request->data['SystemAllocation']['email'];
                $userDate = array('name' => $name, 'username' => $email, 'email' => $email,
                  'department' => $department, 'status' => 1);

                $userObj->save(array('User' => $userDate));
                $userId = $userObj->getLastInsertId();
            } else {
                $userId = $this->request->data['SystemAllocation']['old_user_id'];
            }

            $allocationData = array('system_detail_id' => $this->request->data['SystemAllocation']['system_detail_id'],
                'user_id' => $userId,
                'location_id' => $this->request->data['SystemAllocation']['location_id'],
                'assigned_date' => date('Y-m-d h:i:s'),
                'comments' => $this->request->data['SystemAllocation']['comments']);

            if($this->SystemDetail->SystemAllocation->save($allocationData)) {
                $this->SystemDetail->save(array('id' => $this->request->data['SystemAllocation']['system_detail_id'], 'status' => 'U'));
                $this->Session->setFlash(__('The system has been allocated.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The system allocation could not be saved. Please, try again.'));
            }
        }

        $systemDetails = $this->SystemDetail->find('all', array('conditions' => array('status' => 'W'), 'recursive' => 0));
        $systemDropdown = array();

        foreach ($systemDetails as $key => $systemDetail) {
            $systemDropdown[$systemDetail['SystemDetail']['id']] = $systemDetail['SystemDetail']['tag_no'];
        }

        $userDetails = $userObj->find('all', array('recursive' => 0, 'order' => array(
                'User.name ASC'
        )));
        $userDropdown = array();
        foreach ($userDetails as $key => $userDetail) {
            if($userDetail['User']['username'] != 'admin')
                $userDropdown[$userDetail['User']['id']] = $userDetail['User']['name'];
        }

//        App::import('model', 'Location');
//        $locationAttr = new Location();
//        $locationDetails = $locationAttr->find('all', array('recursive' => 0));
//        $locatonDropdown = array();
//        foreach ($locationDetails as $key => $locationDetail) {
//            $locatonDropdown[$locationDetail['Location']['id']] = $locationDetail['Location']['location_name'];
//        }

        $this->set(compact('userDropdown', 'systemDropdown', 'systemId'));
    }

    public function free($systemId = null) {
        $this->layout = false;
        $conditions = array(
            'SystemDetail.id' => $systemId
        );

        if($this->SystemDetail->hasAny($conditions)) {
            $this->SystemDetail->SystemAllocation->recursive = -1;
            $systemInfo = $this->SystemDetail->SystemAllocation->findAllBySystemDetailIdAndUnassignedDate($systemId, NULL);

            if(isset($systemInfo[0]['SystemAllocation'])) {
                $allocationId = $systemInfo[0]['SystemAllocation']['id'];
                $this->SystemDetail->SystemAllocation->save(array('id' => $allocationId, 'unassigned_date' => date('Y-m-d h:i:s')));
                $this->SystemDetail->save(array('id' => $systemId, 'status' => 'W'));
                $this->Session->setFlash(__('The system has been Un-assigned.'));
            } else {
                $this->Session->setFlash(__('Invalid Request.'));
            }
        } else {
            $this->Session->setFlash(__('Invalid Request.'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function home() {
        $this->SystemDetail->recursive = -1;
        $systemModels = $this->SystemDetail->find('all', array('fields' => array('id', 'model'), 'group' => array('model')));
        $locations = $this->SystemDetail->Location->find('all', array('recursive' => -1));
        $systemStatus = array();

        foreach ($systemModels as $systemModel) {
            $modelName = $systemModel['SystemDetail']['model'];
            $modelId = $systemModel['SystemDetail']['id'];
            $allCount = $this->SystemDetail->find('count', array('conditions' => array('model' => $modelName)));
            $systemLocation = array();
            $systemUsed = array();
            $systemWorking = array();
            $systemNotWorking = array();

            foreach ($locations as $location) {
                $countByLocation = $this->SystemDetail->find('count', array('conditions' => array('model' => $modelName,
                        'location_id' => $location['Location']['id'])));
                $systemLocation[$location['Location']['id']] = $countByLocation;

                $countBySystemUsed = $this->SystemDetail->find('count', array('conditions' => array('model' => $modelName,
                        'location_id' => $location['Location']['id'], 'status' => 'U')));

                $countBySystemUnUsed = $this->SystemDetail->find('count', array('conditions' => array('model' => $modelName,
                        'location_id' => $location['Location']['id'], 'status' => 'W')));

                $countBySystemDown = $this->SystemDetail->find('count', array('conditions' => array('model' => $modelName,
                        'location_id' => $location['Location']['id'], 'status' => 'NW')));

                $systemUsed[$location['Location']['id']] = $countBySystemUsed;
                $systemWorking[$location['Location']['id']] = $countBySystemUnUsed;
                $systemNotWorking[$location['Location']['id']] = $countBySystemDown;
            }
            $systemStatus[] = array('modelId' => $modelId, 'model' => $modelName, 'allcount' => $allCount, 'location' => $systemLocation,
                'used' => $systemUsed, 'working' => $systemWorking, 'notworking' => $systemNotWorking);
        }
//        echo '<pre>';
//        print_r($systemStatus);
//        echo '</pre>';

        foreach ($locations as $lockey => $location) {
            $locCount = $this->SystemDetail->find('count', array('conditions' => array('location_id' => $location['Location']['id'])));
            $locations[$lockey]['Location']['system'] = $locCount;
        }

        $totalSystems = $this->SystemDetail->find('count');
        $totalUsedSystems = $this->SystemDetail->find('count', array('conditions' => array('status' => 'U')));
        $totalDeadSystems = $this->SystemDetail->find('count', array('conditions' => array('status' => 'NW')));

        $this->set(compact('systemStatus', 'locations', 'totalSystems', 'totalUsedSystems', 'totalDeadSystems'));
    }

    public function search() {
        if($this->request->is('post')) {
            $searchKey = $this->request->data['search'];
            $this->Paginator->settings = array(
                'conditions' => array("OR" => array(
                        'SystemDetail.tag_no like' => "%$searchKey%",
                        'SystemDetail.model like' => "%$searchKey%",
                        'SystemDetail.serial_no like' => "%$searchKey%",
                        'SystemDetail.part_no like' => "%$searchKey%",
                        'SystemDetail.processor like' => "%$searchKey%",
                        'SystemDetail.hard_disk like' => "%$searchKey%",
                        'SystemDetail.memory like' => "%$searchKey%",
                        'SystemDetail.memory_detail like' => "%$searchKey%",
                        'SystemDetail.wifi_available like' => "%$searchKey%",
                        'SystemDetail.status like' => "%$searchKey%",
                    ))
            );

            $systemDetails = $this->Paginator->paginate();

            App::import('model', 'User');
            $userObj = new User();

            foreach ($systemDetails as $key => $systemDetail) {
                if($systemDetail['SystemDetail']['status'] == 'W') {
                    $systemDetails[$key]['SystemDetail']['usename'] = 'Spare';
                } else if($systemDetail['SystemDetail']['status'] == 'NW') {
                    $systemDetails[$key]['SystemDetail']['usename'] = 'Dead/Faulty';
                } else {
                    foreach ($systemDetail['SystemAllocation'] as $allocation) {
                        if(isset($allocation['unassigned_date']) && ($allocation['unassigned_date'] == NULL) || empty($allocation['unassigned_date'])) {
                            $userInfo = $userObj->find('first', array('conditions' => array('User.' . $userObj->primaryKey => $allocation['user_id'])));
                            $systemDetails[$key]['SystemDetail']['usename'] = $userInfo['User']['name'];
                        }
                    }
                }
            }

            $this->set(compact('systemDetails'));
            $this->render('index');
        } else {
            $this->redirect(array('action' => 'index'));
        }
    }

    public function filter() {
        $this->SystemDetail->recursive = 1;
        $condition = array();

        if(isset($this->params['named']['location'])) {
            $condition['SystemDetail.location_id'] = $this->params['named']['location'];
            $this->Paginator->settings = array(
                'conditions' => array('SystemDetail.location_id' => $this->params['named']['location'])
            );
        }

        if(isset($this->params['named']['model'])) {
            $modelName = $this->SystemDetail->find('first', array('conditions' => array('id' => $this->params['named']['model']), 'recursive' => -1));

            if(isset($modelName['SystemDetail']['model'])) {
                $condition['SystemDetail.model'] = $modelName['SystemDetail']['model'];
//                $this->Paginator->settings = array(
//                    'conditions' => array('SystemDetail.model' => $modelName['SystemDetail']['model'])
//                );
            }
        }

        if(isset($this->params['named']['status'])) {
            $condition['SystemDetail.status'] = $this->params['named']['status'];
        }

        if(!empty($condition)) {
            $this->Paginator->settings = array(
                'conditions' => $condition
            );
        }
        $this->set('systemDetails', $this->Paginator->paginate());
        $this->render('index');
    }

    public function export() {
        if($this->request->is('post')) {
            $this->PhpExcel->createWorksheet()->setDefaultFont('Calibri', 12);
            $this->PhpExcel->removeSheetByIndex(0);
            $locations = $this->request->data['locationData'];

            foreach ($locations as $locKey => $location) {
                // Fetching location name
                $locationName = $this->SystemDetail->Location->find('first', array('conditions' => array('id' => $location), 'recursive' => -1));
                // Create sheets
                $this->PhpExcel->createSheet($locKey);
                $this->PhpExcel->setActiveSheetIndex($locKey);
                $this->PhpExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->PhpExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->PhpExcel->getActiveSheet()->setTitle($locationName['Location']['location_name']);

                // Create Legends
//                $this->PhpExcel->getActiveSheet()->setCellValue('B2', 'Legends');
//                $this->PhpExcel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
//                $this->PhpExcel->getActiveSheet()->getStyle('B2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//                $this->PhpExcel->getActiveSheet()->setCellValue('B3', 'Used');
//                $this->PhpExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
//                $this->PhpExcel->getActiveSheet()->setCellValue('C3', 'Working');
//                $this->PhpExcel->getActiveSheet()->getStyle('C3')->getFill()->applyFromArray(
//                    array(
//                        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
//                        'startcolor' => array('rgb' => '7FFF7C'),
//                    )
//                );
//
//                $this->PhpExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
//                $this->PhpExcel->getActiveSheet()->setCellValue('D3', 'Not-Working');
//                $this->PhpExcel->getActiveSheet()->getStyle('D3')->getFill()->applyFromArray(
//                    array(
//                        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
//                        'startcolor' => array('rgb' => 'FDD3D3'),
//                    )
//                );
//
//                $this->PhpExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
//                $this->PhpExcel->getActiveSheet()->getStyle('B2:D3')->getBorders()->applyFromArray(
//                    array(
//                            'outline' => array(
//                                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
//                                    'color' => array(
//                                            'rgb' => '003D4C'
//                                    )
//                            )
//                    )
//                );

                // Create sheets headers
                $table = array(
                    array('label' => __('Tag ID'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('User'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('W'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('NW'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('U'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Model'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Serial No.'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Part No.'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Processor'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Hi Res'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('HDD'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Ram'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Ram Details'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Warranty'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Wi-Fi'), 'width' => 'auto', 'filter' => false),
//                    array('label' => __('Wi-Fi Works'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Sound'), 'width' => 'auto', 'filter' => false),
                    //array('label' => __('In Date'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('OEM Label'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Comments'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Misc'), 'width' => 'auto', 'filter' => false),
                    array('label' => __('Batt Status'), 'width' => 'auto', 'filter' => false)
                );

                // Formatting sheets headers
                $this->PhpExcel->setRow(1);
                $this->PhpExcel->addTableHeader($table, array('name' => 'Arial', 'bold' => true, 'size' => 12));
                $this->PhpExcel->getActiveSheet()->getStyle('A1:T1')->getFill()->applyFromArray(
                        array(
                            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                            'startcolor' => array('rgb' => 'DEDEDE'),
                        )
                    );
                $this->PhpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(27);

                $this->PhpExcel->getActiveSheet()->getStyle('A1:T1')->getBorders()->applyFromArray(
                    array(
                            'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array(
                                            'rgb' => '000000'
                                    )
                            )
                    )
                );

                // Fetching System information
                $altData = array();
                $sysDatas = $this->SystemDetail->find('all', array('conditions' => array('location_id' => $location)));
                App::import('model', 'User');
                $userObj = new User();

                foreach ($sysDatas as $sysData) {
                    $working = "";
                    $notworking = "";
                    $used = "";
                    $userName = 'Spare';

                    if($sysData['SystemDetail']['status'] == 'W') {
                        $working = 1;
                    } else if($sysData['SystemDetail']['status'] == 'NW') {
                        $notworking = 1;
                    } else {
                        $used = 1;
                    }

                    foreach ($sysData['SystemAllocation'] as $sysAllocate) {
                        if($sysAllocate['unassigned_date'] == NULL || empty($sysAllocate['assigned_date'])) {
                            $userInfo = $userObj->find('first', array('conditions' => array('User.' . $userObj->primaryKey => $sysAllocate['user_id'])));
                            $userName = $userInfo['User']['name'];
                        } else if($notworking == 1) {
                            $userName = 'Dead/Faulty';
                        }
                    }
					if(!empty($sysData['SystemDetail']['warranty'])){
                      $sysData['SystemDetail']['warranty'] = date("d-m-Y", strtotime($sysData['SystemDetail']['warranty']));
                    }
                    $altData = array($sysData['SystemDetail']['tag_no'],
                        $userName,
                        $working,
                        $notworking,
                        $used,
                        $sysData['SystemDetail']['model'],
                        $sysData['SystemDetail']['serial_no'],
                        $sysData['SystemDetail']['part_no'],
                        $sysData['SystemDetail']['processor'],
                        $sysData['SystemDetail']['high_resolution'],
                        $sysData['SystemDetail']['hard_disk'],
                        $sysData['SystemDetail']['memory'],
                        $sysData['SystemDetail']['memory_detail'],
                        $sysData['SystemDetail']['warranty'],
                        $sysData['SystemDetail']['wifi_available'],
//                        $sysData['SystemDetail']['wifi_works'],
                        $sysData['SystemDetail']['sound'],
                        //date("d-m-Y", strtotime($sysData['SystemDetail']['id_date'])),
                        $sysData['SystemDetail']['software_key'],
                        $sysData['SystemDetail']['comment'],
                        $sysData['SystemDetail']['side_battery'],
                        $sysData['SystemDetail']['main_battery'],);

                    $this->PhpExcel->addTableRow($altData);
                    $currentRow = $this->PhpExcel->getActiveSheet()->getHighestRow();
                    $currentCell = 'A'.$currentRow.':T'.$currentRow;

                    if($notworking == 1) {
                        $this->PhpExcel->getActiveSheet()->getStyle($currentCell)->getFill()->applyFromArray(
                            array(
                                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                                'startcolor' => array('rgb' => 'EEB6B6'),
                            )
                        );
                    }

                    if($working == 1) {
                        $this->PhpExcel->getActiveSheet()->getStyle($currentCell)->getFill()->applyFromArray(
                            array(
                                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                                'startcolor' => array('rgb' => 'DDF4D4'),
                            )
                        );
                    }

                    $this->PhpExcel->getActiveSheet()->getStyle($currentCell)->getBorders()->applyFromArray(
                        array(
                                'allborders' => array(
                                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                                        'color' => array(
                                                'rgb' => '000000'
                                        )
                                )
                        )
                    );
                }


                $this->PhpExcel->addTableFooter();
            }
			date_default_timezone_set("Asia/Kolkata");
                $filename="inventory ".date('d-m-y h:i:s');
            $this->PhpExcel->output($filename);
            $this->PhpExcel->exit();
        } else {
            $locations = $this->SystemDetail->Location->find('all', array('recursive' => -1));
            $this->set('locations', $locations);
        }
    }


   public function exists() {
	    $this->layout = 'ajax_blank';
	    if (!empty($this->data['SystemDetail']['tag_no'])) {
	            $u = $this->SystemDetail->findBytag_no($this->data['SystemDetail']['tag_no']);
	            if (empty($u)) {
                        echo "0";
                    }
	             else {
                        echo "1";
	            }
            }
           if (!empty($this->data['SystemDetail']['serial_no'])) {
	            $u = $this->SystemDetail->findByserial_no($this->data['SystemDetail']['serial_no']);
	            if (empty($u)) {
                        echo "0";
                    }
	             else {
                        echo "1";
	            }
            }
            }


}
