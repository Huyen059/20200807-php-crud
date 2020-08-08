<?php
declare(strict_types=1);

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
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
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
                <td class="align-middle"><?php if ($student->getClassId()) {
                        echo "<a href='?page=class&id={$student->getClassId()}'>{$student->getClassName()}</a>";
                    } else {
                        echo "N/A";
                    }
                    ?>
                </td>
                <td class="align-middle"><a href="?page=student&id=<?php echo $student->getId(); ?>" class="btn btn-success">Details</a></td>
                <td>
                    <form method="post" class="d-flex justify-content-center">
                        <input type="hidden" name="action" value="update">
                        <button class="btn btn-warning" name="update" value="<?php echo $student->getId(); ?>" type="submit">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post" class="d-flex justify-content-center">
                        <input type="hidden" name="action" value="delete">
                        <button class="btn btn-danger" name="delete" value="<?php echo $student->getId(); ?>" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</section>

<?php require 'includes/footer.php'; ?>
