<?php

App::uses('AppModel', 'Model');

/**
 * SystemDetail Model
 *
 * @property SystemAllocation $SystemAllocation
 */
class SystemDetail extends AppModel {
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'SystemAllocation' => array(
            'className' => 'SystemAllocation',
            'foreignKey' => 'system_detail_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public $belongsTo = array(
            'Location' => array(
                    'className' => 'Location',
                    'foreignKey' => 'location_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            )
	);

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'tag_no' => array(
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule'    => array('isUniqueTagNo'),
                'message' => 'Tag No. already exists'
            ),
        ),

        'model' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'serial_no' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule'    => array('isUniqueSerialNo'),
                'message' => 'Serial No. already exists'
            ),
        ),
        'part_no' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'processor' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'hard_disk' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),

        ),
        'memory' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'memory_detail' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'wifi_available' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please select wifi available option.'
        ),
//        'wifi_works' => array(
//            'rule'       => array('notEmpty'),
//            'message'    => 'Please select wifi works option.'
//        ),
//        'custom_charges' => array(
//            'rule'       => array('notEmpty'),
//            'message'    => 'Please select custom charges option.'
//        ),
        'status' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please select system status.'
        ),
//        'warranty' => array(
//            'rule'       => array('date', 'dmy'),
//            'message'    => 'Enter a valid date in DD-MM-YY format.',
//            'allowEmpty' => false
//        ),
        'in_date' => array(
            'rule'       => array('date', 'dmy'),
            'message'    => 'Enter a valid date in DD-MM-YY format.',
            'allowEmpty' => false
        ),
        'main_battery' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please main battery option.'
        ),
        'side_battery' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please select side battery option.'
        ),
        'system_detail_id' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please select system.'
        ),
        'location_id' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please select location.'
        )
    );


     function isUniqueTagNo($check) {
         $url = $_SERVER['REQUEST_URI'];

       if(strripos($url, 'add')){

        $tagno = $this->find(
            'first',
            array(
                'fields' => array(
                    'SystemDetail.id',
                    'SystemDetail.tag_no'
                ),
                'conditions' => array(
                    'SystemDetail.tag_no' => $check['tag_no']
                )
            )
        );

        if(!empty($tagno)){
//            if($this->data[$this->alias]['id'] == $username['SystemDetail']['id']){
//                return true;
//            }else{
//                return false;
//            }
            return false;
        }else{
            return true;
        }
       }else{
           return true;
       }
    }

    function isUniqueSerialNo($check) {
        $url = $_SERVER['REQUEST_URI'];

       if(strripos($url, 'add')){
        $serialno = $this->find(
            'first',
            array(
                'fields' => array(
                    'SystemDetail.id',
                    'SystemDetail.serial_no'
                ),
                'conditions' => array(
                    'SystemDetail.serial_no' => $check['serial_no']
                )
            )
        );

        if(!empty($serialno)){
//            if($this->data[$this->alias]['id'] == $username['SystemDetail']['id']){
//                return true;
//            }else{
//                return false;
//            }
            return false;
        }else{
            return true;
        }
       }else{
           return true;
       }
    }
}
