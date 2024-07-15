<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $fields = [
        'ufCrm27Name' => $data['editOvertimeName'],
        'ufCrm27Category' => $data['editOvertimeCategory'],
        'ufCrm27Rate' => $data['editOvertimeRate'],
    ];

    $result = CRest::call('crm.item.update', [
        'entityTypeId' => 154,
        'id' => $data['editOvertimeId'],
        'fields' => $fields
    ]);

    if ($result['result']) {
        header('Location: ../payroll.php#overtime');
    }
}
