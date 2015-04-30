<?php

add_action('register_form', 'KingofCraft_register_form');

function KingofCraft_register_form() {
  ?>
  <h3>Register for King of Craft!</h3>
  <p>
  
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="input" size="25"/>
    
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="input" size="25"/>
    
    <label for="type">Membership Type</label>
    <?php createmenu("memtype", array("guest", "member")); ?>
    
  </p>
<?php
}

function createmenu($name, $option) {
  echo "<select name=\"$name\">";
  foreach($option as $opt){
    echo "<option value=\"$opt\">$opt</option>";
  }
  echo "</select>";
}

add_action('user_register', 'KingofCraft_user_register');

function KingofCraft_user_register($user_id) {
  if(isset($_POST['netID'])) {
    $pw=sha1($_POST['password']);
    update_user_meta($user_id, 'username', $_POST['username']);
    update_user_meta($user_id, 'KC_role', $_POST['memtype']);
    update_user_meta($user_id, 'password', $pw);
  }
}

function is_user_guest($current_user){
  $key = 'KC_role';
  $single = true;
  $user_role = get_user_meta($current_user->ID, $key, $single);
  return($user_role=='guest');
}

function is_user_member($current_user){
  $key = 'KC_role';
  $single = true;
  $user_role = get_user_meta($current_user->ID, $key, $single);
  return($user_role=='member');
}

function get_user_pw($current_user){
  $key = 'password';
  $single = true;
  $user_pw = get_user_meta($current_user->pw, $key, $single);
  return($user_pw);
}
