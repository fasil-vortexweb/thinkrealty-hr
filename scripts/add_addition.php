<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm26Name' => $data['newAdditionName'],
        'ufCrm26Category' => $data['newAdditionCategory'],
        'ufCrm26UnitAmount' => $data['newAdditionUnitAmount'],
    ];

    $result = CRest::call('crm.item.add', [
        'entityTypeId' => 153,
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
