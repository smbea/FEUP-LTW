<?php
  
  include('../database/db_connection.php');

  /**
   * Returns a story 
   */
  function getStory($story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE id = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }

  function getStoryInChannel($channel) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM stories WHERE channel = ?');
    $stmt->execute(array($story));
    return $stmt->fetch(); 
  }

  /**
   * Returns a story's comments 
   */
  function getComments($story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM comments WHERE story_id = ?');
    $stmt->execute(array($story));
    return $stmt->fetchAll(); 
  }

  /**
   * Vote on a story (0 - downvote; 1 - upvote)
   */
  function voteStory($user, $story, $action) {
    global $db;
    $stmt = $db->prepare('INSERT INTO vote VALUES (NULL, ?, ?, ?, NULL)');
    $stmt->execute(array($action, $user, $story));
  }

  /**
   * Changes a vote on a particular story
   */
  function changeVoteStory($user, $story) {
    global $db;
    $stmt = $db->prepare('UPDATE vote SET [type] = 1 - [type] WHERE author = ?
                          AND story_id = ?');
    $stmt->execute(array($user, $story));
  }

  /**
   * Remove a vote from a story
   */
  function removeVoteStory($user, $story) {
    global $db;
    $stmt = $db->prepare('DELETE FROM vote WHERE author = ?
                          AND story_id = ?');
    $stmt->execute(array($user, $story));
  }

  /**
   * Check if user has voted on a story
   */
  function hasUserVotedStory($user, $story) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM vote WHERE author = ?
                          AND story_id = ?');
    $stmt->execute(array($user, $story));
    return $stmt->fetch();
  }

?>