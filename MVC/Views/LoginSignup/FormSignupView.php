<section class="vh-100 bg_login">
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 col-xl-9">
                <?php
                $this->view("LogoView");
                ?>
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-3 h-auto">
                <div class="card shadow-2-strong" style="border-radius: 1rem">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 text-dark fw-bold">Sign up</h2>

                        <form action="http://localhost/WebStudy/SignupController/Register" method="post" onsubmit="return(checkFormSignUp());">
                            <?php
                            if (!empty($data["fail"])) { ?>
                                <span class="error text-danger">
                                    <?php echo $data["fail"]; ?>
                                </span>
                            <?php } ?>

                            <div class="row">
                                <div class="form-check col-md-6 mb-3">
                                    <label class="form-check-label" for="permissions">
                                        Student
                                    </label>
                                    <input class="form-check-input" type="radio" name="permissions" id="permissions" value="student" checked>
                                </div>
                                <div class="form-check col-md-6 mb-3">
                                    <input class="form-check-input" type="radio" name="permissions" value="teacher">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Teacher
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label ">First name</label>
                                    <input type="text" class="form-control border-bottom border-secondary" name="firstName" id="firstName">
                                    <span id="errFirstname" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label ">Last name</label>
                                    <input type="text" class="form-control border-bottom border-secondary" name="lastName" id="lastName">
                                    <span id="errLastname" class="text-danger"></span>
                                </div>
                            
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label ">User name</label>
                                <input type="text" class="form-control border-bottom border-secondary" name="username" id="username">
                                <span id="errUsername" class="text-danger"></span>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label ">Email address</label>
                                <input type="email" class="form-control border-bottom border-secondary" name="email" id="email">
                                <span id="errEmail" class="text-danger"> </span>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password1" class="form-label">Password</label>
                                <input type="password" class="form-control border-bottom border-secondary" id="password1" name="password1">
                                <span id="errPassword1" class="text-danger"></span>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password2" class="form-label">Confirm password</label>
                                <input type="password" class="form-control border-bottom border-secondary" id="password2" name="password2">
                                <span id="errPassword2" class="text-danger"></span>
                            </div>
                            
                            <div class="d-grid">
                                <button class="btn btn-secondary" type="submit" name="register">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>