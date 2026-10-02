<?php
require_once 'config.php';
$sql = 'SELECT id, first_name, last_name, email, enrolment_date
        FROM students
        ORDER BY enrolment_date DESC, id DESC';
$rows = $pdo->query($sql)->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Students - PDO</title><link rel="stylesheet" href="style.css"></head>
<body><div class="container">
<div class="nav"><h1>Student Records — PDO</h1><a class="btn btn-primary" href="create.php">Add Student</a></div>
<div class="panel"><table><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Enrolled</th><th>Actions</th></tr></thead><tbody>
<?php foreach ($rows as $row): ?>
<tr><td class="muted"><?= htmlspecialchars($row['id']) ?></td>
<td><?= htmlspecialchars($row['first_name'].' '.$row['last_name']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['enrolment_date']) ?></td>
<td class="actions">
<a class="btn btn-primary" href="view.php?id=<?= urlencode($row['id']) ?>">View</a>
<a class="btn btn-secondary" href="edit.php?id=<?= urlencode($row['id']) ?>">Edit</a>
<a class="btn btn-danger" href="delete.php?id=<?= urlencode($row['id']) ?>">Delete</a>
</td></tr>
<?php endforeach; ?>
</tbody></table></div></div></body></html>
