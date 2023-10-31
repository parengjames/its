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
</style>

<div class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div style="margin-bottom: -30px;" class="row">
                            <div class="col-12 col-xl-8 mb-xl-0">
                                <h3 class="font-weight-bold">Manage Course</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: -20px;" class="row">
        <div class="col-md-6  grid-margin stretch-card">
            <div style="height: 390px;" class="card">
                <div class="card-body">
                    <h4 class="card-title">Add course form</h4>
                    <form action="" method="POST" class="forms-sample">
                        <div class="form-group">
                            <label for="coursename">Course name</label>
                            <input type="text" class="form-control" name="coursename" id="coursename" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <button style="border-radius: 5px;" type="submit" name="submit" class="btn btn-primary mr-3">Save</button>
                        <button style="border-radius: 5px;" type="submit" name="cancel" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Course List</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th style="width: 10px;">Course name</th>
                                    <th>Description</th>
                                    <th style="width: 13px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jacob</td>
                                    <td>Photoshop</td>
                                    <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
                                    <td><label class="badge badge-danger">Pending</label></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>