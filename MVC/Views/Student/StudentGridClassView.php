<div class="container-fluid div_min_height">
    <div class="row ">
        <?php
        $url = $data["url"];

        while ($row = mysqli_fetch_array($data["dataClass"])) {
            $id = $row["idClass"];
            $className = $row["className"];
            $teacherName = $row["teacherName"];
            $classroom = $row["classroom"];
            $group = $row["groupName"];
            $codeClass = $row["codeClass"];
            echo "

            <div class='card border-dark m-3' style='max-width: 18rem;'>
                <div class='row pt-2'; height: 8rem;'>
                    <div class='card-header col-10'>
                        <h5><a href='$url/getClassView/$id' class ='text-dark'>$className</a></h5>
                    </div>
                    <div class='col-2 '>
                        <div class='d-flex justify-content-between gap-4'>
                            <div class='dropdown'>
                                    <img src='https://img.icons8.com/ios-glyphs/100/null/menu-2.png' data-bs-toggle='dropdown'/>
                                <ul class='dropdown-menu'>
                                    <li><a class='dropdown-item' href='$url/exitClass/$id'>exit</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='card-body text-dark'>
                    <p class='card-title'> Tên Giảng Viên: $teacherName </p>
                    <p class='card-title'> Phòng Học: $classroom </p>
                    <p class='card-title'> Nhóm: $group </p>
                    <p class='card-title'> Mã Lớp: $codeClass </p>
                </div>
            </div>
                ";
        }
        ?>
    </div>
</div>