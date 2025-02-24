<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Otp</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

  <div class="wrapper">
    <section class="form signup">
         <header>Send OTP</header>
    <form id="otpForm"> 
   
    <label>Email Address</label>
    <div class="field input">
        <input type="email" name="email" placeholder="Enter your email" required>
    </div>
        <!-- <button type="submit" name="request_otp" id="otpButton">Send OTP</button > -->
        <div class="field button">
         <input type="submit" name="request_otp" id="otpButton" value="Sent">
        </div>
    </form>
    <div class="link">Already signedup? <a href="login.php">Login now</a></div>
    </section>
  </div>
</body>
</html>

<script>
    document.querySelector('#otpForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = document.querySelector('input[name="email"]').value;
        const otpButton = document.querySelector('#otpButton');

        if (!email) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: 'warning',
                title: 'Please enter your email!'
            });
            return;
        }

        // Show loading state on button
        otpButton.disabled = true;
        otpButton.textContent = 'Sending...';

        try {
            const response = await fetch('./users/phpController/requestotp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'email': email,
                    'request_otp': true
                })
            });

            const result = await response.text();

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            if (result.trim() === 'success') {
                Toast.fire({
                    icon: 'success',
                    title: 'OTP sent successfully!'
                });

                setTimeout(() => {
                    window.location.href = 'verifyotp.php';
                }, 1500);
            } else {
                Toast.fire({
                    icon: 'error',
                    title: result
                });
            }
        } catch (error) {
            console.error('Error:', error);

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: 'error',
                title: 'Something went wrong. Please try again later.'
            });
        } finally {
            // Reset button state
            otpButton.disabled = false;
            otpButton.textContent = 'Send OTP';
        }
    });
</script>
