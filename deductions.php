<?php
require_once(__DIR__ . '/crest/crest.php');

$result = CRest::call('crm.item.list', [
  'entityTypeId' => 148,
]);

$deductions = $result['result']['items'];

// print_r($deductions);

return $deductions;
