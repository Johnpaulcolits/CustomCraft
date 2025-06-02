function handleGoogleSignIn(response) {
  // Send the ID token to the server for verification and user creation
  fetch('../google_signup.php', {
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