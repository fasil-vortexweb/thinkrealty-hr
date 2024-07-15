<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $result = CRest::call('crm.item.delete', [
        'entityTypeId' => 148,
        'id' => $data['deleteDeductionId']
    ]);

    header('Location: ../payroll.php');
}
