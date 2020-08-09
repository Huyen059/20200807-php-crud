<?php
declare(strict_types=1);

use Model\Teacher;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section class="container">
    <h1 class="text-center mb-5">Teacher Details</h1>
    <?php /** @var Teacher $teacher */?>
    <?php if(!isset($teacher)):?>
        <div class="alert alert-success my-4 text-center" role="alert">
            The data is deleted!
        </div>
    <?php else: ?>
    <div class="mb-5">
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-danger" name="delete" value="<?= $teacher->getId() ?>" type="submit">Delete</button>
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
                    <th scope="col">Students</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"><?= $teacher->getId() ?></th>
                    <td><?= $teacher->getFirstName() ?></td>
                    <td><?= $teacher->getLastName() ?></td>
                    <td><?= $teacher->getEmail() ?></td>
                    <td><?= $teacher->getAddress() ?></td>
                    <td><?php if ($teacher->getClassId()) {
                            echo "<a href='?page=class&id={$teacher->getClassId()}'>{$teacher->getClassName()}</a>";
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </td>
                    <td><?php if ($students) {
                            echo "<ol>";
                            foreach ($students as $studentId => $studentFullName) {
                                echo "<li class='align-middle'><a href='?page=student&id={$studentId}'>{$studentFullName}</a></li>";
                            }
                            echo "</ol>";
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
        <a href="?page=teacher" class="btn btn-primary">Back to overview</a>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
