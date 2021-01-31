<link rel="stylesheet" href="../../js/themes/base/jquery.ui.all.css">
<?php
echo $this->Html->script('jquery.ui.core');
echo $this->Html->script('jquery.ui.datepicker');
?>
<div class="systemDetails form">
<?php echo $this->Form->create('SystemDetail'); ?>
    <fieldset>
        <legend><?php echo __('Edit System Detail'); ?></legend>
        <table>
            <tr>
                <td>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tag_no', array('style'=>'width:200px; height:20px;'));
		echo $this->Form->input('model', array('style'=>'width:200px; height:20px;'));
		echo $this->Form->input('serial_no', array('style'=>'width:200px; height:20px;'));
		echo $this->Form->input('part_no', array('style'=>'width:200px; height:20px;'));
		echo $this->Form->input('processor', array('style'=>'width:200px; height:20px;'));
		echo $this->Form->input('high_resolution', array('type'=>'select', 'options'=>array('Yes'=>'Yes', 'No'=>'No'), 'label'=>'High Resolution', 'style'=>'width:205px'));
		echo $this->Form->input('hard_disk', array('style'=>'width:200px; height:20px;', 'label'=>'HDD'));
		echo $this->Form->input('memory', array('style'=>'width:200px; height:20px;', 'label'=>'Ram'));
		echo $this->Form->input('memory_detail', array('style'=>'width:200px; height:20px;', 'label'=>'Ram Details'));


                ?> </td>
                <td> <?php
                echo $this->Form->input('location_id', array('type' => 'select', 'options'=> $locatonDropdown, 'label'=>'Location', 'style'=>'width:205px'));
                echo $this->Form->input('warranty', array('type'=>'text', 'style'=>'width:200px; height:20px;' ));
		echo $this->Form->input('wifi_available', array('type'=>'select', 'options'=>array('Yes'=>'Yes', 'No'=>'No'), 'label'=>'Wifi', 'style'=>'width:205px'));
		//echo $this->Form->input('wifi_works', array('type'=>'select', 'options'=>array('Yes'=>'Working', 'No' => 'Non-Working'), 'label'=>'Wifi Working', 'style'=>'width:205px'));
		echo $this->Form->input('sound', array('type'=>'select', 'options'=>array('OK'=>'Yes', 'No' =>'No'), 'label'=>'Sound', 'style'=>'width:205px'));
		echo $this->Form->input('software_key', array('style'=>'width:200px; height:20px;', 'label'=>'OEM Label'));
		//echo $this->Form->input('custom_charges', array('type'=>'select', 'options'=>array('No'=>'No', 'Yes'=>'Yes'), 'label'=>'Dot', 'style'=>'width:205px'));
		echo $this->Form->input('side_battery', array('type'=>'select', 'options'=>array('DVD+RW' => 'DVD+RW', 'None' => 'None'), 'label'=>'Misc', 'style'=>'width:205px'));
		echo $this->Form->input('main_battery', array('type'=>'select', 'options'=>array('Yes'=>'Working','No'=>'Non-Working'), 'label'=>'Batt Status', 'style'=>'width:205px'));
		echo $this->Form->input('status', array('type'=>'select', 'options'=>array('W' => 'Working', 'U' => 'Used', 'NW' => 'Non-Working'), 'label'=>'System Status', 'style'=>'width:205px'));
                echo $this->Form->input('comment', array('type'=>'textarea', 'style'=>'width:200px; height:80px; font-size:15px;', 'label' => 'Comments'));
		//echo $this->Form->input('created_date');
		//echo $this->Form->input('modified_date');
		//echo $this->Form->input('in_date');
	?>
                </td>
            </tr>
        </table>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>

                <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SystemDetail.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('SystemDetail.id'))); ?></li>
                <li><?php echo $this->Html->link(__('List System Details'), array('action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('List System Allocations'), array('controller' => 'system_allocations', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('New System Allocation'), array('controller' => 'system_allocations', 'action' => 'add')); ?> </li>
        </ul>
</div>-->
<script>
    $(document).ready(function() {
    $(function() {
    $("#SystemDetailWarranty").datepicker({dateFormat:'yy-mm-dd', maxDate:0,
            onSelect: function(dateText, inst){
            console.log(dateText);
            }});
//            $( "#SystemDetailInDate" ).datepicker({dateFormat:'yy-mm-dd', maxDate:0,
//                onSelect: function(dateText, inst){
//                        console.log(dateText);
//            }});
       });

    });
</script>