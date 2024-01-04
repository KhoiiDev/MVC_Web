<?php
    $url = $data["url"];
?>
<div class="container-fluid h-100">
    <div class="row ">
        <?php
        while ($row = mysqli_fetch_array($data["dataAccount"])) {
            $username  = $row["username"];
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $permissions = $row["decentralization"];
            echo "

            <div class='card border-dark m-3' style='max-width: 18rem;'>
                <div class='row pt-2' height = '8rem'>
                    <div class='card-header col-10 bg-primary text-light'>
                    <p class='card-title'> User Name: $username </p>
                    </div>
                    <div class='col-2 '>
                        <div class='d-flex justify-content-between gap-4'>
                            <div class='dropdown'>
                                    <img src='https://img.icons8.com/ios-glyphs/100/null/menu-2.png' data-bs-toggle='dropdown'/>
                                <ul class='dropdown-menu'>
                                    <li><a class='dropdown-item' href='$url/deleteAccount/$username'>Delete</a></li>
                                    <li><a class='dropdown-item' href='$url/getViewEditPermissions/$username'>Edit Permissions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='card-body text-dark'>
                    <p class='card-title'> First Name: $firstname </p>
                    <p class='card-title'> Last Name: $lastname </p>
                    <p class='card-title'> Permission: $permissions </p>
                </div>
            </div>
                ";
        }
        ?>
    </div>
</div>