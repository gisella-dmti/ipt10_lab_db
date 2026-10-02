# IPT10 Lab - Basic DB Programming

This repository contains the two required versions of the student-record CRUD application:

- `ipt10 lab/` — procedural/object-oriented `mysqli`
- `ipt10 lab pdo/` — PDO
- `schema.sql` — database and sample records

## Requirements

- XAMPP with Apache, MySQL, and PHP 8.2+
- A browser
- phpMyAdmin
- PHP extensions `mysqli` and `pdo_mysql`

## 1. XAMPP setup

Start **Apache** and **MySQL** from the XAMPP Control Panel.

Open `php.ini` from the Apache/PHP configuration and make sure these extensions are enabled:

```ini
extension=mysqli
extension=pdo_mysql
```

Restart Apache after changing `php.ini`.

To verify, visit:

`http://localhost/phpinfo.php`

Search for `mysqli` and `PDO`.

## 2. Create the database

Open phpMyAdmin and select the SQL tab. Copy and run `schema.sql`.

It creates:

- Database: `ip10_lab`
- Table: `students`
- UUID primary key
- Required fields and constraints
- Three sample student records

## 3. Copy the project to XAMPP

Copy this repository into:

`C:\xampp\htdocs\`

The resulting paths should be:

`C:\xampp\htdocs\ipt10 lab\`

`C:\xampp\htdocs\ipt10 lab pdo\`

Because the folder names contain spaces, use the URLs exactly as shown below.

## 4. Run the mysqli version

Open:

`http://localhost/ipt10%20lab/index.php`

Test:

1. List students
2. View a student
3. Create a student
4. Edit a student
5. Delete a student
6. Submit invalid form values and verify the red validation messages

## 5. Run the PDO version

Open:

`http://localhost/ipt10%20lab%20pdo/index.php`

Repeat the same CRUD and validation tests.

## Database credentials

The lab's supplied configuration uses:

- Host: `127.0.0.1`
- User: `root`
- Password: empty
- Database: `ip10_lab`

If your XAMPP MySQL installation uses a password, update the local configuration files accordingly. Do not commit real credentials.

## UUID note

The `students.id` column is `CHAR(36)` and is generated with `UUID()`. Do not cast the ID from the URL to an integer. The activity specifically requires binding UUID values as strings.

## PDO transaction note

The PDO configuration follows the activity's requirement to disable MySQL autocommit. Therefore, the create, edit, and delete operations explicitly call `commit()` after successful writes and `rollBack()` on failure.

## Validation

The application validates the required server-side rules from the laboratory document:

- First and last name: required, 2-100 characters, letters/spaces
- Email: valid email
- Birthday: `YYYY-MM-DD`
- Sex: `Male` or `Female`
- Student number: optional, alphanumeric, maximum 50 characters
- Program: optional, maximum 200 characters
- Enrolment date: `YYYY-MM-DD`

Output is escaped with `htmlspecialchars()`.

## GitHub

The required repository name from the laboratory document is:

`ipt10-lab-db`

Do not upload screenshots containing private information or real passwords.
