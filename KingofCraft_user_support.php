<?php

add_action('register_form', 'KingofCraft_register_form');

function KingofCraft_register_form() {
  ?>
  <h3>Register for King of Craft!</h3>
  <p>
  
    <label for="firstname">First name</label>
    <input type="text" name="firstname" id="firstname" class="input" size="25"/><br>
    
  </p>
  
<?php
}

add_filter('registration_errors', 'KingofCraft_registration_validate', 10, 3);

function KingofCraft_registration_validate($errors, $sanitized_user_login, $user_email) {
  
  if (! isset($_POST['firstname']) || trim($_POST['firstname'] == false)) {
    $errors->add('firstname_error', '<strong>ERROR</strong>: You must include a first name.');
  }
  return $errors;
}

add_action('user_register', 'KingofCraft_user_register');

function KingofCraft_user_register($user_id) {
  if(isset($_POST['netID'])) {
    update_user_meta($user_id, 'first_name', $_POST['firstname']);
  }
}

function get_current_user_name($current_user){
  $key = 'first_name';
  $single = true;
  $firstname = get_user_meta($current_user->ID, $key, $single);
  return ($firstname);
}
