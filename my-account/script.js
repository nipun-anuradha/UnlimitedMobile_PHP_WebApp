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
  form.append("c", c.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
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
  };

  r.open("POST", "signUpProcess.php", true);
  r.send(form);
}

function signIn() {
  var email = document.getElementById("smail");
  var password = document.getElementById("spass");
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
        window.location = "../index.php";
      } else {
        document.getElementById("serror").innerHTML = t;
      }
    }
  };

  r.open("POST", "signInProcess.php", true);
  r.send(form);
}

//user forget password
function forgetPass() {
  var fp = document.getElementById("fp");
  var lr = document.getElementById("lr");
  var lbox = document.getElementById("lbox");
  var fbox = document.getElementById("fbox");

  var smail = document.getElementById("smail");
  var fmail = document.getElementById("fmail");
  fmail.value = smail.value;

  fp.classList.toggle("d-none");
  lr.classList.toggle("d-none");
  lbox.classList.toggle("d-none");
  fbox.classList.toggle("d-none");
}

function sendVmail() {
  var svm = document.getElementById("svm");
  var np = document.getElementById("np");
  var fmail = document.getElementById("fmail");

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Verification code has been sent to your email.");
        svm.classList.toggle("d-none");
        np.classList.toggle("d-none");
      } else {
        document.getElementById("sendError").innerHTML = t;
      }
    }
  };

  r.open("GET", "forgotPasswordProcess.php?e=" + fmail.value, true);
  r.send();
}

function newPass() {
  var vc = document.getElementById("vcode");
  var np = document.getElementById("npass");
  var ncp = document.getElementById("ncpass");
  var fmail = document.getElementById("fmail");

  var form = new FormData();
  form.append("vc", vc.value);
  form.append("np", np.value);
  form.append("ncp", ncp.value);
  form.append("m", fmail.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Password reset success");
        location.reload();
      } else {
        document.getElementById("newError").innerHTML = t;
      }
    }
  };

  r.open("POST", "resetPassword.php", true);
  r.send(form);
}
//user forget password

function panddingPayment(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      var details = JSON.parse(t);

      payhere.onCompleted = function onCompleted(orderId) {

        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
          if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("loadingOverlay").style.display = "flex";
                alert("Payment completed. OrderID:" + orderId);
                sendInvoice(orderId);
            } else {
              alert(t);
            }
          }
        };

        r.open("GET", "../updatePaymentProcess.php?id=" + orderId, true);
        r.send();
      };

      payhere.onDismissed = function onDismissed() {
        alert("Payment dismissed");
        location.reload();
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
        order_id: details.invoiceId,
        items: details.items,
        amount: details.amount,
        currency: "LKR",
        hash: details.hash,
        first_name: details.fname,
        last_name: details.lname,
        email: details.email,
        phone: details.phone,
        address: details.address,
        city: details.city,
        country: "Sri Lanka",
      };

      payhere.startPayment(payment);
    }
  };

  r.open("GET", "penddingPaymentProcess.php?id=" + id, true);
  r.send();
}


function sendInvoice(orderId){
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
          document.getElementById("loadingOverlay").style.display = "none";
          alert("Check Your Gmail Inbox.");
          location.reload();
        }else{
          alert(t);
          location.reload();
        }
      }
    };
  
    r.open("GET", "../sendInvoiceProcess.php?id=" + orderId, true);
    r.send();
  }

  function deleteOrder(id){
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
          alert("Order Delete successful.");
          var row = document.getElementById("R"+id);
          row.parentNode.removeChild(row);
        }else{
          alert(t);
        }
      }
    };
  
    r.open("GET", "deleteOrderProcess.php?id=" + id, true);
    r.send();
  }