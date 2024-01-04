<?php
$background_array = array("#5D8BF4", "#A8D7F7", "#FFF6BF", "#FF8787", "#28DF99", "#9CB4CC");
$random_keys = array_rand($background_array, 2);

$url = $data["url"];

?>

<div class="container div_min_height ">
    <div class="row">
        <div class="text-center card mt-3 mb-1" style="background-color: <?php echo $background_array[$random_keys[0]]; ?> ;">
            <?php
            while ($row = mysqli_fetch_array($data["class"])) {
                $id = $row["idClass"];
                $className = $row["className"];
                $teacherName = $row["teacherName"];
                $classroom = $row["classroom"];
                $groupName = $row["groupName"];
                $codeClass = $row["codeClass"];
                echo "
                <h1> $className </h1>
                <h2> Giảng viên: $teacherName</h2>
                <h3> Nhóm: $groupName </h3>      
            ";
            }
            ?>
        </div>
    </div>
    <div class="row my-3 mx-100">
        <div class="h-100">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#stream">Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#todo">Assingment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#people">People</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="stream" class="container tab-pane active"><br>
                    <a style="width: 2rem; height: 2rem;" class="float-end mb-3" href=<?php echo $url . "/getViewAddPost"
                                                                                        ?>>
                        <img src="http://localhost/WebStudy/FrontEnd/images/add_notification.png" title="ADD STREAM">
                    </a>
                    <br>
                    <div class='panel-group' id='accordion'>
                        <?php
                        while ($row = mysqli_fetch_array($data["post"])) {
                            $postID = $row["postID"];
                            $title = $row["title"];
                            $content = $row["content"];
                            $fileupload = $row["fileupload"];
                            $postingTime = $row["postingTime"];
                            $username = $row["username"];
                            $idClass = $row["idClass"];
                            echo "
                                    <div class='panel panel-info mb-3 text-decoration-none'>
                                        <h4 class='panel-title'>
                                            <a class='panel-heading btn btn-outline-info w-100' data-toggle='collapse' data-parent='#accordion' href='#$postID'>
                                                $title <br>
                                                <small class = 'text-muted'>$username</small>
                                            </a>
                                        </h4>
                                        <div id='$postID' class='panel-collapse collapse in bg-light p-3'>
                                            <div class='panel-body'>
                                                
                                                <p>$content</p>
                                                <p>$postingTime</p>
                                                <a href='http://localhost/WebStudy/Data/Posts/$fileupload' download='$fileupload' >$fileupload</a>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                        }
                        ?>

                    </div>
                </div>
                <div id="todo" class="container tab-pane fade"><br>
                    <a style="width: 2rem; height: 2rem;" class="float-end mb-3" href=<?php echo
                                                                                        $url . "/getViewAddAssignment" ?>>
                        <img src="http://localhost/WebStudy/FrontEnd/images/add_work.png" title="ADD ASSIGNMENT">
                    </a>
                    <div class='panel-group' id='accordion'>
                        <?php
                        while ($row = mysqli_fetch_array($data["assignment"])) {
                            $assignmentID = $row["assignmentID"];
                            $title = $row["title"];
                            $content = $row["content"];
                            $fileupload = $row["fileupload"];
                            $username = $row["username"];
                            $postingTime = $row["postingTime"];
                            $idClass = $row["idClass"];
                            $deadlines = $row["deadlines"];
                            echo "
                                    <div class='panel panel-default mb-3'>
                                        <h4 class='panel-title'>
                                            <a class='panel-heading btn btn-outline-info w-100 text-decoration-none' data-toggle='collapse' data-parent='#accordion' href='#$assignmentID'>
                                                $title <br>
                                                <small class = 'text-muted'>$username</small>
                                            </a>
                                        </h4>
                                        <div id='$assignmentID' class='panel-collapse collapse in'>
                                            <div class='panel-body'>
                                                <div class='row'>
                                                    <div class ='col-6 border-end'>
                                                        <p>$content</p>
                                                        <a href='http://localhost/WebStudy/Data/Assignment/$fileupload' download='$fileupload' >$fileupload</a>
                                                        <p>$postingTime</p>
                                                    </div>
                                                    <div class ='col-3 float-end'>
                                                        <form action= '$url/response/$assignmentID' method='post' enctype='multipart/form-data' onsubmit='return(checkSubmit());'>
                                                            <h3>$title</3>
                                                            <div class='form-outline mb-2'>
                                                                <input type='file' class='form-control' name='uploadfile' id='uploadfile' />
                                                            </div>
                                                            <div class='d-grid'>
                                                                <button class='form-control gradient-custom-4 text-body '
                                                                    type='submit' name='submit'>Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class='row g-2 align-items-center'>
                                                    <div class='col-11'>
                                                        <input type='text' id='inputComment' class='form-control' placeholder='Comment'>
                                                    </div>
                                                    <div class='col-auto'>
                                                        <a class='text-decoration-none float-end' href='$url/deletePost/$assignmentID'><img src='https://img.icons8.com/fluency/48/null/sent.png'/></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                        }
                        ?>

                    </div>
                    
                </div>
                <div id="people" class="container tab-pane"><br>
                    <div class="mb-3">
                        <a style="width: 2rem; height: 2rem;" class="float-end" href=<?php echo $url . "/getViewAddPeople" ?>>
                            <img src="https://img.icons8.com/office/50/null/add--v1.png" />
                        </a>
                    </div>
                    <br>
                    <div class='panel-group' id='accordion'>
                        <?php
                        while ($row = mysqli_fetch_array($data["dataPeople"])) {
                            $username = $row["username"];
                            $email  = $row["email"];
                            echo "
                                <div class='card mt-1'>
                                    <div class='card-body'>
                                        <h4 class = 'text-primary'>$username</h4>
                                        <a class='text-decoration-none float-end' href='$url/deletePeopleOfClass/$username'><img src='https://img.icons8.com/color/22/null/delete-forever.png'/></a>
                                    </div>
                                </div>
                                    ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>