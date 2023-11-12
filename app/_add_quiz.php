<div style="padding-top: 20px;" class="content-wrapper">
    <a href="activities"><button style="margin-bottom: 20px;font-size: 15px;" type="button" class="btn btn-outline-dark btn-sm">
            <i class="ti-arrow-left"></i> Back
        </button></a>
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="uploadcontent" class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add quiz questions</h4>
                                <form action="actions/activity_backend.php" method="POST">
                                    <div class="form-group">
                                        <label for="title">Number control</label>
                                        <input type="number" class="form-control" name="number" id="number" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lesson_materials">Question</label>
                                        <textarea id="quiz_question" name="quiz_question" class="form-group"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Question choices:</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="choice_1" id="choice_1" placeholder="Choice A" autocomplete="off" required>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="choice_2" id="choice_2" placeholder="Choice B" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div style="margin-top: 15px;" class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="choice_3" id="choice_3" placeholder="Choice C" autocomplete="off" required>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="choice_4" id="choice_4" placeholder="Choice D" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Answer key</label>
                                        <input type="text" class="form-control" name="answerkey" id="answerkey" placeholder="Enter the correct answer" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Question Hints:</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="hint1" id="hint1" placeholder="Hint 1" autocomplete="off" required>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="file" name="hint2" id="hint2" class="file-upload-default" required>
                                                    <div class="input-group col-xs-12">
                                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Hint 2">
                                                        <span class="input-group-append">
                                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: -5px;" class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="hint3" id="hint3" placeholder="Hint 3" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_GET['deny'])) {
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo $_SESSION['text'] ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php
                                    } else if (isset($_GET['give'])) {
                                    ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?php echo $_SESSION['text'] ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group mt-3">
                                        <button type="submit" name="add_question" class="btn btn-primary mr-2">Submit</button>
                                        <a href="add_quiz#quiz"><button type="button" name="reset" class="btn btn-light">Reset</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List of questions:</h4>
                    <br>
                    <div style="margin-top: -15px;" class="table-responsive">
                        <table class="table table-hover" id="questionTable">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">
                                        No.
                                    </th>
                                    <th>
                                        Question
                                    </th>
                                    <th>
                                        Answer key
                                    </th>
                                    <th style="width: 100px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rich text editor scripts  -->
<script>
    var editor1 = new RichTextEditor("#quiz_question");
    //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
</script>

<script>
    (function($) {
        'use strict';
        $(function() {
            $('.file-upload-browse').on('click', function() {
                var file = $(this).parent().parent().parent().find('.file-upload-default');
                file.trigger('click');
            });
            $('.file-upload-default').on('change', function() {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });
        });
    })(jQuery);
</script>

<script>
    $(document).ready(function() {
        new DataTable('#questionTable')
    })
</script>