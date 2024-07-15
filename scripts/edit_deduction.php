<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm28Name' => $data['editDeductionName'],
        'ufCrm28UnitAmount' => $data['editDeductionUnitAmount'],
    ];

    $result = CRest::call('crm.item.update', [
        'entityTypeId' => 148,
        'id' => $data['editDeductionId'],
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
