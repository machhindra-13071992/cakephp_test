<!-- File: /app/View/Employees/index.ctp -->
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<div class="users index">
    <div class="ajaxDiv" align="right">
        <form id="optionForm" style="margin-right:0;">
            <input name="searchbox" placeholder="Search by User Name" type="text" id="searchbox">
            <?php echo $this->Html->link('Reset', array('action' => 'index')); ?>
            <?php  echo $this->Form->end('Search');?>
        </form>
    </div>
    <div id="searchContent"></div>
</div>
<div class="users">
<h1>Employees</h1>
<p><?php echo $this->Html->link('Add Employee', array('action' => 'add')); ?>
<table>
    <tr>
        <th>Id</th>
        <th><?php echo $this->Paginator->sort('name', 'Name');?></th>
        <th><?php echo $this->Paginator->sort('email', 'Email');?></th>
        <th><?php echo $this->Paginator->sort('phone', 'Phone');?></th>
        <th><?php echo $this->Paginator->sort('dob', 'DOB');?></th>
        <th><?php echo $this->Paginator->sort('User.username', 'Employee Image');?></th>
        <th><?php echo $this->Paginator->sort('created', 'Created');?></th>
        <th><?php echo $this->Paginator->sort('modified','Last Update');?></th>
        <th>Actions</th>
    </tr>
    <?php foreach ($employees as $Employee): ?>
    <tr>
        <td><?php echo $Employee['Employee']['id']; ?></td>
        <td>
            <?php
              $Employeedata = substr($Employee['Employee']['name'], 0, 30);
                echo $this->Html->link(
                    $Employeedata,
                    array('action' => 'edit', $Employee['Employee']['id'])
                );
            ?>
        </td>
        <td><?php echo $Employee['Employee']['email']; ?></td>
        <td><?php echo $Employee['Employee']['phone']; ?></td>
        <td><?php echo $Employee['Employee']['dob']; ?></td>
        <td><?php if(!empty($Employee['Employee']['image_file'])){?><input type="image" src="<?php echo $this->webroot; ?>upload/<?php echo $Employee['Employee']['image_file'] ;?>" style="padding-bottom: 0px; height: 49px; width: 104px;" id="thumbnail<?php echo $Employee['Employee']['id']; ?>" class="thumbnail"/> <?php }?></td>
        <div id="large"></div> 
        <td><?php echo $this->Time->niceShort($Employee['Employee']['created']); ?></td>
        <td><?php echo $this->Time->niceShort($Employee['Employee']['modified']); ?></td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete',$Employee['Employee']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $Employee['Employee']['id'])
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
<?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?>
<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>