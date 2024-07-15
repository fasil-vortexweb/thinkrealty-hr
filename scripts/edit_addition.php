<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm26Name' => $data['editAdditionName'],
        'ufCrm26Category' => $data['editAdditionCategory'],
        'ufCrm26UnitAmount' => $data['editAdditionUnitAmount'],
    ];

    $result = CRest::call('crm.item.update', [
        'entityTypeId' => 153,
        'id' => $data['editAdditionId'],
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
