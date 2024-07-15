<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm28Name' => $data['newDeductionName'],
        'ufCrm28UnitAmount' => $data['newDeductionUnitAmount'],
    ];

    $result = CRest::call('crm.item.add', [
        'entityTypeId' => 148,
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
