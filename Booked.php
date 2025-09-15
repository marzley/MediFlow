<?php
// Database connection
$servername = "localhost";
$username   = "root";
$password   = ""; // no password as you said
$dbname     = "MEDIC";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointments
$sql = "SELECT * FROM appointments ORDER BY appointment_date DESC, appointment_time ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booked Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: linear-gradient(120deg, #e0f7fa 0%, #f4f4f4 100%);
            min-height: 100vh;
        }
        h2 {
            text-align: center;
            color: #007BFF;
            margin-top: 30px;
            letter-spacing: 1px;
        }
        table {
            width: 95%;
            margin: 30px auto 0 auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px 0 rgba(31,38,135,0.09);
            overflow: hidden;
        }
        th, td {
            border: none;
            padding: 14px 12px;
            text-align: left;
        }
        th {
            background: #007BFF;
            color: white;
            font-size: 1.1em;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #e3f2fd;
            transition: background 0.2s;
        }
        .action-btns {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }
        .btn-action {
            border: none;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 0.95em;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            outline: none;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .btn-approve {
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
        }
        .btn-approve:hover {
            background: linear-gradient(90deg, #38f9d7 0%, #43e97b 100%);
            transform: translateY(-2px) scale(1.04);
        }
        .btn-cancel {
            background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
        }
        .btn-cancel:hover {
            background: linear-gradient(90deg, #f09819 0%, #ff5858 100%);
            transform: translateY(-2px) scale(1.04);
        }
        .btn-edit {
            background: linear-gradient(90deg, #56ccf2 0%, #2f80ed 100%);
            color: #fff;
        }
        .btn-edit:hover {
            background: linear-gradient(90deg, #2f80ed 0%, #56ccf2 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.04);
        }
        .main-nav {
            display: flex;
            gap: 24px;
            background: #fff;
            padding: 18px 32px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.07);
            margin: 24px auto 32px auto;
            max-width: 700px;
            justify-content: center;
            align-items: center;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #007BFF;
            text-decoration: none;
            font-size: 1.08em;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 6px;
            transition: background 0.18s, color 0.18s, transform 0.18s;
        }
        .nav-link i {
            font-size: 1.1em;
        }
        .nav-link:hover, .nav-link.active {
            background: linear-gradient(90deg, #e0f7fa 0%, #b2ebf2 100%);
            color: #0056b3;
            transform: translateY(-2px) scale(1.04);
        }
        @media (max-width: 700px) {
            table, thead, tbody, th, td, tr { display: block; }
            th, td { padding: 10px 6px; }
            tr { margin-bottom: 15px; }
            .action-btns { justify-content: flex-start; }
        }
    </style>
</head>
<body>

<nav class="main-nav">
    <a href="index.html" class="nav-link"><i class="fas fa-home"></i> Home</a>
    <a href="services.html" class="nav-link"><i class="fas fa-stethoscope"></i> Services</a>
    <a href="Booked.php" class="nav-link"><i class="fas fa-calendar-check"></i> Appointments</a>
    <a href="about.html" class="nav-link"><i class="fas fa-users"></i> About Us</a>
</nav>

<h2>Booked Appointments</h2>

<table>
    <tr>
        <th>Patient Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <div class="action-btns">
                        <form style="display:inline;" method="post" action="approve.php">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                            <button type="submit" class="btn-action btn-approve" title="Approve">
                                <span>&#10003;</span> Approve
                            </button>
                        </form>
                        <form style="display:inline;" method="post" action="cancel.php">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                            <button type="submit" class="btn-action btn-cancel" title="Cancel">
                                <span>&#10006;</span> Cancel
                            </button>
                        </form>
                        <form style="display:inline;" method="get" action="edit.php">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                            <button type="submit" class="btn-action btn-edit" title="Edit">
                                <span>&#9998;</span> Edit
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" style="text-align:center;">No appointments found.</td>
        </tr>
    <?php endif; ?>

</table>
        <!-- Centered Print + Download Buttons -->
<div style="text-align: center; margin: 20px 0;">
    <button id="printBtn" style="padding: 10px 25px; background-color: #4CAF50; color:white; border:none; border-radius:5px; cursor:pointer; font-size:16px; margin-right:10px;">
        Print
    </button>
    <button id="downloadCSVBtn" style="padding: 10px 25px; background-color: #2196F3; color:white; border:none; border-radius:5px; cursor:pointer; font-size:16px;">
        Download Excell
    </button>
</div>

<script>
// PRINT BUTTON (as before)
document.getElementById('printBtn').addEventListener('click', () => {
    const table = document.querySelector('table');
    let filteredTable = '<table style="width:100%;border-collapse:collapse;"><tr>';

    // Headers excluding Actions column
    const headers = Array.from(table.querySelectorAll('th'));
    headers.forEach((th, index) => {
        if (index !== 6) { // Skip Actions
            filteredTable += `<th style="padding:10px;border:1px solid #ccc;background:#007BFF;color:white;">${th.innerText}</th>`;
        }
    });
    filteredTable += '</tr>';

    // Rows
    table.querySelectorAll('tr').forEach((tr, rowIndex) => {
        if(rowIndex === 0) return; // skip header
        filteredTable += '<tr>';
        const tds = Array.from(tr.querySelectorAll('td'));
        tds.forEach((td, index) => {
            if (index !== 6) { // Skip Actions
                filteredTable += `<td style="padding:10px;border:1px solid #ccc;">${td.innerText}</td>`;
            }
        });
        filteredTable += '</tr>';
    });
    filteredTable += '</table>';

    const newWindow = window.open('', '', 'height=600,width=800');
    newWindow.document.write('<html><head><title>Appointments</title></head><body>');
    newWindow.document.write(filteredTable);
    newWindow.document.write('</body></html>');
    newWindow.document.close();
    newWindow.print();
});

// DIRECT CSV DOWNLOAD
document.getElementById('downloadCSVBtn').addEventListener('click', () => {
    const table = document.querySelector('table');
    let csvContent = '';

    table.querySelectorAll('tr').forEach((tr, rowIndex) => {
        if(rowIndex === 0) {
            // Headers (exclude Actions)
            const headers = Array.from(tr.querySelectorAll('th')).filter((_, i) => i !== 6);
            csvContent += headers.map(th => `"${th.innerText.trim()}"`).join(',') + '\n';
        } else {
            // Data rows (exclude Actions)
            const cells = Array.from(tr.querySelectorAll('td')).filter((_, i) => i !== 6);
            csvContent += cells.map(td => `"${td.innerText.trim()}"`).join(',') + '\n';
        }
    });

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'appointments.csv';
    link.click();
});
</script>

</body>
</html>

<?php $conn->close(); ?>
