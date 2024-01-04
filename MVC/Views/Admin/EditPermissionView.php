<?php
    $url = $data["url"];
?>
<section class="h-100">
    <div class="mask d-flex align-items-center gradient-custom-3 h-100">
        <div class="container m-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-3">
                            <h2 class="text-uppercase text-center mb-2">SET PERMISSION</h2>
                            <form action=<?php echo $url."/editPermissions/".$data["CurrentUsers"] ?> method="post">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="permission" id="exampleRadios1" value= '1' checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Student
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="permission" id="exampleRadios2" value= '2'>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Teacher
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="permission" id="exampleRadios3" value='3'>
                                    <label class="form-check-label" for="exampleRadios3">
                                        Admin
                                    </label>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-3"
                                        type="submit" name="set">SET</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>