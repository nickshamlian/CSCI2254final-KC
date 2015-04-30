<?php

add_action('register_form', 'KingofCraft_register_form');

function KingofCraft_register_form() {
  ?>
  <h3>Register for King of Craft!</h3>
  <p>
  
    <label for="firstname">First name</label>
    <input type="text" name="firstname" id="firstname" class="input" size="25"/>
    
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="input" size="25"/>
    
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="input" size="25"/>
    
  </p>
<?php
}

add_action('user_register', 'KingofCraft_user_register');

function KingofCraft_user_register($user_id) {
  if(isset($_POST['netID'])) {
    $pw=sha1($_POST['password']);
    update_user_meta($user_id, 'username', $_POST['username']);
    update_user_meta($user_id, 'password', $pw);
  }
}

function get_username($current_user){
  $key = 'username';
  $single = true;
  $username = get_user_meta($current_user->username, $key, $single)
}

function get_user_pw($current_user){
  $key = 'password';
  $single = true;
  $user_pw = get_user_meta($current_user->pw, $key, $single);
  return($user_pw);
}

function get_firstname($current_user){
  $key = 'firstname';
  $single = true;
  $username = get_user_meta($current_user->firstname, $key, $single)
}
