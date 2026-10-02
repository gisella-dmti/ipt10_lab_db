<?php
function validateStudent(array $data): array {
    $errors = [];

    $first = $data['first_name'] ?? '';
    $last = $data['last_name'] ?? '';
    $email = $data['email'] ?? '';
    $birthday = $data['birthday'] ?? '';
    $sex = $data['sex'] ?? '';
    $studentNumber = $data['student_number'] ?? '';
    $program = $data['program'] ?? '';
    $enrolmentDate = $data['enrolment_date'] ?? '';

    if ($first === '' || strlen($first) < 2 || strlen($first) > 100 || !preg_match('/^[A-Za-z\s]+$/', $first)) {
        $errors['first_name'] = 'First name is required, 2-100 characters, letters and spaces only.';
    }
    if ($last === '' || strlen($last) < 2 || strlen($last) > 100 || !preg_match('/^[A-Za-z\s]+$/', $last)) {
        $errors['last_name'] = 'Last name is required, 2-100 characters, letters and spaces only.';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }
    if ($birthday === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)) {
        $errors['birthday'] = 'Birthday is required and must use YYYY-MM-DD format.';
    }
    if (!in_array($sex, ['Male', 'Female'], true)) {
        $errors['sex'] = 'Sex must be exactly Male or Female.';
    }
    if ($studentNumber !== '' && (strlen($studentNumber) > 50 || !preg_match('/^\d{2}-\d{4}-\d{3}$/', $studentNumber))) {
        $errors['student_number'] = 'Student number must be in this format "24-1234-500".';
    }
    if (strlen($program) > 200) {
        $errors['program'] = 'Program must not exceed 200 characters.';
    }
    if ($enrolmentDate === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $enrolmentDate)) {
        $errors['enrolment_date'] = 'Enrolment date is required and must use YYYY-MM-DD format.';
    }

    return $errors;
}
