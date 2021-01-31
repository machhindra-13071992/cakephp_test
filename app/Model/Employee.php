<?php
class Employee extends AppModel {

	public $validate = array(
		'name' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'))
        ),
        'email' => array(
			'notEmpty' => array(
            'rule' => array('notBlank')),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Email is not vaild',
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Email is already taken. Choose another.'
            ), 
        ),
		'phone' => array(
		'notEmpty' => array(
						'rule' => array('phone', '/^([0-9]{1}[0-9]{9})$/'),
						'message' => 'Please enter numbers only ',
						'allowEmpty' => false,
		)),
        'dob' => array(
            'checkdate' => array(
                'rule' => array('checkdate'),
                'message'  => 'dob must not be greater than current date',
            )
			)
		);
		
	public function checkdate($check) {
		$value = array_values($check);
		$value = date('Y-m-d',strtotime($value[0]));
		if($value <= date('Y-m-d')){
			return true ;
		}else {
			return false ;
		}
	}
}