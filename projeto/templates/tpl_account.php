<?php function draw_sidebar($subbed_channels) {
?>
  <section id="sidebar" >
    <?php
      draw_sidebar_login();
      draw_sidebar_subs($subbed_channels);
      draw_sidebar_messages();
    ?>
  </section>
<?php } ?>

<?php 
    function draw_sidebar_login() { 

  if (isset($_SESSION['username']))
  { 
    $username = $_SESSION['username'];?>
    <section id="sidebar_login" class="blockStyle">
      <?php $igmsrc = getUserImage($username);?>
        <img  id="userImage"  src=<?=$igmsrc?> width=40 height="40">
        <a href="../pages/edit_profile.php?user=<?= $username ?>"><?= $username ?></a>
        <div><a href="../actions/action_logout.php">Logout</a></div>

    </section>
  <?php }
  else
  { ?>
    <section id="sidebar_login" class = "blockStyle sidebar_notlogged">
        <form method="post" action="../actions/action_login.php">
        <input type="text" name="username" placeholder="username" class="inputField" required>
        <input type="password" name="password" placeholder="password" class="inputField" required>
        <input type="submit" value="Login" >
        <div><a href="../pages/signup.php?message=">Signup</a></div>
        </form>

    </section>
    <?php }
} ?>

<?php function draw_sidebar_subs($subbed_channels) { ?>
    <section id="sidebar_subs" class= "blockStyle">
    <?php if (isset($_SESSION['username'])) {?>
      <a href="../pages/subfeed.php">Subscribed Channels</a>
    <?php } else {?>
      <h1>Subscribed Channels</h1>
    <?php } ?>
      <ul>
        <?php
          if (isset($_SESSION['username']) && !empty($subbed_channels)) {
            foreach($subbed_channels as $subbed_channel) { ?>
              <li data-channel=<?= $subbed_channel['channel'] ?>>
                <a href="../pages/channel_page.php?channel=<?= $subbed_channel['channel'] ?>"><?= $subbed_channel['channel'] ?></a>
              </li>
        <?php }
          }
        ?>
      </ul>

    </section>
<?php 
} ?>

<?php function draw_login($message) { 
/**
 * Draws the login section.
 */ ?>
  <section id="login" class= "blockStyle blockLayout page">

      <h1>Insert your account credentials.</h1>
      <h2><?= $message ?></h2>

    <form method="post" action="../actions/action_login.php">
      <input type="text" name="username" placeholder="username" class="inputField" required>
      <input type="password" name="password" placeholder="password" class="inputField" required>
      <input type="submit" value="Login">
    </form>

    <footer>
      <p>Don't have an account? <a href="signup.php?message=">Signup!</a></p>
    </footer>

  </section>
<?php } ?>

<?php function draw_signup($message) { 
/**
 * Draws the signup section.
 */ ?>
  <section id="signup" class= "blockStyle blockLayout page">

      <h1>Create an account today!</h1>
      <?php if($message !== "") {?>
      <h2><?= $message ?></h2>
      <?php }?>

    <form method="post" action="../actions/action_signup.php">
      <input type="text" name="username" placeholder="username" autocomplete="new-username" class="inputField" required>
      <input type="password" name="password" placeholder="password" autocomplete="new-password" class="inputField"  required>
      <input type="password" name="repeat_password" placeholder="repeat password" autocomplete="new-repeat_password" class="inputField" required>
      <input type="submit" value="Signup">
    </form>

    <footer>
      <p>Already have an account? <a href="login.php?message=">Login!</a></p>
    </footer>

  </section>
<?php } ?>

<?php
function getUserImage($username){
  if(file_exists("../img/users/originals/$username.png")){
   $img = "../img/users/originals/$username.png";
  }else  $img = "../img/unknownuser.png";   
  return $img;
}?>

<?php
function getTrackImage($username){
  if(file_exists("../img/stories/originals/$username.png")){
   $img = "../img/stories/originals/$username.png";
  }else  $img = "../img/templatetrackcover.png";   
  return $img;
}?>

<?php
function draw_sidebar_messages() {
  if(isset($_SESSION['messages'])) { ?>
      <section class="messages">
        <?php foreach($_SESSION['messages'] as $message) { ?>
          <div class="<?=$message['type']?>">
            <?php if ($message['type'] == 'error') { ?>
              <i class="fas fa-exclamation"></i>
            <?php } else { ?>
              <i class="fas fa-check"></i>
            <?php } ?>
            <h2><?=$message['content']?></h2> 
          </div>
        <?php } ?>
      </section>
    <?php unset($_SESSION['messages']); 
  }
} ?> 