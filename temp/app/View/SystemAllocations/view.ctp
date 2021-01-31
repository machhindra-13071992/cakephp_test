<div class="systemAllocations view">
<h2><?php echo __('System Allocation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($systemAllocation['SystemAllocation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('System Detail'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemAllocation['SystemDetail']['id'], array('controller' => 'system_details', 'action' => 'view', $systemAllocation['SystemDetail']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemAllocation['User']['id'], array('controller' => 'users', 'action' => 'view', $systemAllocation['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($systemAllocation['Location']['id'], array('controller' => 'locations', 'action' => 'view', $systemAllocation['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assigned Date'); ?></dt>
		<dd>
			<?php echo h($systemAllocation['SystemAllocation']['assigned_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unassigned Date'); ?></dt>
		<dd>
			<?php echo h($systemAllocation['SystemAllocation']['unassigned_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($systemAllocation['SystemAllocation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($systemAllocation['SystemAllocation']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($systemAllocation['SystemAllocation']['comments']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit System Allocation'), array('action' => 'edit', $systemAllocation['SystemAllocation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete System Allocation'), array('action' => 'delete', $systemAllocation['SystemAllocation']['id']), array(), __('Are you sure you want to delete # %s?', $systemAllocation['SystemAllocation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List System Allocations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New System Allocation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List System Details'), array('controller' => 'system_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New System Detail'), array('controller' => 'system_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
