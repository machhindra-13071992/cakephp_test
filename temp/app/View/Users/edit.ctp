<div class="users form">

<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Edit User'); ?></legend>
        <table>
                    <tr>
                        <td>
        <?php
        echo $this->Form->input('name', array('style'=>'width:200px; height:20px;'));
        //echo $this->Form->input('username', array('style'=>'width:200px; height:20px;'));
        echo $this->Form->input('id');
        echo $this->Form->input('email', array('style'=>'width:200px; height:20px;'));
        echo $this->Form->input('department', array('type'=>'select', 'options'=>array('Admin' => 'Admin', 'HR' => 'HR', 'ITS' => 'ITS', 'Producers' => 'Producers', 'Testers' => 'Testers'), 'label'=>'Departement', 'style'=>'width:205px'));
        echo $this->Form->input('status',array('type'=>'select', 'options'=>array('1' => 'Employee', '0' => 'Ex-Employee' ), 'style'=>'width:205px; height:20px;'));
        echo $this->Form->end(__('Submit'));
?>
                            </td>
                    </tr>
        </table>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>