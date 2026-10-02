<?php
require_once 'db_connect.php';
require_once 'validation.php';
$errors = [];
$success = '';
$first_name = $middle_name = $last_name = $email = $birthday = $sex = $student_number = $program = $enrolment_date = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $middle_name = trim($_POST['middle_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $birthday = trim($_POST['birthday'] ?? '');
    $sex = trim($_POST['sex'] ?? '');
    $student_number = trim($_POST['student_number'] ?? '');
    $program = trim($_POST['program'] ?? '');
    $enrolment_date = trim($_POST['enrolment_date'] ?? '');

    $errors = validateStudent(compact('first_name','last_name','email','birthday','sex','student_number','program','enrolment_date'));

    if (!$errors) {
        try {
            $stmt = $conn->prepare('INSERT INTO students
                (id, first_name, middle_name, last_name, birthday, sex, email, student_number, program, enrolment_date)
                VALUES (UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssssssss', $first_name, $middle_name, $last_name, $birthday, $sex, $email, $student_number, $program, $enrolment_date);
            $stmt->execute();
            if ($stmt->affected_rows === 1) {
                $success = 'Student created successfully!';
                $first_name = $middle_name = $last_name = $email = $birthday = $sex = $student_number = $program = $enrolment_date = '';
            }
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            $errors['form'] = 'Could not create student. Email and student number must be unique.';
        }
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Add Student - mysqli</title><link rel="stylesheet" href="style.css"></head>
<body><div class="container"><div class="nav"><h1>Add Student — mysqli</h1><a class="btn btn-secondary" href="index.php">Back</a></div>
<div class="card">
<?php if ($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>
<?php if (!empty($errors['form'])): ?><p class="error"><?= htmlspecialchars($errors['form']) ?></p><?php endif; ?>
<form method="POST">
<div class="grid">
<div class="field"><label>First Name *</label><input name="first_name" value="<?= htmlspecialchars($first_name) ?>"><div class="error"><?= htmlspecialchars($errors['first_name'] ?? '') ?></div></div>
<div class="field"><label>Middle Name</label><input name="middle_name" value="<?= htmlspecialchars($middle_name) ?>"><div class="error"><?= htmlspecialchars($errors['middle_name'] ?? '') ?></div></div>
<div class="field"><label>Last Name *</label><input name="last_name" value="<?= htmlspecialchars($last_name) ?>"><div class="error"><?= htmlspecialchars($errors['last_name'] ?? '') ?></div></div>
<div class="field"><label>Birthday *</label><input type="date" name="birthday" value="<?= htmlspecialchars($birthday) ?>"><div class="error"><?= htmlspecialchars($errors['birthday'] ?? '') ?></div></div>
<div class="field"><label>Sex *</label><select name="sex"><option value="">-- Select --</option><option value="Male" <?= $sex==='Male'?'selected':'' ?>>Male</option><option value="Female" <?= $sex==='Female'?'selected':'' ?>>Female</option></select><div class="error"><?= htmlspecialchars($errors['sex'] ?? '') ?></div></div>
<div class="field"><label>Email *</label><input type="email" name="email" value="<?= htmlspecialchars($email) ?>"><div class="error"><?= htmlspecialchars($errors['email'] ?? '') ?></div></div>
<div class="field"><label>Student Number *</label><input name="student_number" value="<?= htmlspecialchars($student_number) ?>"><div class="error"><?= htmlspecialchars($errors['student_number'] ?? '') ?></div></div>
<div class="field"><label>Program *</label><input name="program" value="<?= htmlspecialchars($program) ?>"><div class="error"><?= htmlspecialchars($errors['program'] ?? '') ?></div></div>
<div class="field"><label>Enrolment Date *</label><input type="date" name="enrolment_date" value="<?= htmlspecialchars($enrolment_date) ?>"><div class="error"><?= htmlspecialchars($errors['enrolment_date'] ?? '') ?></div></div>
</div>

<div><button class="btn btn-primary" type="submit">Create Student</button></div>
</form></div></div></body></html>
<?php $conn->close(); ?>
