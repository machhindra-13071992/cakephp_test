<?php
class EmployeesController extends AppController {
    public $helpers = array('Html', 'Form');
	public $components = array('Paginator', 'Flash');
	
	
	public function isAuthorized($user = NULL) {
		// Unless they are an admin, only the owner of a post can edit or delete it
		if (in_array($this->action, array('admin_edit', 'admin_delete')) && ($this->Auth->user('role') != 'admin')) {
			 $postId = (int) $this->request->params['pass'][0];
			if($this->Post->isOwnedBy($postId,$this->Auth->user('id'))){
				return true;
			}
		}
		return parent::isAuthorized($user);
	}

    public function index() {
		$options = array();
		if(isset($this->request->query['searchbox'])){
			$options['AND']['Employee.name LIKE'] = '%' . $this->request->query['searchbox'] . '%';
		}
		$options['AND']['Employee.status'] = 1;
        $this->paginate = array(
			'limit' => 10,
			'order' => array('Employee.created' => 'asc' ),
			'conditions' => $options,
		);
		$employees = $this->paginate('Employee');
		//pr($employees);die;
		$this->set(compact('employees'));
    }
    
    public function view($id = null) {
    	if (!$id) {
    		throw new NotFoundException(__('Invalid post'));
    	}
    	$post = $this->Employee->findById($id);
    	if (!$Employee) {
    		throw new NotFoundException(__('Invalid Employee'));
    	}
    	$this->set('Employee', $Employee);
    }
    
    public function admin_index() {
    	$this->paginate = array(
			'limit' => 5,
			'order' => array('Employee.created' => 'asc' ),
			'conditions' => array('Employee.status' => 1),
		);
		$posts = $this->paginate('Employee');
		$this->set(compact('posts'));
    }
    
    public function add() {
		
    	if ($this->request->is('post')) {
			$this->Employee->create();
            $imageName = null;           
            if (!empty($this->request->data['Employee']['image_file']['name'])) {
				   $file = $this->request->data['Employee']['image_file'];
				   $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				   $arr_ext = array('jpg','jpeg','png'); 
				   if (in_array($ext, $arr_ext)) 
                  {    
				  $uploadFolder = "upload";
				  $uploadPath = WWW_ROOT . $uploadFolder;
				  $imageName = $file['name'];
                 //check if image type fits one of allowed types
				if (empty($errors) == true) {
					if (is_dir($uploadPath) == false) {
						mkdir("$uploadPath", 0700);     // Create directory if it does not exist
					}
					if (is_dir("$uploadPath/" . $imageName) == false) {
						move_uploaded_file($file['tmp_name'], "$uploadPath/" . $imageName);
					} else {                                  // rename the file if another one exist
						$new_dir = "$uploadPath/" . $imageName . time();
						rename($file['tmp_name'], $new_dir);
					}
				}
				$this->request->data['Employee']['image_file']=$imageName;
			}else{
				$this->Flash->error(__('Image file should be in jpg,png format.'));
			}
    	}
		$this->request->data['Employee']['image_file'] = $imageName;
		if ($this->Employee->save($this->request->data)) {
			$this->Flash->success(__('Employee has been created.'));
			return $this->redirect(array('controller'=>'employees','action' => 'index'));
		}
	}
    }
    public function edit($id = null) {
		$Employee = $this->Employee->findById($id);
		if (!$Employee) {
			throw new NotFoundException(__('Invalid Employee'));
		}
		$imageName = $Employee['Employee']['image_file'];           
		if (!empty($this->request->data['Employee']['image_file']['name'])) {
		   $file = $this->request->data['Employee']['image_file'];
		   $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
		   $arr_ext = array('jpg', 'jpeg', 'gif'); 
		   if (in_array($ext, $arr_ext)) 
		  {    
		  $uploadFolder = "upload";
		  $uploadPath = WWW_ROOT . $uploadFolder;
		 //check if image type fits one of allowed types
		if (empty($errors) == true) {
			if (is_dir($uploadPath) == false) {
				mkdir("$uploadPath", 0700);     // Create directory if it does not exist
			}
			if (is_dir("$uploadPath/" . $imageName) == false) {
				move_uploaded_file($file['tmp_name'], "$uploadPath/" . $imageName);
			} else {                                  // rename the file if another one exist
				$new_dir = "$uploadPath/" . $imageName . time();
				rename($file['tmp_name'], $new_dir);
			}
		}
			$this->request->data['Employee']['image_file']=$imageName;
		}else{
			$this->Flash->error(__('Unable to add your Employee.'));
			}
		}
		
		if ($this->request->is(array('put'))) {
			$this->request->data['Employee']['image_file']= $imageName;
			$this->Employee->id = $id;
			if ($this->Employee->save($this->request->data)) {
				$this->Flash->success(__('Your Employee has been updated.'));
				return $this->redirect(array('controller'=>'employees','action' => 'index'));
			}
			$this->Flash->error(__('Unable to update your Employee.'));
		}
	
		if (!$this->request->data) {
			$this->request->data = $Employee;
		}
    }
	
	public function delete($id){
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$this->Employee->read(null,$id);
		$this->Employee->set(array(
			'status' => 0
		));
		if( $this->Employee->save()){
			$this->Flash->success(__('The Employee with id: %s has been deleted.', h($id)));
			return $this->redirect(array('controller' =>'employees','action' =>'index'));
		}
	}
        
        
        public function admin_bulkaction(){
            $this->layout = false;
             $response = array();
            if($this->request->is(array('Employee', 'put'))) {
               if(!empty($this->request->data['postIds'])){
                   
                   foreach ($this->request->data['postIds'] as $postId) {
                     $this->Employee->id = $postId;
                      if (!$this->Employee->exists()) {
                          throw new NotFoundException(__('Invalid model'));
                        }
                        
                        if($this->Session->read('Auth.User.role') != 'author' ){
                        //pr($this->Employee->User->findById($this->Session->read('Auth.User.id')));
                        if($this->Employee->updateAll(array('status'=>2), array('Employee.id'=>$postId))){
                            
                            $this->Flash->success(__('Your Employee has been archived.'));
                        }}else{
                            $this->Flash->error(__('You have not Permission to Archive these Employee.'));
                        }
                   }
               }
            }
            return new CakeResponse(array('body'=> json_encode($response),'status'=>200));
        }
}