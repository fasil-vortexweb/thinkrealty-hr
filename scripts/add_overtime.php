<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm27Name' => $data['newOvertimeName'],
        'ufCrm27Category' => $data['newOvertimeCategory'],
        'ufCrm27Rate' => $data['newOvertimeRate'],
    ];

    $result = CRest::call('crm.item.add', [
        'entityTypeId' => 154,
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php');
    }
}
