function checkFormSignUp() {

    const firstName = document.getElementById("firstName");
    const lastName = document.getElementById("lastName");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password1 = document.getElementById("password1");
    const password2 = document.getElementById("password2");
    
    const errFirstname = document.getElementById("errFirstname");
    const errLastname = document.getElementById("errLastname");
    const errUsername = document.getElementById("errUsername");
    const errEmail = document.getElementById("errEmail");
    const errPassword1 = document.getElementById("errPassword1");
    const errPassword2 = document.getElementById("errPassword2");


    // check first name
    if (firstName.value == "") {
        errFirstname.innerHTML = "Please enter your first name";
        errFirstname.style.display = 'block';
        firstName.focus();
        return false;
    }
    else {
        errFirstname.style.display = "none";
    }

    // check last name
    if (lastName.value == "") {
        errLastname.innerHTML = "Please enter your last name";
        errLastname.style.display = 'block';
        lastName.focus();
        return false;
    }
    else {
        errLastname.style.display = "none";
    }

    // check username
    if (username.value == "") {
        errUsername.innerHTML = "Please enter your username";
        errUsername.style.display = 'block';
        username.focus();
        return false;
    }
    else {
        errUsername.style.display = "none";
    }

    // check email
    if (email.value == "") {
        errEmail.innerHTML = "Please enter your email";
        errEmail.style.display = 'block';
        email.focus();
        return false;
    }
    else {
        errEmail.style.display = "none";
    }


    // check password1
    if (password1.value == "") {
        errPassword1.innerHTML = "Please enter your password";
        errPassword1.style.display = 'block';
        password1.focus();
        return false;
    }
    // check lenght password
    else if (password1.value.length < 6 ) {
        errPassword1.innerHTML = "Please enter a password of at least 6 characters";
        errPassword1.style.display = 'block';
        password1.focus();
        return false;
    }
    else {
        errPassword1.style.display = "none";
    }

    // check password2
    if (password2.value == "") {
        errPassword2.innerHTML = "Please confirm your password";
        errPassword2.style.display = 'block';
        password2.focus();
        return false;
    }
    else {
        errPassword2.style.display = "none";
    }
    if (password2.value !== password1.value) {
        errPassword2.innerHTML = "Please confirm your password";
        errPassword2.style.display = 'block';
        password2.focus();
        return false;
    }
    else {
        errPassword2.style.display = "none";
    }
    return (true);
}
function checkFormLogin() {

    const username = document.getElementById("username");
    const password = document.getElementById("password");

    const errUsername = document.getElementById("errUsername");
    const errPass = document.getElementById("errPass");

    if (username.value == "") {
        errUsername.innerHTML = "Please enter your user name";
        errUsername.style.display = 'block';
        username.focus();
        return false;
    }
    else {
        errUsername.style.display = "none";
    }

    if (password.value == "") {
        errPass.innerHTML = "Please enter your password";
        errPass.style.display = 'block';
        password.focus();
        return false;
    }
    else {
        errPass.style.display = "none";
    }
    return (true);
}


function checkFormClass() {

    const className = document.getElementById("className");
    const teachername = document.getElementById("teacherName");
    const groupname = document.getElementById("groupName");
    const roomname = document.getElementById("classroom");
    const classcode = document.getElementById("codeClass");

    const errClassname = document.getElementById("errClassname");
    const respondTeachername = document.getElementById("errTeachername");
    const respondGroupname = document.getElementById("errGroupname");
    const respondRoomname = document.getElementById("errRoomname");
    const respondClasscode = document.getElementById("errClasscode");

    if (className.value == "") {
        errClassname.innerHTML = "Please enter your class name";
        errClassname.style.display = 'block';
        className.focus();
        return false;
    }
    else {
        errClassname.style.display = "none";
    }

    if (teachername.value == "") {
        respondTeachername.innerHTML = "Please enter teacher name";
        respondTeachername.style.display = 'block';
        teachername.focus();
        return false;
    }
    else {
        respondTeachername.style.display = "none";
    }

    if (groupname.value == "") {
        respondGroupname.innerHTML = "Please enter group name";
        respondGroupname.style.display = 'block';
        groupname.focus();
        return false;
    }
    else {
        respondGroupname.style.display = "none";
    }

    if (roomname.value == "") {
        respondRoomname.innerHTML = "Please enter room name";
        respondRoomname.style.display = 'block';
        roomname.focus();
        return false;
    }
    else {
        respondRoomname.style.display = "none";
    }
    if (classcode.value == "") {
        respondClasscode.innerHTML = "Please enter class code";
        respondClasscode.style.display = 'block';
        classcode.focus();
        return false;
    }
    else {
        respondRoomname.style.display = "none";
    }

    return (true);
}

function checkFormPost() {
    const title = document.getElementById("title");
    const content = document.getElementById("content");
    const upload_file = document.getElementById("upload_file");
    var file = upload_file.files;

    const errTitle = document.getElementById("errTitle");
    const errContent = document.getElementById("errContent");

    if (title.value == "") {
        errTitle.innerHTML = "Please enter your title";
        errTitle.style.display = 'block';
        title.focus();
        return false;
    } else {
        errTitle.style.display = "none";
    }
    if (content.value == "") {
        errContent.innerHTML = "Please enter your describe";
        errContent.style.display = 'block';
        content.focus();
        return false;
    } else {
        errContent.style.display = "none";
    }
    if (file.length != 0) {
        var fileSize = Math.round((file[0].size / 1024));
        var name_file_slpit = file[0].name.split(".");
        var ext = name_file_slpit[name_file_slpit.length - 1];
        var allow_ext = ['png', 'jpg', 'jpeg', 'gif', 'ppt', 'zip', 'pptx', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'txt', 'pdf'];

        if (allow_ext.includes(ext)) {
            if (fileSize <= 5 * 1024) {
                return true;
            }
            else {
                alert("Error! File too large");
                return false;
            }
        } else {
            alert("Error! File is not allowed to upload");
            return false;
        }

    }
    return (true);
}

function checkFormAsignment() {
    const title = document.getElementById("title");
    const deadlines = document.getElementById("deadlines");
    const content = document.getElementById("content");
    const upload_file = document.getElementById("upload_file");
    var file = upload_file.files;

    const errTitle = document.getElementById("errTitle");
    const errContent = document.getElementById("errContent");
    const errDeadlines = document.getElementById("errDeadlines");

    if (title.value == "") {
        errTitle.innerHTML = "Please enter your title";
        errTitle.style.display = 'block';
        title.focus();
        return false;
    } else {
        errTitle.style.display = "none";
    }
    if (content.value == "") {
        errContent.innerHTML = "Please enter your describe";
        errContent.style.display = 'block';
        content.focus();
        return false;
    } else {
        errContent.style.display = "none";
    }
    if (deadlines.value == "") {
        errDeadlines.innerHTML = "Please enter your deadlines";
        errDeadlines.style.display = 'block';
        deadlines.focus();
        return false;
    } else {
        errDeadlines.style.display = "none";
    }
    if (file.length != 0) {
        var fileSize = Math.round((file[0].size / 1024));
        var name_file_slpit = file[0].name.split(".");
        var ext = name_file_slpit[name_file_slpit.length - 1];
        var allow_ext = ['png', 'jpg', 'jpeg', 'gif', 'ppt', 'zip', 'pptx', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'txt', 'pdf'];

        if (allow_ext.includes(ext)) {
            if (fileSize <= 5 * 1024) {
                return true;
            }
            else {
                alert("Error! File too large");
                return false;
            }
        } else {
            alert("Error! File is not allowed to upload");
            return false;
        }

    }
    return (true);
}

function checkSubmit() {
    const upload_file = document.getElementById("uploadfile");
    var file = upload_file.files;
    if (file.length != 0) {
        var fileSize = Math.round((file[0].size / 1024));
        var name_file_slpit = file[0].name.split(".");
        var ext = name_file_slpit[name_file_slpit.length - 1];
        var allow_ext = ['png', 'jpg', 'jpeg', 'gif', 'ppt', 'zip', 'pptx', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'txt', 'pdf'];

        if (allow_ext.includes(ext)) {
            if (fileSize <= 5 * 1024) {
                return true;
            }
            else {
                alert("Error! File too large");
                return false;
            }
        } else {
            alert("Error! File is not allowed to upload");
            return false;
        }

    }
    return (true);
}