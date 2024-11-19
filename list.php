<?php
require_once 'models.php';
$applicants = readApplicants()['querySet'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Applicants List</h1>
    <a href="insert.php">Add New Applicant</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Qualifications</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicants as $applicant): ?>
                <tr>
                    <td><?= htmlspecialchars($applicant['first_name'] . ' ' . $applicant['last_name']) ?></td>
                    <td><?= htmlspecialchars($applicant['email']) ?></td>
                    <td><?= htmlspecialchars($applicant['phone']) ?></td>
                    <td><?= htmlspecialchars($applicant['address']) ?></td>
                    <td><?= htmlspecialchars($applicant['qualifications']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $applicant['id'] ?>">Edit</a>
                        <form method="post" action="handleForms.php" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $applicant['id'] ?>">
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
