<nav class="navbar navbar-expand-lg p-2 text-white bg-7FBCD2">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/WebStudy/HomeController/main"
            style="font-family: 'Sono', sans-serif; font-size:larger;">WORK SPACE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/WebStudy/TeacherController/main">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <?php echo $_SESSION['firstName'] . $_SESSION['lastName'] ?>
                    </a>
                </li>
            </ul>
        </div>
        <a href="http://localhost/WebStudy/TeacherController/getFormAddClass"
            class="btn bg_bt_add btn-outline-light me-4 text-dark">New Class</a>

        <a href="http://localhost/WebStudy/HomeController/Lognout">
            <img src="http://localhost/WebStudy/FrontEnd/images/lognout.svg" title="Logn out">
        </a>
    </div>
</nav>