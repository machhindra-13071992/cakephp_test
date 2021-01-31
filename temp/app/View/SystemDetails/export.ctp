<div class="systemDetails export">
    <fieldset>
    <legend><?php echo __('Locations'); ?></legend>
    <span id="showError"></span>
<?php echo $this->Form->create('Export', array('onsubmit' => 'return checkBoxValidate()')); ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Location Name</th>
            <th>Select</th>
        </tr>

	<?php foreach ($locations as $location): ?>
        <tr>
            <td><?php echo h($location['Location']['location_name']); ?>&nbsp;</td>
            <td><?php echo $this->Form->checkbox('checkboxList', array('hiddenField' => false, 'class' => 'checkboxList', 'value' => $location['Location']['id'], 'name' => 'locationData[]' )); ?>&nbsp;</td>
        </tr>
<?php endforeach; ?>
        <tr><td><b>Select All</b></td><td><?php echo $this->Form->checkbox('checkboxAll', array('hiddenField' => false, 'id' => 'selectAll')); ?>&nbsp;</td></tr>

    </table>
    <?php echo $this->Form->end(__('Export')); ?>
    </fieldset>
</div>
<script>
    $(document).ready(function() {
        $('#selectAll').click(function(event) {  //on click
            if (this.checked) { // check select status
                $('.checkboxList').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkboxList"
                    $(this).prop('disabled', true);
                });
            } else {
                $('.checkboxList').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkboxList"
                    $(this).prop('disabled', false);
                });
            }
        });

    });
    function checkBoxValidate() {
        var n = $(".checkboxList:checked").length;
        if ($('#selectAll').is(':checked')) {
//            var total = $(".checkboxList").length;
//            if (total != n) {
//                $('#showError').text('Select all CheckBox').css("color","red");
//
//                return false;
//            }
//            else {
//                return true;
//            }
            $('.checkboxList').each(function() { //loop through each checkbox
//                this.checked = true; //deselect all checkboxes with class "checkboxList"
                $(this).prop('disabled', false);
            });
            return true;
        } else {
            if (n == 0) {
                $('#showError').text('Select atleast 1 CheckBox').css("color", "red");
                return false;
            } else {
                return true;
            }
        }

    }
</script>

