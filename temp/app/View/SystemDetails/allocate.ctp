<?php

echo $this->Html->css('combo/default/easyui.css');
echo $this->Html->css('combo/icon.css');
echo $this->Html->script('jquery.easyui.min.js');
?>
<div class="systemDetails form">
    <?php echo $this->Form->create('SystemAllocation'); ?>
    <fieldset>
        <legend><?php echo __('System Allocation'); ?></legend>
        <?php
        //echo $this->Form->input('system_detail_id');
        echo $this->Form->input('system_detail_id', array('type' => 'select', 'options'=> $systemDropdown, 'selected'=> $systemId, 'label'=>'Tag Number', 'style'=>'width:205px'));
        echo $this->Form->input('newuser',
            array(
                'label'=>false,
                'type'=>'checkbox',
                'after' => '<label>New User</label>',
                'div' => true,
                'style' => 'float:right'
         ));
        echo '<div id="oldUser">';
        echo $this->Form->input('old_user_id', array('type' => 'select', 'class' => 'easyui-combobox', 'options'=> $userDropdown, 'label'=>'Name', 'style'=>'width:205px'));
        echo '</div>';

        echo '<div id="newUser">';
        echo $this->Form->input('new_user_id', array('type' => 'text', 'label'=>'Name', 'style'=>'width:205px'));
		 echo $this->Form->input('email', array('style'=>'width:205px'));
        echo $this->Form->input('department', array('type'=>'select', 'options'=>array('Admin' => 'Admin', 'HR' => 'HR', 'ITS' => 'ITS', 'Producers' => 'Producers', 'Testers' => 'Testers'), 'label'=>'Department', 'style'=>'width:205px'));
        echo '</div>';

        //echo $this->Form->input('location_id', array('type' => 'select', 'options'=> $locatonDropdown, 'label'=>'Location', 'style'=>'width:205px'));
        echo $this->Form->input('comments', array('type' => 'textarea', 'style'=>'font-size:15px;'));
        ?>

    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#SystemAllocationNewuser').bind('change', function() {
            if (this.checked) {
                $('#oldUser').hide();
                $('#newUser').show();
				 $('#SystemAllocationAllocateForm').attr('onsubmit','return validate();');
            } else {
                $('#oldUser').show();
                $('#newUser').hide();
				$('#SystemAllocationAllocateForm').removeAttr('onsubmit');
            }
        })
    });

    $('#newUser').hide();
	
	 function validate(){
        var name = $('#SystemAllocationNewUserId').val();
        var email = $('#SystemAllocationEmail').val();
        if(name.length<5)
        {
            alert('Name must be between 5 to 50 characters');
            return false;
        } else if(email.length==0){
            alert('email field blank');
             return false;
        }else{
            return true;
        }

    }
</script>