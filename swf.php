<?php
/**
 * Created by PhpStorm.
 * User: Irokotv
 * Date: 01/09/2015
 * Time: 18:09
 */

require "init.php";

$listOfDomains = $client->listDomains(array(
        // registrationStatus is required
        'registrationStatus' => 'REGISTERED',
        'reverseOrder' => true ,
));

$listOfDomainsArray = $listOfDomains->toArray();

//var_dump($listOfDomains->toArray());
$domainAlreadyExists = false;
foreach($listOfDomainsArray['domainInfos'] as $key => $domainInfo){
    if($domainDetails['name'] == $domainInfo['name']){
        $domainAlreadyExists = true;
    }
}



// Register your domain
if(!$domainAlreadyExists){
    // Register your domain
    $client->registerDomain($domainDetails);
}

$newWorkFlowTypeName = "move-file-on-s3";

//@Todo check if workflow already exists
$workFlowTypeExists = $client->listWorkflowTypes(array(
            // domain is required
            'domain' => $domainDetails['name'],
            'name' => $newWorkFlowTypeName,
            // registrationStatus is required
            'registrationStatus' => 'REGISTERED',
          //  'nextPageToken' => 'string',
          //  'maximumPageSize' => integer,
         //   'reverseOrder' => true || false,
        ));

// Register your workflow
if($workFlowTypeExists && !$workFlowTypeExists->get("typeInfos")){
    $client->registerWorkflowType(array(
        "domain" => $domainDetails['name'],
        "name" => "Move file to S3",
        "version" => "1.0",
        "description" => "this is a  test",
        "defaultTaskList" => array(
            "name" => $taskList
        ),
        "defaultChildPolicy" => "TERMINATE"
    ));
}



$activityName = 'createFile';
// Register an activity
$client->registerActivityType(array(
    "domain" => $domainDetails['name'],
    "name" => $activityName,
    "version" => "1.0",
    "description" => "first activity in our workflow",
    "defaultTaskList" => array(
        "name" => $taskList
    )
));

$activityName = 'deleteFile';
// Register an activity
$client->registerActivityType(array(
    "domain" => $domainDetails['name'],
    "name" => $activityName,
    "version" => "1.0",
    "description" => "second activity in our workflow",
    "defaultTaskList" => array(
        "name" => $taskList
    )
));