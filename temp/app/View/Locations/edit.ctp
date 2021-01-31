<div class="locations form">
<?php echo $this->Form->create('Location'); ?>
	<fieldset>
		<legend><?php echo __('Edit Location'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('location_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
