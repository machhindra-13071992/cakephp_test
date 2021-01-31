<div class="systemAllocations index">
	<h2><?php echo __('System Allocations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('system_detail_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('assigned_date'); ?></th>
			<th><?php echo $this->Paginator->sort('unassigned_date'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($systemAllocations as $systemAllocation): ?>
	<tr>
		<td><?php echo h($systemAllocation['SystemAllocation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($systemAllocation['SystemDetail']['id'], array('controller' => 'system_details', 'action' => 'view', $systemAllocation['SystemDetail']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($systemAllocation['User']['id'], array('controller' => 'users', 'action' => 'view', $systemAllocation['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($systemAllocation['Location']['id'], array('controller' => 'locations', 'action' => 'view', $systemAllocation['Location']['id'])); ?>
		</td>
		<td><?php echo h($systemAllocation['SystemAllocation']['assigned_date']); ?>&nbsp;</td>
		<td><?php echo h($systemAllocation['SystemAllocation']['unassigned_date']); ?>&nbsp;</td>
		<td><?php echo h($systemAllocation['SystemAllocation']['created']); ?>&nbsp;</td>
		<td><?php echo h($systemAllocation['SystemAllocation']['updated']); ?>&nbsp;</td>
		<td><?php echo h($systemAllocation['SystemAllocation']['comments']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $systemAllocation['SystemAllocation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $systemAllocation['SystemAllocation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $systemAllocation['SystemAllocation']['id']), array(), __('Are you sure you want to delete # %s?', $systemAllocation['SystemAllocation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New System Allocation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List System Details'), array('controller' => 'system_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New System Detail'), array('controller' => 'system_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
