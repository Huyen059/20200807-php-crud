<?php
declare(strict_types=1);

use Model\LearningClass;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section class="container">
    <?php /** @var LearningClass $class */?>

    <h1 class="text-center mb-5">Class Details</h1>

    <?php if(!isset($class)):?>
    <div class="alert alert-success my-4 text-center" role="alert">
        The data is deleted!
    </div>
    <?php else: ?>
    <div class="mb-5">
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-danger" name="delete" value="<?= $class->getId() ?>" type="submit">Delete</button>
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
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">Students</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"><?= $class->getId() ?></th>
                    <td><?= $class->getName() ?></td>
                    <td><?= $class->getAddress() ?></td>
                    <td><?php if($class->getTeacherId()){
                            echo "<a href='?page=teacher&id={$class->getTeacherId()}'>{$class->getTeacherFullName()}</a>";
                        } else {
                            echo "N/A";
                        }
                        ?>
                    </td>
                    <td><?php if ($class->getStudents()) {
                        echo "<ul>";
                        foreach ($class->getStudents() as $studentId => $studentFullName) {
                            echo "<li><a href='?page=student&id={$studentId}'>{$studentFullName}</a></li>";
                        }
                        echo "</ul>";
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
        <a href="?page=class" class="btn btn-primary">Back to overview</a>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
