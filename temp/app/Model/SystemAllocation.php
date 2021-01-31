<?php
App::uses('AppModel', 'Model');
/**
 * SystemAllocation Model
 *
 * @property SystemDetail $SystemDetail
 * @property User $User
 * @property Location $Location
 */
class SystemAllocation extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SystemDetail' => array(
			'className' => 'SystemDetail',
			'foreignKey' => 'system_detail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
        'system_detail_id' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please select system.'
        ),
        'user_id' => array(
            'rule'       => array('notEmpty'),
            'message'    => 'Please select employee name.'
        )

    );
}
