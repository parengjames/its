<style>
    #btn {
        font-size: 14px;
        font-weight: bold;
        border: 1px solid #4B49AC;
        border-radius: 8px;
        padding: 10px 10px;
    }

    ul {
        list-style-type: none;
    }

    ul li {
        float: inline-start;
    }

    #icon_button i {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        font-size: 18px;
    }
</style>

<!-- datatables  -->
<link rel="stylesheet" href="vendors/DataTables/jquery.dataTables.min.css">
<link rel="stylesheet" href="vendors/DataTables/datatables.min.css">
<script src="vendors/DataTables/jquery-3.7.0.js"></script>
<script src="vendors/DataTables/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Manage Students</h3>
                            </div>
                            <div class="col-12 col-xl-4">
                                <div class="justify-content-end d-flex">
                                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        <a id="btn" class="btn btn-light" title="Create account for student" data-toggle="modal" data-target="#AddModal"><i style="font-size: 13px;" class="ti-user"></i> create account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: -15px;" class="table-responsive">
                        <table class="table table-hover" id="studentTable">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">
                                        No.
                                    </th>
                                    <th style="width: 170px;">
                                        Name
                                    </th>
                                    <th style="width: 120px;">
                                        Username
                                    </th>
                                    <th>
                                        Email address
                                    </th>
                                    <th style="width: 200px;">
                                        Birthdate
                                    </th>
                                    <th style="width: 70px;">
                                        Age
                                    </th>
                                    <th style="width: 95px;">
                                        Gender
                                    </th>
                                    <th style="width: 190px;">
                                        Status
                                    </th>
                                    <th style="width: 100px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- FETCHING DATA FROM DATABASE "USER DATA".................... -->
                                <?php
                                $sqlquery = mysqli_query($con, "SELECT * FROM `users` WHERE role = 2");
                                $number = 1;
                                $sqlquery_result = mysqli_num_rows($sqlquery);
                                if ($sqlquery_result > 0) {
                                    while ($row = mysqli_fetch_assoc($sqlquery)) {
                                        $datebirth = date("m-d-Y", strtotime($row['Birthday']));
                                        $_user_id = $row['user_id'];
                                ?>
                                        <tr>
                                            <td><?php echo $number++ ?></td>
                                            <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['email_address'] ?></td>
                                            <td><?php echo date("M jS, Y", strtotime($row['Birthday'])) ?></td>
                                            <td><?php echo $row['age'] ?></td>
                                            <td><?php echo $row['gender'] ?></td>
                                            <td class="font-weight-medium">
                                                <?php
                                                if ($row['user_status'] == "Approved") {
                                                ?>
                                                    <div class="badge badge-success">Approved</div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="badge badge-warning">Pending</div>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button data-whatever="<?php echo $_user_id ?>" id="icon_button" type="button" title="Change status" data-toggle="modal" data-target="#statusmodal" class="btn btn-rounded btn-outline-info btn-icon">
                                                    <i class="ti-check-box"></i>
                                                </button>
                                                <button data-whatever="<?php echo $row['user_id'] ?>" data-email="<?php echo $row['email_address'] ?>" data-role="<?php echo $row['role'] ?>" data-birthdate="<?php echo $row['Birthday'] ?>" data-firstname="<?php echo $row['firstname'] ?>" data-lastname="<?php echo $row['lastname'] ?>" data-gender="<?php echo $row['gender'] ?>" type="button" data-toggle="modal" data-target="#user_update_modal" id="icon_button" title="Update Info" class="btn btn-rounded btn-outline-info btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button data-whatever="<?php echo $_user_id ?>" data-toggle="modal" data-target="#user_delete_modal" id="icon_button" type="button" title="Delete student" class="btn btn-rounded btn-outline-danger btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="8">NO DATA FOUND</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="user_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="actions/user_delete.php" method="POST">
                    <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                        <input type="hidden" name="id" class="form-control" id="id" aria-hidden="true">
                    </div>
            
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button type="submit" name="submit" value="approve" class="btn btn-warning">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- approved Modal -->
<div class="modal fade" id="statusmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Change Student status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="actions/status_change.php" method="POST">
                    <!-- <div class="modal-body"> -->
                        <input type="hidden" name="id" class="form-control" id="id" aria-hidden="true">
                    <!-- </div> -->
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" value="restrict" class="btn btn-outline-primary">Restrict</button>
                <button type="submit" name="submit" value="approve" class="btn btn-outline-primary">Approved</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update student info Modal -->
<div class="modal fade" id="user_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 900px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Update Student account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="bod modal-body">
                <form action="actions/user_update.php" method="POST">
                    <div style="margin-bottom: -50px; margin-top: -30px;" class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-medium">Update account</h6>
                                    <input type="hidden" name="id" class="form-control" id="user-id" aria-hidden="true">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg" id="emailadd" name="email" placeholder="Email address">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" id="pass" name="password" placeholder="Password (must be more than 6 characters)">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" id="confpass" name="confirmpassword" placeholder="Confirm password">
                                    </div>
                                    <div class="form-group">
                                        <h6 class="font-weight-medium">Privilege:</h6>
                                        <select class="form-control form-control-lg" id="privilege" name="Privilege">
                                            <option>---Select Privilege---</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-medium">Personal Information</h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" id="firstname" name="Firstname" placeholder="Firstname">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" id="lastname" name="Lastname" placeholder="Lastname">
                                    </div>
                                    <div class="form-group">
                                        <h6 class="font-weight-medium">Birth Date:</h6>
                                        <input type="date" class="form-control form-control-lg" id="birthdate" name="Birthdate" placeholder="Birthdate">
                                    </div>
                                    <div class="form-group">
                                        <h6 class="font-weight-medium">Gender:</h6>
                                        <select class="form-control form-control-lg" id="gender" name="Gender">
                                            <option>---Select your gender---</option>
                                            <option>Female</option>
                                            <option>Male</option>
                                            <option>Rather not say</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- <div class="modal-body">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Horizontal Two column</h4>
                            <form class="form-sample">
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Gender</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="dd/mm/yyyy" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>Category1</option>
                                                    <option>Category2</option>
                                                    <option>Category3</option>
                                                    <option>Category4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Membership</label>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked>
                                                        Free
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2">
                                                        Professional
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Address
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">State</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Postcode</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Country</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>America</option>
                                                    <option>Italy</option>
                                                    <option>Russia</option>
                                                    <option>Britain</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
</script>
<script>

</script> -->

<!-- add student modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 900px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Register new student</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="bod modal-body">
                <form action="actions/user_register.php" method="POST">
                    <div style="margin-bottom: -50px; margin-top: -30px;" class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-medium">Set up account</h6>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg" id="emailadd" name="email" placeholder="Email address" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" id="username" name="Username" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" id="pass" name="password" placeholder="Password (must be more than 6 characters)" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" id="confpass" name="confirmpassword" placeholder="Confirm password" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control form-control-lg" id="privilege" name="privilege" required>
                                            <option>---Select Privilege---</option>
                                            <option>Admin</option>
                                            <option>Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="font-weight-medium">Personal Information</h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" placeholder="Firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" id="lastname" name="lastname" placeholder="Lastname" required>
                                    </div>
                                    <div class="form-group">
                                        <h6 class="font-weight-medium">Birth Date:</h6>
                                        <input type="date" class="form-control form-control-lg" id="birthdate" name="birthdate" placeholder="Birthdate" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control form-control-lg" id="gender" name="gender" required>
                                            <option>---Select your gender---</option>
                                            <option>Female</option>
                                            <option>Male</option>
                                            <option>Rather not say</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="actions/js/user_transaction.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        new DataTable('#studentTable')
    })
</script>

<?php
if (isset($_GET['status'])) {
?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: "<?php echo $_SESSION['ico'] ?>",
            title: "<?php echo $_SESSION['title'] ?>"
        }).then(function() {
            window.location = "index.php?page=_students";
        })
    </script>

<?php
    unset($_GET['status']);
}
?>