<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>eLearning Admin</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../img/favicon.ico" />

    <!-- ckeditor plugin -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script> -->
    <!-- include summernote css/js -->


    <script src="vendors/ckeditor5/ckeditor.js"></script>

    <!-- datatables  -->
    <link rel="stylesheet" href="vendors/DataTables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="vendors/DataTables/datatables.min.css">
    <script src="vendors/DataTables/jquery-3.7.0.js"></script>
    <script src="vendors/DataTables/jquery.dataTables.min.js"></script>

    <!-- sweet alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- rich text editor -->
    <link rel="stylesheet" href="richtexteditor/richtexteditor/rte_theme_default.css">
    <script src="richtexteditor/richtexteditor/rte.js"></script>
    <script src="richtexteditor/richtexteditor/plugins/all_plugins.js"></script>
</head>
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

<body>

    <!-- LOGOUT Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to logout?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="actions/logout.php" method="post">
                        <button type="submit" name="logout" class="btn btn-danger">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>