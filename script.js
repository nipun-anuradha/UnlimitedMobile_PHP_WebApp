function signOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "index.php";
      }
    }
  };
  r.open("GET", "signOutProcess.php", true);
  r.send();
}

//-- addproduct --
function cview() {
  document.getElementById("cedit").classList.toggle("d-none");
}

function bview() {
  document.getElementById("bedit").classList.toggle("d-none");
}

function mview() {
  document.getElementById("medit").classList.toggle("d-none");
}

function addCategory() {
  var text = document.getElementById("ctext");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "addCBMprocess.php?select=C&t=" + text.value, true);
  r.send();
}

function addBrand() {
  var text = document.getElementById("btext");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "addCBMprocess.php?select=B&t=" + text.value, true);
  r.send();
}

function addModel() {
  var text = document.getElementById("mtext");
  var brand = document.getElementById("brand");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open(
    "GET",
    "addCBMprocess.php?select=M&t=" + text.value + "&brand=" + brand.value,
    true
  );
  r.send();
}

function removeCategory() {
  var c = document.getElementById("category");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "removeCBMprocess.php?select=C&id=" + c.value, true);
  r.send();
}

function removeBrand() {
  var b = document.getElementById("brand");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "removeCBMprocess.php?select=B&id=" + b.value, true);
  r.send();
}

function removeModel() {
  var m = document.getElementById("model");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "removeCBMprocess.php?select=M&id=" + m.value, true);
  r.send();
}

function changeProductImg() {
  var image = document.getElementById("imgUpload");

  image.onchange = function () {
    var img_count = image.files.length;

    for (var x = 0; x < img_count; x++) {
      var file = this.files[x];
      var url = window.URL.createObjectURL(file);
      document.getElementById("preview" + x).src = url;
    }
  };
}

function addProduct() {
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
        alert("New product added.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "addProductProcess.php", true);
  r.send(form);
}
//-- addproduct page --

var countDownDate = new Date("2022 09 15 17:43:00").getTime();

function timer() {
  var now = new Date().getTime();
  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("d").innerHTML = days;
  document.getElementById("h").innerHTML = hours;
  document.getElementById("m").innerHTML = minutes;
  document.getElementById("s").innerHTML = seconds;

  if (distance < 0) {
    clearInterval(timer);
    document.getElementById("d").innerHTML = "00";
    document.getElementById("h").innerHTML = "00";
    document.getElementById("m").innerHTML = "00";
    document.getElementById("s").innerHTML = "00";
  }
}

function startTimer() {
  setInterval(timer, 1000);
}

function addToCart(id, word) {
  if (word == "many") {
    var qty = document.getElementById("q").value;
  } else {
    var qty = 1;
  }

  if (!isNaN(qty) && parseInt(qty) >= 1) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        alert(t);
        location.reload();
      }
    };

    r.open("GET", "addToCartProcess.php?id=" + id + "&q=" + qty, true);
    r.send();
  } else {
    alert("Invalid product quantity.");
    location.reload();
  }
}

function deleteFromCart(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "removeCartProcess.php?id=" + id, true);
  r.send();
}

function checkout() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        window.location = "checkout.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "checkoutVerifyProcess.php", true);
  r.send();
}

function placeOrder() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    // var mail = document.getElementById("mail");
    var provi = document.getElementById("provi");
    var dis = document.getElementById("dis");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var zcode = document.getElementById("zcode");
    var tel = document.getElementById("tel");
    var note = document.getElementById("note");
    var terms = 0;
    if(document.getElementById("terms").checked){
      terms = 1;
    }

    var shipping_add = 0;

    var form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    // form.append("m", mail.value);
    form.append("p", provi.value);
    form.append("d", dis.value);
    form.append("l1", line1.value);
    form.append("l2", line2.value);
    form.append("c", city.value);
    form.append("z", zcode.value);
    form.append("t", tel.value);
    form.append("n", note.value);
    form.append("terms", terms);

    if (document.getElementById("shiping-address").checked) {
      shipping_add = 1;
      var fname_s = document.getElementById("fname_s");
      var lname_s = document.getElementById("lname_s");
      var provi_s = document.getElementById("provi_s");
      var dis_s = document.getElementById("dis_s");
      var line1_s = document.getElementById("line1_s");
      var line2_s = document.getElementById("line2_s");
      var city_s = document.getElementById("city_s");
      var zcode_s = document.getElementById("zcode_s");
      var tel_s = document.getElementById("tel_s");

      form.append("fn_s", fname_s.value);
      form.append("ln_s", lname_s.value);
      form.append("p_s", provi_s.value);
      form.append("d_s", dis_s.value);
      form.append("l1_s", line1_s.value);
      form.append("l2_s", line2_s.value);
      form.append("c_s", city_s.value);
      form.append("z_s", zcode_s.value);
      form.append("t_s", tel_s.value);
    }
    form.append("shipping_add", shipping_add);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;

        try {
          var jsonObject = JSON.parse(t);
          if (typeof jsonObject === "object") {
            document.getElementById("msgBox").classList.add("hidden");

            payhere.onCompleted = function onCompleted(orderId) {
              var r = new XMLHttpRequest();
              r.onreadystatechange = function () {
                if (r.readyState == 4) {
                  var t = r.responseText;
                  if (t == "Success") {
                    document.getElementById("loadingOverlay").style.display =
                      "flex";
                    alert("Payment completed. OrderID:" + orderId);
                    sendInvoice(orderId);
                  } else {
                    alert(t);
                  }
                }
              };

              r.open("GET", "updatePaymentProcess.php?id=" + orderId, true);
              r.send();
            };

            payhere.onDismissed = function onDismissed() {
              alert("Payment dismissed");
              window.location = "cart.php";
            };

            payhere.onError = function onError(error) {
              alert("Error:" + error);
            };

            var payment = {
              sandbox: true,
              merchant_id: "1225445",
              return_url: undefined, // Important
              cancel_url: undefined, // Important
              notify_url: "http://sample.com/notify",
              order_id: jsonObject.invoiceId,
              items: jsonObject.items,
              amount: jsonObject.amount,
              currency: "LKR",
              hash: jsonObject.hash,
              first_name: jsonObject.fname,
              last_name: jsonObject.lname,
              email: jsonObject.email,
              phone: jsonObject.phone,
              address: jsonObject.address,
              city: jsonObject.city,
              country: "Sri Lanka",
            };

            payhere.startPayment(payment);
          }
        } catch (error) {
          document.getElementById("msg").innerHTML = t;
          document.getElementById("msgBox").classList.remove("hidden");
        }
      }
    };
    r.open("POST", "placeOrderProcess.php", true);
    r.send(form);
}

function sendInvoice(orderId) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        document.getElementById("loadingOverlay").style.display = "none";
        alert("Check Your Gmail Inbox.");
        window.location = "cart.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "sendInvoiceProcess.php?id=" + orderId, true);
  r.send();
}

function headerSearch() {
  var category = document.getElementById("c");
  var txt = document.getElementById("stxt");

  var setHTML = document.getElementById("searchResult");

  var f = new FormData();
  f.append("c", category.value);
  f.append("t", txt.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if ((r.readyState = 4)) {
      var t = r.responseText;
      if (t == "empty" || t == "") {
        if (setHTML != null) {
          setHTML.innerHTML =
            "<h3>No Results Found <i class='fa fa-thumbs-down'></i></h3>";
        }
      } else {
        if (setHTML != null) {
          // setHTML.innerHTML = t;
        }
      }
    }
  };

  r.open("POST", "searchProcess.php", true);
  r.send(f);
}

function newcolor() {
  var clrName = document.getElementById("nc").value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "found") {
        alert("Color alredy exist.");
      } else if (t == "empty") {
        alert("New color is empty.");
      } else {
        document.getElementById("clrS").innerHTML = t;
        document.getElementById("nc").value = "";
      }
    }
  };

  r.open("GET", "addNewColorProcess.php?clr=" + clrName, true);
  r.send();
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

var Cqty = 0;

function updateQty(pid, cqty) {
  var qty = document.getElementById("qty" + pid).value;
  if (!isNaN(qty) && parseInt(qty) >= 1) {
    Cqty = cqty;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (isNaN(t)) {
          const array = t.split(",");
          document.getElementById("tot").innerHTML = array["0"];
          document.getElementById("ddtotal").innerHTML = array["0"];
          document.getElementById("inum").innerHTML = array["1"];
          document.getElementById("dditem").innerHTML = array["1"];
          document.getElementById("sitem").innerHTML = array["1"];

          document.getElementById("ddqty" + pid).innerHTML = array["2"];
        } else {
          alert("Invalid product quentity");
          document.getElementById("qty" + pid).value = t;
        }
      }
    };

    r.open("GET", "updateCartQtyProcess.php?pid=" + pid + "&qty=" + qty, true);
    r.send();
  } else {
    alert("Invalid product quentity");
    location.reload();
  }
}
