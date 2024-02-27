var lFormStatus = "L";

function registerf() {
    if (lFormStatus == "L") {
        var lbox = document.getElementById("lbox");
        var rbox = document.getElementById("rbox");
        var r = document.getElementById("r");
        var l = document.getElementById("l");

        lbox.classList.toggle("d-none");
        rbox.classList.toggle("d-none");
        r.className = "text-black";
        l.className = "text-secondary";

        lFormStatus = "R";
    }
}

function loginf() {
    if (lFormStatus == "R") {
        var lbox = document.getElementById("lbox");
        var rbox = document.getElementById("rbox");
        var r = document.getElementById("r");
        var l = document.getElementById("l");

        lbox.classList.toggle("d-none");
        rbox.classList.toggle("d-none");
        l.className = "text-black";
        r.className = "text-secondary";

        lFormStatus = "L";
    }
}

function signUp() {
    var f = document.getElementById("fname");
    var l = document.getElementById("lname");
    var e = document.getElementById("mail");
    var p = document.getElementById("pass");
    var c = document.getElementById("cpass");

    var form = new FormData();
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("c", m.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.response;
            if (text == "success") {
                f.value = "";
                l.value = "";
                e.value = "";
                p.value = "";
                c.value = "";

                document.getElementById("error").innerHTML = "";
                loginf();
            } else {
                document.getElementById("error").innerHTML = text;
            }
        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(form);
}