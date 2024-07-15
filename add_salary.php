<?php
require_once(__DIR__ . '/crest/crest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    print_r($data);


    $result = CRest::call('user.get', [
        'ID' => $data['employeeId'],
    ]);

    $user = $result['result'][0];

    $fields = [
        'ufCrm25EmpName' => $user['NAME'],
        'ufCrm25EmpId' => $user['ID'],
        'ufCrm25EmpEmail' => $user['EMAIL'],
        'ufCrm25NetSalary' => $data['employeeSalary'],
        'ufCrm25Basic' => $data['basic'],
        'ufCrm25Tds' => $data['tds'],
        'ufCrm25Da' => $data['da'],
        'ufCrm25Esi' => $data['esi'],
        'ufCrm25Hra' => $data['hra'],
        'ufCrm25Pf' => $data['pf'],
        'ufCrm25Conveyance' => $data['conveyance'],
        'ufCrm25Leave' => $data['leave'],
        'ufCrm25Allowance' => $data['allowance'],
        'ufCrm25ProfTax' => $data['profTax'],
        'ufCrm25MedicalAllowance' => $data['medical'],
        'ufCrm25LabourWelfare' => $data['labourWelfare'],
    ];

    $result = CRest::call('crm.item.add', [
        'entityTypeId' => 171,
        'fields' => $fields
    ]);

    if ($result['result']) {
        echo 'success';
        header('Location: employee_salary.php');
    }
}
