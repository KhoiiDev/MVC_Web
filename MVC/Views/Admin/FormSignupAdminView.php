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
                            <h2 class="text-uppercase text-center mb-2">ADD ADMIN</h2>

                            <form action= <?php echo $url."/addNewAdmin" ?> method="post">

                                <div class="row">
                                    <div class="form-outline mb-2 col-6">
                                        <label class="form-label" for="form3Example1cg">First Name</label>
                                        <input type="text" class="form-control form-control-lg" name="firstname" />
                                    </div>
                                    <?php
                                    if (!empty($data["respondClassname"])) { ?>
                                    <span class="error text-danger">
                                        <?php echo $data["respondClassname"]; ?>
                                    </span>
                                    <?php } ?>
                                    <div class="form-outline mb-2 col-6">
                                        <label class="form-label" for="form3Example1cg">Last Name</label>
                                        <input type="text" class="form-control form-control-lg" name="lastname" />
                                    </div>
                                    <?php
                                    if (!empty($data["respondClassname"])) { ?>
                                    <span class="error text-danger">
                                        <?php echo $data["respondClassname"]; ?>
                                    </span>
                                    <?php } ?>
                                </div>

                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example1cg">User name</label>
                                    <input type="text" class="form-control form-control-lg" name="username" />
                                </div>
                                <?php
                                if (!empty($data["respondTeachername"])) { ?>
                                <span class="error text-danger">
                                    <?php echo $data["respondTeachername"]; ?>
                                </span>
                                <?php } ?>
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example3cg">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" />
                                </div>
                                <?php
                                if (!empty($data["respondRoomname"])) { ?>
                                <span class="error text-danger">
                                    <?php echo $data["respondRoomname"]; ?>
                                </span>
                                <?php } ?>
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password1" />
                                </div>
                                <?php
                                if (!empty($data["respondGroupname"])) { ?>
                                <span class="error text-danger">
                                    <?php echo $data["respondGroupname"]; ?>
                                </span>
                                <?php } ?>
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="form3Example4cdg">Confirm password</label>
                                    <input type="password" class="form-control form-control-lg" name="password2" />
                                </div>
                                <?php
                                if (!empty($data["respondClasscode"])) { ?>
                                <span class="error text-danger">
                                    <?php echo $data["respondClasscode"]; ?>
                                </span>
                                <?php } ?>

                                <div class="d-grid">
                                    <button class="btn btn-success btn-block btn-lg gradient-custom-4 text-body m-3"
                                        type="submit" name="add">ADD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>