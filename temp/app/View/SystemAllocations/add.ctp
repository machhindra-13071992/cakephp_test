<div class="systemAllocations form">
    <?php echo $this->Form->create('SystemAllocation'); ?>
    <fieldset>
        <legend><?php echo __('Add System Allocation'); ?></legend>
        <?php
        echo $this->Form->input('system_detail_id');
        echo $this->Form->input('user_id');
        
        echo $this->Form->input('assigned_date');
        echo $this->Form->input('unassigned_date');
        echo $this->Form->input('comments');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List System Allocations'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List System Details'), array('controller' => 'system_details', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New System Detail'), array('controller' => 'system_details', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
    </ul>
</div>
