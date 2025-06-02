 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
      <!-- Add this where you want the button to appear -->
<div style="text-align:center; margin-bottom: 16px;">
  <div id="g_id_onload"
       data-client_id="296791958684-qj9s5b7qu9lsps2vvf0g8elg5s70epof.apps.googleusercontent.com"
       data-context="signup"
       data-ux_mode="popup"
       data-callback="handleGoogleSignIn"
       data-auto_prompt="false">
  </div>
  <div class="g_id_signin"
       data-type="standard"
       data-shape="rectangular"
       data-theme="outline"
       data-text="continue_with"
       data-size="large"
       data-logo_alignment="left">
  </div>
</div>


</body>
</html>
<script>
function handleGoogleSignIn(response) {
  // Send the ID token to the server for verification and user creation
  fetch('google_signup.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ credential: response.credential })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      // Redirect to user dashboard or wherever you want
      window.location.href = './users/index.php';
    } else {
      // Show error
      alert(data.message || "Google sign-in failed.");
    }
  });
}
</script>