<?php
require('../../init.php');
$title = 'User';
if (!isset($_SESSION['user'])) {
    back('errorModal', 'Account Login ဝင်ရန်လိုအပ်ပါသည်။', '..//login.php');
   // echo "<script>window.location.href='../login.php'</script>";
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
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Users
                </div>
            </div>

        </div>
    </div>
    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">User List</div>
                <div class="card-body">
                   
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
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
                                $rawCategories = getAll("SELECT * FROM users ORDER BY id DESC");
                                $total_pages = ceil(count($rawCategories) / $numOfrecord);
                                $categories = getAll("SELECT * FROM users ORDER BY id DESC LIMIT $offset,$numOfrecord ");
                            } else {
                                $searchKey = empty($_POST['search']) ? $_COOKIE['search'] : $_POST['search'];
                                $rawCategories = getAll("SELECT * FROM users WHERE name LIKE '%$searchKey%' ORDER BY id DESC");
                                $total_pages = ceil(count($rawCategories) / $numOfrecord);
                                $categories = getAll("SELECT * FROM users  WHERE name LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecord ");
                            }
                            if ($categories) {
                                $i = 1;
                                foreach ($categories as $category) {
                            ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo escape($category['name']); ?></td>
                                        <td><?php echo escape(substr($category['email'], 0, 50)); ?></td>
                                        <td><?php echo $category['role'] == 1 ? "<span class='badge badge-success'>Admin</span>" : "<span class='badge badge-info'>User</span>"; ?></td>
                                        <td><?php echo $category['phone']; ?></td>
                                        <td><?php echo $category['address']; ?></td>

                                        <td >
                                            <?php
                                               if($category['role'] == 0 || $category['email'] == $_SESSION['user']->email){
                                            ?>
                                               <a href="edit.php?id=<?php echo $category['id']; ?>" class="btn btn-primary mr-2">Edit</a>
                                            <?php } ?>

                                            <?php if($category['role'] != 1){ ?>
                                            <button onclick="deleteCat('<?php echo $category['id']; ?>')" class="btn btn-danger ">Delete</button>
                                            <?php } ?>
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
    function deleteCat(id) {

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
                $.get(`delete.php?id=${id}`)
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