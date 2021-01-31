<div class="systemDetails index">
    <h2><?php echo __('User List'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
<!--            <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>-->
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('username', 'User Name'); ?></th>
<!--            <th><?php echo $this->Paginator->sort('password', 'Password'); ?></th>-->
            <th><?php echo $this->Paginator->sort('email'); ?></th>
           <th><?php echo $this->Paginator->sort('System'); ?></th>
          <!--   <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th><?php echo $this->Paginator->sort('status'); ?></th>-->
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($userList as $systemDetail):
            if($systemDetail['User']['username'] != 'admin'):?>
            <tr>
<!--                <td><?php echo h($systemDetail['User']['id']); ?>&nbsp;</td>-->
                <td><?php echo h($systemDetail['User']['name']); ?>&nbsp;</td>
                <td><?php echo h($systemDetail['User']['username']); ?>&nbsp;</td>
<!--                <td><?php echo h($systemDetail['User']['password']); ?>&nbsp;</td>-->
                <td><?php echo h($systemDetail['User']['email']); ?>&nbsp;</td>
                <td><?php // echo h($systemDetail['User']['role']); ?>&nbsp;</td>
               <!-- <td><?php echo h($systemDetail['User']['created']); ?>&nbsp;</td>
                <td><?php echo h($systemDetail['User']['modified']); ?>&nbsp;</td>
                <td><?php echo h($systemDetail['User']['status']); ?>&nbsp;</td>-->

                <td class="actions">

                    <?php //echo $this->Html->link(__('View'), array('action' => 'view', $systemDetail['User']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $systemDetail['User']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $systemDetail['User']['id']), array(), __('Are you sure you want to delete "%s" User?', $systemDetail['User']['name'])); ?>
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
</div>
