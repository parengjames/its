<div class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Manage lessons</h3>
                            </div>
                            <div class="col-12 col-xl-4">
                                <div class="justify-content-end d-flex">
                                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        <a id="btn" class="btn btn-light" title="Create account for student" href="lessons_add"><i style="font-size: 13px;" class="ti-write"></i>  Add lesson</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: -15px;" class="table-responsive">
                        <table class="table table-hover" id="lessonsTable">
                            <thead>
                                <tr>
                                    <th >
                                        No.
                                    </th>
                                    <th style="width: 300px;">
                                        Title
                                    </th>
                                    </th>
                                    <th style="width: 300px;">
                                        Description
                                    </th>
                                    <th style="width: 200px;">
                                        Subject
                                    </th>
                                    <th >
                                        Status
                                    </th>
                                    <th >
                                        Date added
                                    </th>
                                    <th >
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- FETCHING DATA FROM DATABASE "USER DATA".................... -->
                                <?php
                                // $sqlquery = mysqli_query($con, "");
                                // $number = 1;
                                // $sqlquery_result = mysqli_num_rows($sqlquery);
                                // if ($sqlquery_result > 0) {
                                //     while ($row = mysqli_fetch_assoc($sqlquery)) {
                                //         $datebirth = date("m-d-Y", strtotime($row['Birthday']));
                                //         $_user_id = $row['user_id'];
                                ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="font-weight-medium"></td>
                                            <td>
                                                <!-- <button id="icon_button" type="button" title="View information" data-toggle="modal" data-target="#statusmodal" class="btn btn-rounded btn-outline-info btn-icon">
                                                    <i class="ti-eye"></i>
                                                </button>
                                                <button type="button" data-toggle="modal" data-target="#user_update_modal" id="icon_button" title="Update Info" class="btn btn-rounded btn-outline-info btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button  data-toggle="modal" data-target="#user_delete_modal" id="icon_button" type="button" title="Delete student" class="btn btn-rounded btn-outline-danger btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td> -->
                                        </tr>
                                    <?php
                                //     }
                                // } else {
                                    ?>
                                    <tr>
                                        <td colspan="8">NO DATA FOUND</td>
                                    </tr>
                                <!-- <?php
                                // } -->
                                // ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        new DataTable('#lessonsTable')
    })
</script>