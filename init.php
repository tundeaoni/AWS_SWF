<?php
/**
 * Created by PhpStorm.
 * User: Irokotv
 * Date: 02/09/2015
 * Time: 14:58
 */

require 'vendor/autoload.php';

$accessKey = 'xxxxx';
$secretKey = 'xxxxx';

$client = new Aws\Swf\SwfClient([
    'version' => 'latest',
    'region'  => 'eu-west-1',
    'key'    => $accessKey,
    'secret' => $secretKey
]);

$domainDetails = array(
    "name" => "Content-test-domain",
    "description" => "this is a test domain",
    "workflowExecutionRetentionPeriodInDays" => "1"
);

$taskList = "shipToS3";