<div style="float:left;"><img src="img/procentris.gif"></div>
<div style="padding-top:30px; font-size:12px; margin-left:110px"><b>Inventory Management System</h4></div>

<?php echo $this->Form->create('User'); ?>
    <fieldset class="inventory">
        <legend><?php if(isset($error)){ echo $error; }?></legend>
        <?php
        echo $this->Form->input('username', array('label' => 'Username', 'class' => 'required'));
        echo $this->Form->input('password');
    ?>
    </fieldset>
<div style="margin-left: 168px">
<?php echo $this->Form->end(__('Login')); ?>

</div>