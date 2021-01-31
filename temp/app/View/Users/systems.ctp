<div class="user systems">
     <h2><?php echo __('System Allocated Details'); ?></h2>
<table cellpadding="0" cellspacing="0">
        <tr>
            <th>System Tag No</th>
            <th>User Name</th>
            <th>From</th>
            <th>To</th>
        </tr>
        <?php
        foreach ($systemAllocations as $key => $systemAllocation) :?>
            <tr>
                <td><?php echo h($systemAllocation['SystemDetail']['tag_no']); ?>&nbsp;</td>
                <td><?php echo h($systemAllocation['User']['name']); ?>&nbsp;</td>
                <td><?php echo h($systemAllocation['SystemAllocation']['assigned_date']); ?>&nbsp;</td>
                <td><?php if(!empty($systemAllocation['SystemAllocation']['unassigned_date'])) echo h($systemAllocation['SystemAllocation']['unassigned_date']); else echo "Till Present";?>&nbsp;</td>
            </tr>
        <?php endforeach; ?>
</table>
</div>
