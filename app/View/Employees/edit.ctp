<!-- File: /app/View/Employees/add.ctp -->
<div class="users">
<h1>Edit Employee</h1>
<?php
echo $this->Form->create('Employee',array('enctype' => 'multipart/form-data'));
echo $this->Form->input('name',array('label' => 'Employee Name'));
echo $this->Form->input('email',array('label' => 'Employee Email'));
echo $this->Form->input('phone',array('label' => 'Employee Phone'));
echo $this->Form->input('dob', array('type' => 'text','label' => 'Date of Birth', 'autocomplete' => 'off', 'class'=>'calendar_icon datepicker','max'=>date('Y-m-d')));
echo $this->Form->input('address', array('rows' => '2','label' => 'Employee Address'));
 echo $this->Form->input('image_file', array(
      'label' => 'Employee Image',
      'type' => 'file'
      )
   );
 echo $this->Form->end('Update Employee');
?>
</div>
<?php  echo $this->Html->link( "Back",   array('controller'=>'employees','action'=>'index') );  ?>
<br/>