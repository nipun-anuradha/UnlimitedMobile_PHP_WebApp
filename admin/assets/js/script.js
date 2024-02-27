function adminSignIn() {
  var email = document.getElementById("mail");
  var password = document.getElementById("pass");
  var rememberme = document.getElementById("rem");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("rm", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "dashboard.php";
      } else {
        document.getElementById("error").innerHTML = t;
      }
    }
  };

  r.open("POST", "adminSignInProcess.php", true);
  r.send(form);
}

function adminSignOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        // window.location = "index.php";
        location.reload();
      }
    }
  };
  r.open("GET", "adminSignOutProcess.php", true);
  r.send();
}

function changeProductState(id) {
  var color = document.getElementById("pstate" + id);
  var icon = document.getElementById("picon" + id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "unblock") {
        color.className = "text-success";
        icon.className = "lni lni-unlock";
      } else if (t == "block") {
        color.className = "text-danger";
        icon.className = "lni lni-lock";
      }
    }
  };
  r.open("GET", "blockProductsProcess.php?id=" + id, true);
  r.send();
}

function blockUser(mail) {
  var color = document.getElementById("c" + mail);
  var icon = document.getElementById("i" + mail);

  var form = new FormData();
  form.append("mail", mail);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "unblock") {
        color.className = "text-success";
        icon.className = "lni lni-unlock";
      } else if (t == "block") {
        color.className = "text-danger";
        icon.className = "lni lni-lock";
      }
    }
  };

  r.open("POST", "blockUserProcess.php", true);
  r.send(form);
}

function loadModel() {
  var bid = document.getElementById("brand").value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("model").innerHTML = t;
    }
  };
  r.open("GET", "loadModelProcess.php?bid=" + bid, true);
  r.send();
}

function mpsearch() {
  var search_txt = document.getElementById("st");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");

  var f = new FormData();
  f.append("s", search_txt.value);
  f.append("b", brand.value);
  f.append("m", model.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if ((r.readyState = 4)) {
      var t = r.responseText;
      document.getElementById("tbody").innerHTML = t;
    }
  };

  r.open("POST", "mpSearchProcess.php", true);
  r.send(f);
}

function completeOrder(oid) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("This order is complete.");
        location.reload();
      }
    }
  };
  r.open("GET", "comleteOrderProcess.php?oid=" + oid, true);
  r.send();
}

function cancleOrder(oid) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("This order is cancelled .");
        location.reload();
      }
    }
  };
  r.open("GET", "cancleOrderProcess.php?oid=" + oid, true);
  r.send();
}

function changeOrderState(oid, s) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("This order state is changed.");
        location.reload();
      }
    }
  };
  r.open("GET", "changeStateProcess.php?oid=" + oid + "&state=" + s, true);
  r.send();
}

function orderSearch(x) {
  var search_txt = document.getElementById("st");

  var f = new FormData();
  f.append("s", search_txt.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if ((r.readyState = 4)) {
      var t = r.responseText;
      document.getElementById("tbody").innerHTML = t;
    }
  };

  r.open("POST", "orderSearchProcess.php", true);
  r.send(f);
}

function userSearch() {
  var search_txt = document.getElementById("st");

  var f = new FormData();
  f.append("s", search_txt.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if ((r.readyState = 4)) {
      var t = r.responseText;
      document.getElementById("tbody").innerHTML = t;
    }
  };

  r.open("POST", "userSearchProcess.php", true);
  r.send(f);
}

function editProduct(pid) {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");

  var condition = 0;

  if (document.getElementById("bn").checked) {
    condition = 1;
  } else if (document.getElementById("us")) {
    condition = 2;
  }

  var qty = document.getElementById("qty");
  var op = document.getElementById("op");
  var cost = document.getElementById("cost");
  var clr = document.getElementById("clrS");
  // var description = document.getElementById("desc");
  var editor = CKEDITOR.instances.editor1;
  var description = editor.getData();

  var imgUpload = document.getElementById("imgUpload");

  var form = new FormData();
  form.append("pid", pid);
  form.append("c", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("t", title.value);
  form.append("con", condition);
  form.append("qty", qty.value);
  form.append("op", op.value);
  form.append("clr", clr.value);
  form.append("cost", cost.value);
  form.append("desc", description);
  form.append("img0", imgUpload.files[0]);
  form.append("img1", imgUpload.files[1]);
  form.append("img2", imgUpload.files[2]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("Product details updated.");
        window.location = "manageProduct.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "editProductProcess.php", true);
  r.send(form);
}
