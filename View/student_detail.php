<?php
declare(strict_types=1);

use Model\Student;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section class="container">
    <h1 class="text-center mb-5">Student Details</h1>
    <?php /** @var Student $student */?>
    <?php if(!isset($student)):?>
        <div class="alert alert-success my-4 text-center" role="alert">
            The data is deleted!
        </div>
    <?php else: ?>
    <div class="mb-5">
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-danger" name="delete" value="<?= $student->getId() ?>" type="submit">Delete</button>
        </form>
    </div>

    <?php if(isset($errorMessage)): ?>
        <div class='alert alert-success my-4 text-center' role='alert'>
            <?= $errorMessage ?>
        </div>
    <?php else: ?>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Class</th>
                    <th scope="col">Teacher</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="align-middle"><?= $student->getId() ?></th>
                        <td class="align-middle"><?= $student->getFirstName() ?></td>
                        <td class="align-middle"><?= $student->getLastName() ?></td>
                        <td class="align-middle"><?= $student->getEmail() ?></td>
                        <td class="align-middle"><?= $student->getAddress() ?></td>
                        <td class="align-middle"><?php if ($student->getClassId()) {
                                echo "<a href='?page=class&id={$student->getClassId()}'>{$student->getClassName()}</a>";
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td class="align-middle"><?php if ($student->getTeacherId()) {
                                echo "<a href='?page=teacher&id={$student->getTeacherId()}'>{$student->getTeacherFullName()}</a>";
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <a href="?page=student" class="btn btn-primary">Back to overview</a>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
