<link rel="stylesheet" href="../js/themes/base/jquery.ui.all.css">
<?php
echo $this->Html->script('jquery.ui.core');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->script('check_tagno');
?>
<div class="systemDetails form">
<?php echo $this->Form->create('SystemDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add System Detail'); ?></legend>
                <table>
                    <tr>
                        <td>
                            <?php
                                echo $this->Form->input('tag_no', array('style'=>'width:200px; height:20px;'));
                            //    echo $this->Form->input('tag_no_error', array('style'=>'width:200px; height:20px;','type'=>'hidden'));
                                echo $this->Form->input('model', array('style'=>'width:200px; height:20px;'));
                                echo $this->Form->input('serial_no', array('style'=>'width:200px; height:20px; text-transform: uppercase;'));
                               // echo $this->Form->input('serial_no_error', array('style'=>'width:200px; height:20px; text-transform: uppercase;','type'=>'hidden'));
                                echo $this->Form->input('part_no', array('style'=>'width:200px; height:20px; text-transform: uppercase;'));
                                echo $this->Form->input('processor', array('style'=>'width:200px; height:20px;'));
                                echo $this->Form->input('high_resolution', array('type'=>'select', 'options'=>array('Yes', 'No'), 'label'=>'High Resolution', 'style'=>'width:205px'));
                                echo $this->Form->input('hard_disk', array('style'=>'width:200px; height:20px;', 'label'=>'HDD'));
                                echo $this->Form->input('memory', array('style'=>'width:200px; height:20px;', 'label'=>'Ram'));
                                echo $this->Form->input('memory_detail', array('style'=>'width:200px; height:20px;', 'label'=>'Ram Details'));
                                echo $this->Form->input('warranty', array('type'=>'text', 'style'=>'width:200px; height:20px;'));


                            ?>

                        </td>
                        <td>
                            <?php
                                echo $this->Form->input('location_id', array('type' => 'select', 'options'=> $locatonDropdown, 'label'=>'Location', 'style'=>'width:205px'));
                                echo $this->Form->input('wifi_available', array('type'=>'select', 'options'=>array('Yes', 'No'), 'label'=>'Wifi', 'style'=>'width:205px'));
                                //echo $this->Form->input('wifi_works', array('type'=>'select', 'options'=>array('Yes'=>'Working', 'No' => 'Non-Working'), 'label'=>'Wifi Working', 'style'=>'width:205px'));
                                echo $this->Form->input('sound', array('type'=>'select', 'options'=>array('OK'=>'Yes', '' =>'No'), 'label'=>'Sound', 'style'=>'width:205px'));
                                echo $this->Form->input('software_key', array('style'=>'width:200px; height:20px; text-transform: uppercase;', 'label'=>'OEM Label'));
                                //echo $this->Form->input('custom_charges', array('type'=>'select', 'options'=>array('No', 'Yes'), 'label'=>'Dot', 'style'=>'width:205px'));
                                echo $this->Form->input('side_battery', array('type'=>'select', 'options'=>array('DVD+RW' => 'DVD+RW', '' => 'None'), 'label'=>'Misc', 'style'=>'width:205px'));
                                echo $this->Form->input('main_battery', array('type'=>'select', 'options'=>array('Working','Non-Working'), 'label'=>'Batt Status', 'style'=>'width:205px'));
                                echo $this->Form->input('status', array('type'=>'select', 'options'=>array('W' => 'Working', 'U' => 'Used', 'NW' => 'Non-Working'), 'label'=>'System Status', 'style'=>'width:205px'));
                                echo $this->Form->input('in_date', array('type'=>'text', 'style'=>'width:200px; height:20px;', 'value' => date("d-m-Y")));
                                echo $this->Form->input('comment', array('type'=>'textarea', 'style'=>'width:200px; height:80px; font-size:15px;', 'label' => 'Comments'));

                            ?>
                        </td>
                    </tr>
                </table>
	<?php
//		echo $this->Form->input('tag_no', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('model', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('serial_no', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('part_no', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('processor', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('high_resolution', array('type'=>'select', 'options'=>array('Yes', 'No'), 'label'=>'High Resolution', 'empty'=>'Select High Resolution'));
//		echo $this->Form->input('hard_disk', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('memory', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('memory_detail', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('warranty', array('type'=>'text', 'style'=>'width:200px; height:20px;', 'value' => date("d-m-Y")));
//		echo $this->Form->input('wifi_available', array('type'=>'select', 'options'=>array('Yes', 'No'), 'label'=>'Wifi Available', 'style'=>'width:200px'));
//		echo $this->Form->input('wifi_works', array('type'=>'select', 'options'=>array('Yes'=>'Working', 'No' => 'Not-Working'), 'label'=>'Wifi Working', 'style'=>'width:200px'));
//		echo $this->Form->input('sound', array('type'=>'select', 'options'=>array('OK'=>'Yes', '' =>'No'), 'label'=>'Sound', 'style'=>'width:200px'));
//		echo $this->Form->input('software_key', array('style'=>'width:200px; height:20px;'));
//		echo $this->Form->input('custom_charges', array('type'=>'select', 'options'=>array('Yes', 'No'), 'label'=>'Custom Charges', 'style'=>'width:200px'));
//		echo $this->Form->input('side_battery', array('type'=>'select', 'options'=>array('Y' => 'Yes'), 'label'=>'Side Battery', 'style'=>'width:200px'));
//		echo $this->Form->input('main_battery', array('type'=>'select', 'options'=>array('Working'), 'label'=>'Main Batt Status', 'style'=>'width:200px'));
//		echo $this->Form->input('status', array('type'=>'select', 'options'=>array('W' => 'Working', 'U' => 'Used', 'NW' => 'Non-Working'), 'label'=>'System Status', 'style'=>'width:200px'));
//		echo $this->Form->input('in_date', array('type'=>'text', 'style'=>'width:200px; height:20px;', 'value' => date("d-m-Y")));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script>
    $( document ).ready(function() {
        $(function() {
            $( "#SystemDetailWarranty" ).datepicker({dateFormat:'yy-mm-dd',
                onSelect: function(dateText, inst){
                        console.log(dateText);
            }});

            $( "#SystemDetailInDate" ).datepicker({dateFormat:'yy-mm-dd',
                onSelect: function(dateText, inst){
                        console.log(dateText);
            }});
        });

    });
   
</script>