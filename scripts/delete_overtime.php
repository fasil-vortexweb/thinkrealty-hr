<?php
require_once('../crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $result = CRest::call('crm.item.delete', [
        'entityTypeId' => 154,
        'id' => $data['deleteOvertimeId']
    ]);

    header('Location: ../payroll.php');
}
