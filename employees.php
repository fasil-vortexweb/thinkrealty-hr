<?php
require_once(__DIR__ . '/crest/crest.php');

$result = CRest::call('crm.item.list', [
    'entityTypeId' => 171,
]);


$employees = $result['result']['items'];

// print_r($employees);

return $employees;
