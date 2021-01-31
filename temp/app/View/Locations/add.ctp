<div class="locations form">
<?php echo $this->Form->create('Location'); ?>
	<fieldset>
		<legend><?php echo __('Add Location'); ?></legend>
	<?php
		echo $this->Form->input('location_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
