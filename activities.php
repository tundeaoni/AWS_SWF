<?php
/**
 * Created by PhpStorm.
 * User: Irokotv
 * Date: 02/09/2015
 * Time: 14:58
 */

require "init.php";


// Check with SWF for activities
$result = $client->pollForActivityTask(array(
    "domain" => $domainDetails["name"],
    "taskList" => array(
        "name" => $taskList
    )
));

// Take out task token from the response above
$task_token = $result["taskToken"];

var_dump($task_token); exit;

// Do things on the computer that this script is saved on
exec("my program i want to execute");

// Tell SWF that we finished what we need to do on this node
$client->respondActivityTaskCompleted(array(
    "taskToken" => $task_token,
    "result" => "I've finished!"
));
