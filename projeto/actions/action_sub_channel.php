<?php

    include_once('../includes/incl_session.php');
    include_once('../database/db_channels.php');

    $user = $_POST['user'];
    $channel = $_POST['channel'];

    try {
      subTo($user, $channel);
      $_SESSION['messages'][] = array('type' => 'success', 'content' => "Subscribed to channel $channel");
      header("Location: ../pages/channel_page.php?channel=$channel");
    } catch (PDOException $e) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => "Unable to subscribe to channel $channel");
      die(header("Location: ../pages/channel_page.php?channel=$channel"));
    }
?>