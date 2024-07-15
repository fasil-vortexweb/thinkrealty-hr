<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employeeId'])) {
    $employeeId = $_POST['employeeId'];

    $employees = include('employees.php');
    $employee = null;

    foreach ($employees as $emp) {
        if ($emp['ufCrm25EmpId'] == $employeeId) {
            $employee = $emp;
            break;
        }
    }

    if ($employee) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Payslip for {$employee['NAME']}</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js'></script>
        </head>
        <body>
            <div class='container my-5'>
                <div id='payslip' class='card'>
                    <div class='card-header text-center'>
                        <img src='https://thinkrealty.ae/wp-content/uploads/2023/10/sideways-logo-think-realty.png.webp' style='background-color: black;' alt='Company Logo' class='img-fluid mb-3' style='max-width: 150px;'>
                        <h1>Think Realty</h1>
                        <p>Office 504, Al Zarouni Business Centre, Sheikh Zayed Road, Al Barsha 1 Dubai, U.A.E.</p>
                    </div>
                    <div class='card-body'>
                        <form>
                            <h4>Employee Details</h4>
                            <div class='form-group'>
                                <label for='employeeId'>Employee ID:</label>
                                <input type='text' class='form-control' id='employeeId' value='{$employee['ufCrm25EmpId']}' disabled>
                            </div>
                            <div class='form-group'>
                                <label for='name'>Name:</label>
                                <input type='text' class='form-control' id='name' value='{$employee['ufCrm25EmpName']}' disabled>
                            </div>
                            <div class='form-group'>
                                <label for='email'>Email:</label>
                                <input type='text' class='form-control' id='email' value='{$employee['ufCrm25EmpEmail']}' disabled>
                            </div>
                            <h4>Salary Details</h4>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <h4>Earnings</h4>
                                    <div class='form-group'>
                                        <label for='basic'>Basic:</label>
                                        <input type='text' class='form-control' id='basic' value='{$employee['ufCrm25Basic']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='da'>DA (40%):</label>
                                        <input type='text' class='form-control' id='da' value='{$employee['ufCrm25Da']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='hra'>HRA (15%):</label>
                                        <input type='text' class='form-control' id='hra' value='{$employee['ufCrm25Hra']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='conveyance'>Conveyance:</label>
                                        <input type='text' class='form-control' id='conveyance' value='{$employee['ufCrm25Conveyance']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='allowance'>Allowance:</label>
                                        <input type='text' class='form-control' id='allowance' value='{$employee['ufCrm25Allowance']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='medicalAllowance'>Medical Allowance:</label>
                                        <input type='text' class='form-control' id='medicalAllowance' value='{$employee['ufCrm25MedicalAllowance']}' disabled>
                                    </div>
                                </div>                            
                                <div class='col-md-6'>
                                    <h4>Deductions</h4>
                                    <div class='form-group'>
                                        <label for='tds'>TDS:</label>
                                        <input type='text' class='form-control' id='tds' value='{$employee['ufCrm25Tds']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='esi'>ESI:</label>
                                        <input type='text' class='form-control' id='esi' value='{$employee['ufCrm25Esi']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='pf'>PF:</label>
                                        <input type='text' class='form-control' id='pf' value='{$employee['ufCrm25Pf']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='leave'>Leave:</label>
                                        <input type='text' class='form-control' id='leave' value='{$employee['ufCrm25Leave']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='profTax'>Prof. Tax:</label>
                                        <input type='text' class='form-control' id='profTax' value='{$employee['ufCrm25ProfTax']}' disabled>
                                    </div>
                                    <div class='form-group'>
                                        <label for='labourWelfare'>Labour Welfare:</label>
                                        <input type='text' class='form-control' id='labourWelfare' value='{$employee['ufCrm25LabourWelfare']}' disabled>
                                    </div>
                                </div>                            
                            </div>
                            <div class='form-group'>
                                <label for='salary'>Net Salary:</label>
                                <input type='text' class='form-control' id='salary' value='{$employee['ufCrm25NetSalary']}' disabled>
                            </div>
                        </form>
                    </div>
                    <div class='card-footer text-center'>
                        <button class='btn btn-primary' onclick='downloadCSV()'>Download CSV</button>
                        <button class='btn btn-secondary' onclick='downloadPDF()'>Download PDF</button>
                    </div>
                </div>
            </div>
            <script>
                function downloadCSV() {
                    const data = [
                        ['ID', 'Name', 'Email', 'Net Salary', 'Basic', 'DA', 'HRA', 'Conveyance', 'Allowance', 'Medical Allowance', 'TDS', 'ESI', 'PF', 'Leave', 'Prof. Tax', 'Labour Welfare'],
                        ['{$employee['ufCrm25EmpId']}', '{$employee['ufCrm25EmpName']}', '{$employee['ufCrm25EmpEmail']}', '{$employee['ufCrm25NetSalary']}', '{$employee['ufCrmBasic']}', '{$employee['ufCrm25Da']}', '{$employee['ufCrm25Hra']}', '{$employee['ufCrm25Conveyance']}', '{$employee['ufCrm25Allowance']}', '{$employee['ufCrm25MedicalAllowance']}', '{$employee['ufCrm25Tds']}', '{$employee['ufCrm25Esi']}', '{$employee['ufCrm25Pf']}', '{$employee['ufCrm25Leave']}', '{$employee['ufCrm25ProfTax']}', '{$employee['ufCrm25LabourWelfare']}'],
                    ];

                    let csvContent = 'data:text/csv;charset=utf-8,';
                    data.forEach(row => {
                        csvContent += row.join(',') + '\\r\\n';
                    });

                    const encodedUri = encodeURI(csvContent);
                    const link = document.createElement('a');
                    link.setAttribute('href', encodedUri);
                    link.setAttribute('download', 'payslip for {$employee['ufCrm25EmpName']}.csv');
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }

                function downloadPDF() {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();
                    
                    doc.setFontSize(18);
                    doc.text('Payslip', 14, 22);
                    doc.setFontSize(12);
                    doc.text('Think Realty', 14, 30);
                    doc.text('Office 504, Al Zarouni Business Centre, Sheikh Zayed Road, Al Barsha 1 Dubai, U.A.E.', 14, 36);
                    
                    doc.setFontSize(14);
                    doc.text('Employee Details', 14, 46);
                    doc.setFontSize(12);
                    doc.text('Employee ID: {$employee['ufCrm25EmpId']}', 14, 54);
                    doc.text('Name: {$employee['ufCrm25EmpName']}', 14, 60);
                    doc.text('Email: {$employee['ufCrm25EmpEmail']}', 14, 66);
                    
                    doc.setFontSize(14);
                    doc.text('Salary Details', 14, 76);
                    doc.setFontSize(12);
                    
                    const earnings = [
                        ['Basic', '{$employee['ufCrm25Basic']}'],
                        ['DA (40%)', '{$employee['ufCrm25Da']}'],
                        ['HRA (15%)', '{$employee['ufCrm25Hra']}'],
                        ['Conveyance', '{$employee['ufCrm25Conveyance']}'],
                        ['Allowance', '{$employee['ufCrm25Allowance']}'],
                        ['Medical Allowance', '{$employee['ufCrm25MedicalAllowance']}']
                    ];
                    const deductions = [
                        ['TDS', '{$employee['ufCrm25Tds']}'],
                        ['ESI', '{$employee['ufCrm25Esi']}'],
                        ['PF', '{$employee['ufCrm25Pf']}'],
                        ['Leave', '{$employee['ufCrm25Leave']}'],
                        ['Prof. Tax', '{$employee['ufCrm25ProfTax']}'],
                        ['Labour Welfare', '{$employee['ufCrm25LabourWelfare']}']
                    ];
                    
                    doc.autoTable({
                        head: [['Earnings', 'Amount']],
                        body: earnings,
                        startY: 80,
                        theme: 'grid'
                    });
                    
                    doc.autoTable({
                        head: [['Deductions', 'Amount']],
                        body: deductions,
                        startY: doc.previousAutoTable.finalY + 10,
                        theme: 'grid'
                    });
                    
                    doc.text('Net Salary: {$employee['ufCrm25NetSalary']}', 14, doc.previousAutoTable.finalY + 20);
                    
                    doc.save('payslip for {$employee['ufCrm25EmpName']}.pdf');
                }
            </script>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Employee Not Found</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='container mt-5'>
                <div class='alert alert-danger'>
                    <strong>Error:</strong> Employee not found.
                </div>
            </div>
        </body>
        </html>";
    }
} else {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Invalid Request</title>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='alert alert-danger'>
                <strong>Error:</strong> Invalid request.
            </div>
        </div>
    </body>
    </html>";
}
