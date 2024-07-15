<?php
require_once(__DIR__ . '/crest/crest.php');

$result = CRest::call('crm.item.list', [
  'entityTypeId' => 153,
]);

$additions = $result['result']['items'];

// print_r($additions);

return $additions;
