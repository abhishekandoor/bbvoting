<?php
$old_password = array(
    'name' => 'old_password',
    'id' => 'old_password',
    'value' => set_value('old_password'),
    'class' => "form-control",
    'size' => 30,
);
$new_password = array(
    'name' => 'new_password',
    'id' => 'new_password',
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'class' => "form-control",
    'size' => 30,
    'onkeyup'=>'checkPasswordStrength()'
);
$confirm_new_password = array(
    'name' => 'confirm_new_password',
    'id' => 'confirm_new_password',
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'class' => "form-control",
    'size' => 30,
);
?>
<section class="content-header">
    <h1>
        Settings
        <small>Change Password</small>
    </h1>

</section>
<hr/>
<div class="content_view">
    <div class="col-lg-6">
        <?php echo form_open($this->uri->uri_string()); ?>
        <table class="table table-responsive">
            <tr>
                <td><?php echo form_label('Old Password', $old_password['id']); ?></td>
                <td><?php echo form_password($old_password); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="color: red;"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']]) ? $errors[$old_password['name']] : ''; ?></td>
            </tr>
            <tr>
                <td><?php echo form_label('New Password', $new_password['id']); ?></td>
                <td><?php echo form_password($new_password); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']]) ? $errors[$new_password['name']] : ''; ?><p id="password-strength-status"></p></td>
            </tr>
            <tr>
                <td><?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?></td>
                <td><?php echo form_password($confirm_new_password); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']]) ? $errors[$confirm_new_password['name']] : ''; ?></td>
            </tr>
        </table>
        <div class="row text-center">
        <?php echo form_close(); ?>
        <?php echo form_submit('change', 'Change Password', 'class="btn btn-primary"'); ?>
        </div>
    </div>
</div>
<script>
function checkPasswordStrength() {
var number = /([0-9])/;
var alphabets = /([a-zA-Z])/;
if($('#new_password').val().length<6) {
$('#password-strength-status').removeClass();
$('#password-strength-status').addClass('alert-danger');
$('#password-strength-status').html("Weak (should be atleast 8 characters.)");
} else {  	
if($('#new_password').val().match(number) && $('#new_password').val().match(alphabets) ) {            
$('#password-strength-status').removeClass();
$('#password-strength-status').addClass('alert-success');
$('#password-strength-status').html("Strong");
} else {
$('#password-strength-status').removeClass();
$('#password-strength-status').addClass('alert-danger');
$('#password-strength-status').html("Medium (should include alphabets, numbers .)");
}}}
   </script>

