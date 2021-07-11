<?php
require('../../init.php');
$title = 'Category';
if (!isset($_SESSION['user'])) {
back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။','../login.php');
}
## For search Paginate Set Cookie
if (empty($_POST['search'])) {
    if (empty($_GET['pageno'])) {
        unset($_COOKIE['search']);
        setcookie('search', null, -1, '/');
    }
} else {
    setcookie('search', $_POST['search'], time() + (8600 * 30), "/");
}

## End
require('../layout/header.php');
?>

<div class="app-main__inner">
    <!-- Leading -->
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Category
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Category List</div>
                <div class="card-body">
                    <p>
                        <a href="<?php echo BASE_URL; ?>admin/category/create.php" class="btn btn-success">create category</a>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_GET["pageno"])) {
                                $pageno = $_GET["pageno"];
                            } else {
                                $pageno = 1;
                            }
                            $numOfrecord = 3;
                            $offset = ($pageno - 1) * $numOfrecord;

                            if (empty($_POST["search"]) && empty($_COOKIE['search'])) {
                                $rawCategories = getAll("SELECT * FROM categories ORDER BY id DESC");
                                $total_pages = ceil(count($rawCategories) / $numOfrecord);
                                $categories = getAll("SELECT * FROM categories ORDER BY id DESC LIMIT $offset,$numOfrecord ");
                            } else {
                                $searchKey = empty($_POST['search']) ? $_COOKIE['search'] : $_POST['search'];
                                $rawCategories = getAll("SELECT * FROM categories WHERE name LIKE '%$searchKey%' ORDER BY id DESC");
                                $total_pages = ceil(count($rawCategories) / $numOfrecord);
                                $categories = getAll("SELECT * FROM categories  WHERE name LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecord ");
                            }
                            if ($categories) {
                                $i = 1;
                                foreach ($categories as $category) {
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo escape($category['name']); ?></td>
                                        <td><?php echo escape(substr($category['description'], 0, 50)); ?></td>
                                        <td>
                                            <span class="mr-3">
                                                <i class="pe-7s-date mr-1"></i>
                                                <?php echo date_format(date_create($category['create_at']), "d F Y "); ?>
                                            </span>
                                            <span>
                                                <i class="pe-7s-clock mr-1"></i>
                                                <?php echo date_format(date_create($category['create_at']), " h:i:a"); ?>
                                            </span>
                                        </td>
                                        <td class='text-center'>
                                            <a href="edit.php?slug=<?php echo $category['slug']; ?>" class="btn btn-primary mr-2">Edit</a>
                                            <button onclick="deleteCat('<?php echo $category['slug']; ?>')" class="btn btn-danger ">Delete</button>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>

                    </table>
                    <p>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mt-3">
                            <!-- First -->
                            <li class="page-item ">
                                <a class="page-link" href="?pageno=1">First</a>
                            </li>
                            <li class="page-item <?php echo $pageno <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?php echo $pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1); ?>">
                                    Previous
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                            <li class="page-item <?php echo $pageno >= $total_pages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="<?php echo $pageno >= $total_pages ? '#' : '?pageno=' . ($pageno + 1);  ?>">
                                    Next
                                </a>
                            </li>
                            <!-- last -->
                            <li class="page-item">
                                <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
                            </li>
                        </ul>
                    </nav>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require('../layout/footer.php') ?>
<script>
    function deleteCat(slug) {

        Swal.fire({
            title: 'Are you sure delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            reverseButtons: true,
            confirmButtonText: 'Confirm',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            preConfirm: () => {
                $.get(`delete.php?slug=${slug}`)
            },
        }).then(res => {
            if(res.isConfirmed){
                location.reload();
            }
        })

    }
</script>

</body>

</html>