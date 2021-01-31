<div class="systemDetails view">
<h2><?php echo __('System Detail'); ?></h2>
	<dl>
<!--		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['id']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Tag ID'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['tag_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Serial No.'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['serial_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Part No.'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['part_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Processor'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['processor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('High Resolution'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['high_resolution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('HDD'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['hard_disk']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ram'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['memory']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ram Details'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['memory_detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warranty'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['warranty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wifi'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['wifi_available']); ?>
			&nbsp;
		</dd>
<!--		<dt><?php echo __('Wifi Works'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['wifi_works']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Sound'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['sound']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OEM Label'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['software_key']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Misc'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['side_battery']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Batt Status'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['main_battery']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['status']); ?>
			&nbsp;
		</dd>
<!--		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['created_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified Date'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['modified_date']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('In Date'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['in_date']); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($systemDetail['SystemDetail']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
<br clear="all"><br clear="all">
<h2><?php echo __('System Allocated to'); ?></h2>
<table cellpadding="0" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>From</th>
            <th>To</th>
        </tr>
        <?php
        foreach ($systemAllocations as $key => $systemAllocation) :?>
            <tr>
                <td><?php echo h($systemAllocation['User']['name']); ?>&nbsp;</td>
                <td><?php echo h($systemAllocation['SystemAllocation']['assigned_date']); ?>&nbsp;</td>
                <td><?php if(!empty($systemAllocation['SystemAllocation']['unassigned_date'])) echo h($systemAllocation['SystemAllocation']['unassigned_date']); else echo "Till Present";?>&nbsp;</td>
            </tr>
        <?php endforeach; ?>
</table>
</div>
