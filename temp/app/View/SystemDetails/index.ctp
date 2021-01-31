<div class="systemDetails index">
    <fieldset>
		<legend><?php echo __('System Details'); ?></legend>

    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('tag_no', 'Tag ID'); ?></th>
            <th><?php echo $this->Paginator->sort('model'); ?></th>
            <th><?php echo 'User'; ?></th>
            <th><?php echo $this->Paginator->sort('serial_no', 'Serial No.'); ?></th>
            <th><?php echo $this->Paginator->sort('part_no', 'Part No.'); ?></th>
            <th><?php echo $this->Paginator->sort('processor'); ?></th>
            <th><?php echo $this->Paginator->sort('hard_disk', 'HDD'); ?></th>
            <th><?php echo $this->Paginator->sort('memory', 'Ram'); ?></th>
            <th><?php echo $this->Paginator->sort('memory_detail', 'Ram Details'); ?></th>
            <th><?php echo $this->Paginator->sort('wifi_available', 'Wifi'); ?></th>

            <th><?php echo $this->Paginator->sort('status'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($systemDetails as $systemDetail): ?>
        <tr>
            <td><?php echo h($systemDetail['SystemDetail']['tag_no']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['model']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['usename']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['serial_no']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['part_no']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['processor']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['hard_disk']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['memory']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['memory_detail']); ?>&nbsp;</td>
            <td><?php echo h($systemDetail['SystemDetail']['wifi_available']); ?>&nbsp;</td>

            <td><?php echo h($systemDetail['SystemDetail']['status']); ?>&nbsp;</td>
            <td class="actions">
                    <?php
                        if($systemDetail['SystemDetail']['status'] == 'U') {
                            echo $this->Html->link(__('Unassign'), array('action' => 'free', $systemDetail['SystemDetail']['id']));
                        } else if($systemDetail['SystemDetail']['status'] == 'W') {
                            echo $this->Html->link(__('AssignTo'), array('action' => 'allocate', $systemDetail['SystemDetail']['id']));
                        }
                     ?>
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $systemDetail['SystemDetail']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $systemDetail['SystemDetail']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $systemDetail['SystemDetail']['id']), array(), __('Are you sure you want to delete "%s" machine?', $systemDetail['SystemDetail']['tag_no'])); ?>
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
   </fieldset>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        currpath = window.location.pathname;
        if ((currpath.indexOf("search")) == '-1') {
            $("#searchForm").attr({"action": "<?php echo $this->Html->url(array('controller' => 'SystemDetails', 'action' => 'search'), true);?>", "onSubmit": "return validate()"});
        } else {
            $("#searchForm").attr({"action": "<?php echo $this->Html->url(array('controller' => 'SystemDetails', 'action' => 'search'), true);?>", "onSubmit": "return validate()"});
        }
        $("#searchForm").show();
        $('#globalSearch').focus(function() {
            $("#globalSearch").attr("placeholder", "Search...");
        });
    });
    function validate() {
        if (($('#globalSearch').val().length) < 3) {
            $("#globalSearch").val("");
            $("#globalSearch").attr("placeholder", "Minimum 3 characters required");
            return false;
        }
        else {
            return true;
        }
    }
</script>
