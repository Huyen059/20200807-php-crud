<?php
declare(strict_types=1);

use Model\Student;
use Model\StudentLoader;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section class="container">
    <h1 class="text-center mb-5">Student Data</h1>

    <div class="mb-5">
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="action" value="add">
            <button class="btn btn-primary" name="add" type="submit">Create new</button>
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
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Class</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            /**
             * @var StudentLoader $loader
             */
            foreach ($loader->getStudents() as $student):
            ?>
            <tr>
                <th scope="row" class="align-middle"><?php
                    echo $count;
                    $count++;
                    ?>
                </th>
                <td class="align-middle"><?= $student->getFirstName() ?></td>
                <td class="align-middle"><?= $student->getLastName() ?></td>
                <td class="align-middle"><?php if ($student->getClass() !== null) {
                        echo "<a href='#'>{$student->getClass()->getName()}</a>";
                    } else {
                        echo "N/A";
                    }
                    ?>
                </td>
                <td class="align-middle"><a href="?page=teacher&id=<?php echo $student->getId(); ?>" class="btn btn-success">Details</a></td>
                <td><a href="#" class="btn btn-warning">Update</a></td>
                <td><a href="#" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</section>

<?php require 'includes/footer.php'; ?>
