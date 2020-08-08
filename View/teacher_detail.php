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

    <div class="mb-5">
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-danger" name="delete" type="submit">Delete</button>
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
                    <?php /** @var Teacher $teacher */?>
                    <th scope="row" class="align-middle"><?= $teacher->getId() ?></th>
                    <td class="align-middle"><?= $teacher->getFirstName() ?></td>
                    <td class="align-middle"><?= $teacher->getLastName() ?></td>
                    <td class="align-middle"><?= $teacher->getEmail() ?></td>
                    <td class="align-middle"><?= $teacher->getAddress() ?></td>
                    <td class="align-middle"><?php if ($teacher->getClass() !== null) {
                            echo "<a href='#'>{$teacher->getClass()->getName()}</a>";
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </td>
                    <td class="align-middle"><?php if ($teacher->getClass() !== null) {
                        //Todo: get students and put them here in a list
                            echo "<a href='#'>{$teacher->getClass()->getName()}</a>";
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

    <div class="d-flex justify-content-center">
        <a href="?page=teacher" class="btn btn-primary">Back to overview</a>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
