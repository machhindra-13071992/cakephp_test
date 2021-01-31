<div class="systemDetails index">
    <fieldset>
    <legend><?php echo __('Users List'); ?></legend>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('department', 'Department'); ?></th>
            <th><?php echo 'System'; ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($users as $user):
            if($user['User']['username'] != 'admin'):?>
        <tr>
            <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['department']); ?>&nbsp;</td>
            <td><?php
                    if($user['allocation'] > 0){
                        echo $this->Html->link(__(h($user['allocation'])), array('action' => 'systems', $user['User']['id']));
                    } else {
                        echo h($user['allocation']); }?>&nbsp;</td>
            <td class="actions">

                    <?php //echo $this->Html->link(__('View'), array('action' => 'view', $systemDetail['User']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
                    <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete "%s" User?', $user['User']['name'])); ?>
            </td>
        </tr>
        <?php endif; endforeach; ?>
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
            $("#searchForm").attr({"action": "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'search'), true);?>", "onSubmit": "return validate()"});
        } else {
            $("#searchForm").attr({"action": "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'search'), true);?>", "onSubmit": "return validate()"});
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