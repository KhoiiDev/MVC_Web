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
                        <h2 class="text-center mb-4 text-dark fw-bold">Login</h2>

                        <form action="http://localhost/WebStudy/LoginController/Click" method="post" onsubmit="return(checkFormLogin());">
                            <?php
                            if (!empty($data["fail"])) { ?>
                                <span class="error text-danger"> <?php echo $data["fail"]; ?> </span>
                            <?php } ?>
                            <div class="mb-3">
                                <label for="username" class="form-label ">User Name</label>
                                <input type="text" class="form-control border-bottom border-secondary" id="username" aria-describedby="emailHelp" name="username" value=>
                                <span id="errUsername" class="text-danger"> </span>
                            </div>
                           
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control border-bottom border-secondary" id="password" name="password">
                                <span id="errPass" class="text-danger"> </span>
                            </div>
                        
                            <div class="text-center pt-1 mb-5 pb-1">
                                <a class="text-muted" href="#!">Forgot password?</a>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-secondary" type="submit" name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>