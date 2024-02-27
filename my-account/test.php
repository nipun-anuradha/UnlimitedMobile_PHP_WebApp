<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Google Authentication</title>
</head>

<body>
    <h1>Firebase Google Authentication</h1>

    <!-- Button to trigger Google Sign-In -->
    <button id="glog">Sign in with Google</button>
    <button onclick="dfg();">Sign in with </button>



    <script type="module">
        // Import the functions you need from the SDKs you need
        import {initializeApp} from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
        import {getAuth, GoogleAuthProvider, signInWithRedirect, getRedirectResult, signInWithPopup } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-auth.js";

        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBndbWaKcXLLbYzoIvjVOjrwbjct6DBZgY",
            authDomain: "unlimitedmobile-e817d.firebaseapp.com",
            projectId: "unlimitedmobile-e817d",
            storageBucket: "unlimitedmobile-e817d.appspot.com",
            messagingSenderId: "141025897068",
            appId: "1:141025897068:web:9b9b643391196f15ef0649"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const provider = new GoogleAuthProvider(app);
        const auth = getAuth(app);


        glog.addEventListener('click', (e) => {
            signInWithPopup(auth, provider)
  .then((result) => {
    // This gives you a Google Access Token. You can use it to access the Google API.
    const credential = GoogleAuthProvider.credentialFromResult(result);
    const token = credential.accessToken;
    // The signed-in user info.
    const user = result.user;
    alert(user.displayName);

    const names = user.displayName.split(" ");
                    alert(names);
    // IdP data available using getAdditionalUserInfo(result)
    // ...
  }).catch((error) => {
    // Handle Errors here.
    const errorCode = error.code;
    const errorMessage = error.message;
    // The email of the user's account used.
    const email = error.customData.email;
    // The AuthCredential type that was used.
    const credential = GoogleAuthProvider.credentialFromError(error);
    // ...
  });


        });


    </script>
</body>

</html>