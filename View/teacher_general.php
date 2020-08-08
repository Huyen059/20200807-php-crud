<?php
declare(strict_types=1);

use Model\TeacherLoader;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
?>

<?php require 'includes/header.php'; ?>

<section  class="container">
        <h1 class="text-center mb-5">Teacher Data</h1>

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
                     * @var TeacherLoader $loader
                     */
                    foreach ($loader->getTeachers() as $teacher):
                        ?>
                        <tr>
                            <th scope="row" class="align-middle">
                                <?php
                                echo $count;
                                $count++;
                                ?>
                            </th>
                            <td class="align-middle"><?= $teacher->getFirstName() ?></td>
                            <td class="align-middle"><?= $teacher->getLastName() ?></td>
                            <td class="align-middle"><?php if ($teacher->getClass() !== null) {
                                    echo "<a href='#'>{$teacher->getClass()->getName()}</a>";
                                } else {
                                    echo "N/A";
                                }
                                ?>
                            </td>
                            <td class="align-middle"><a href="?page=teacher&id=<?php echo $teacher->getId(); ?>" class="btn btn-success">Details</a></td>
                            <td>
                                <form method="post" class="d-flex justify-content-center">
                                    <input type="hidden" name="action" value="update">
                                    <button class="btn btn-warning" name="update" type="submit">Update</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" class="d-flex justify-content-center">
                                    <input type="hidden" name="action" value="delete">
                                    <button class="btn btn-danger" name="delete" type="submit">Delete</button>
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