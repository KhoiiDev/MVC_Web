<?php
    $url = $data["url"];
?>
<section class="vh-auto">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container m-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-3">
                            <h2 class="text-uppercase text-center mb-2">CLASS</h2>


                            <form action='<?php echo $url."" ?>' method="post" onsubmit="return(checkFormClass());">

                                <div class="form-outline mb-2">
                                    <label for="className" class="form-label">Class Name</label>
                                    <input type="text" class="form-control form-control-lg" id="className" name="className" value="<?php echo $data["className"] ?>">
                                    <span id="errClassname" class="text-danger"> </span>
                                </div>

                                <div class="form-outline mb-2">
                                    <label for="teacherName" class="form-label">Teacher Name</label>
                                    <input type="text" class="form-control form-control-lg" id="teacherName" name="teacherName" value="<?php echo $data["teacherName"] ?>">
                                    <span id="errTeachername" class="text-danger"> </span>
                                </div>

                                <div class="form-outline mb-2">
                                    <label for="groupName" class="form-label">Group Name</label>
                                    <input type="text" class="form-control form-control-lg" id="groupName" name="groupName" value="<?php echo $data["groupName"] ?>">
                                    <span id="errGroupname" class="text-danger"> </span>
                                </div>

                                <div class="form-outline mb-2">
                                    <label for="classroom" class="form-label">Room Name</label>
                                    <input type="text" class="form-control form-control-lg" id="classroom" name="classroom" value="<?php echo $data["classroom"] ?>">
                                    <span id="errRoomname" class="text-danger"> </span>
                                </div>

                                <div class="form-outline mb-2">
                                    <label for="codeClass" class="form-label">Class code</label>
                                    <input type="text" class="form-control form-control-lg" id="codeClass" name="codeClass" value="<?php echo $data["codeClass"] ?>">
                                    <span id="errClasscode" class="text-danger"> </span>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-3" type="submit" name="submit">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>