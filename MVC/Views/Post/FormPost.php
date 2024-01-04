<?php
    $url = $data["url"];
?>
<section>
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container m-5 vh-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-3">
                            <h2 class="text-uppercase text-center mb-2">POST</h2>

                            <form action= <?php echo $url."" ?> method="post" enctype="multipart/form-data" onsubmit="return(checkFormPost());">
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="title">Topic</label>
                                    <input type="text" class="form-control form-control-lg" name="title" id="title" value="<?php echo $data["title"] ?>">
                                    <span id="errTitle" class="text-danger"> </span>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="content">Content</label>
                                    <textarea class="form-control" rows="3" name="content" id="content" > <?php echo $data["content"] ?> </textarea>
                                    <span id="errContent" class="text-danger"> </span>
                                </div>
                                <div class="form-outline mb-2">
                                    <input type="file" class="form-control form-control-lg" name="upload_file" id="upload_file" />
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-3"
                                        type="submit" name="postup">POST UP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>