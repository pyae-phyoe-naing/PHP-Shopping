<?php
require('../../init.php');
$title = 'Product';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', '../login.php');
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
                    <i class="pe-7s-next-2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Product
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Product List</div>
                <div class="card-body">
                    <p>
                        <a href="<?php echo BASE_URL; ?>admin/product/create.php" class="btn btn-success">create product</a>
                    </p>
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Photo</th>
                                <th>Description</th>
                                <th>In Stock</th>
                                <th>Price</th>
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
                                $rawResult = getAll("SELECT * FROM products ORDER BY id DESC");
                                $total_pages = ceil(count($rawResult) / $numOfrecord);
                                $result = getAll("SELECT * FROM products ORDER BY id DESC LIMIT $offset,$numOfrecord ");
                            } else {
                                $searchKey = empty($_POST['search']) ? $_COOKIE['search'] : $_POST['search'];
                                $rawResult = getAll("SELECT * FROM products WHERE name LIKE '%$searchKey%' or description LIKE '%$searchKey%' ORDER BY id DESC");
                                $total_pages = ceil(count($rawResult) / $numOfrecord);
                                $result = getAll("SELECT * FROM products  WHERE name LIKE '%$searchKey%' or description LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecord ");
                            }
                            if ($result) {
                                $i = 1;
                                foreach ($result as $value) {

                                    ## Get category join   
                                    $cat = getSingle('select * from categories where id=?', [$value['category_id']]);
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo escape($value['name']); ?></td>
                                        <td><?php echo escape($cat->name); ?></td>
                                        <td>
                                            <img src="<?php echo BASE_URL . 'admin/assets/images/products/' . $value['image']; ?>" width="50" height="50">
                                        </td>
                                        <td><?php echo escape(substr($value['description'], 0, 30)); ?></td>
                                        <td><?php echo escape($value['quantity']); ?></td>
                                        <td><?php echo escape($value['price']); ?></td>
                                        <td>
                                            <span class="mr-3">
                                                <i class="pe-7s-date mr-1"></i>
                                                <?php echo date_format(date_create($value['created_at']), "d F Y "); ?>
                                            </span>
                                            <br>
                                            <span>
                                                <i class="pe-7s-clock mr-1"></i>
                                                <?php echo date_format(date_create($value['created_at']), " h:i:a"); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit.php?slug=<?php echo $value['slug']; ?>" class="btn btn-primary mr-2">Edit</a>
                                            <button onclick="deleteCat('<?php echo $value['slug']; ?>')" class="btn btn-danger ">Delete</button>
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
            if (res.isConfirmed) {
                location.reload();
            }
        })

    }
</script>

</body>

</html>