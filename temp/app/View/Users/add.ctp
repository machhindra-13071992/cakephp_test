<div class="users form">

<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <table>
                    <tr>
                        <td>
                            <?php //echo $this->Form->input('username');
                                echo $this->Form->input('id');
                                echo $this->Form->input('name');
                                echo $this->Form->input('email');
                                echo $this->Form->input('department', array('type'=>'select', 'options'=>array('Admin' => 'Admin', 'HR' => 'HR', 'ITS' => 'ITS', 'Producers' => 'Producers', 'Testers' => 'Testers'), 'label'=>'Departement', 'style'=>'width:205px'));
                                echo $this->Form->end(__('Submit'));
                            ?>
                        </td>
                    </tr>
        </table>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
