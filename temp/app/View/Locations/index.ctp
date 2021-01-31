<div class="locations index">
    <fieldset>
    <legend><?php echo __('Locations'); ?></legend>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('location_name'); ?></th>
            <th>System</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
	<?php foreach ($locations as $location): ?>
        <tr>
            <td><?php echo h($location['Location']['location_name']); ?>&nbsp;</td>
            <td><a style="text-decoration:none" href="SystemDetails/filter/location:<?php echo $location['Location']['id']; ?>" target="_blank"><?php echo h($systemByLocations[$location['Location']['id']]); ?></a>&nbsp;</td>
            <td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $location['Location']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $location['Location']['id']), array(), __('Are you sure you want to delete # %s?', $location['Location']['id'])); ?>
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
            $("#searchForm").attr({"action": "<?php echo $this->Html->url(array('controller' => 'Locations', 'action' => 'search'), true);?>", "onSubmit": "return validate()"});
        } else {
            $("#searchForm").attr({"action": "<?php echo $this->Html->url(array('controller' => 'Locations', 'action' => 'search'), true);?>", "onSubmit": "return validate()"});
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
