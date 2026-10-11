<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Marvel Studios — Register</title>

<style>
  * {
    box-sizing: border-box;
  }

  /*page*/
  body {
    margin: 0;
    font-family: "Segoe UI", Roboto, Arial, sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: url("images/register.jpg") center/cover no-repeat;
    color: #ffffff;
  }

  /*register card*/
  main.register-card {
    width: 100%;
    max-width: 360px;
    margin: 24px;
    padding: 32px 28px;
    background: rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(16, 16, 16, 0.35);
    border-radius: 12px;
    backdrop-filter: blur(50px);
  }

  header.register-card__header {
    text-align: center;
    margin-bottom: 24px;
  }

  header.register-card__header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: 1px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
  }

  p.register-card__eyebrow {
    margin: 0 0 4px;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 5px;
    text-transform: uppercase;
    text-decoration: underline;
    color: rgba(255, 255, 255, 0.6);
  }

  span.register-card__accent {
    color: rgb(237, 28, 36);
    font-style: italic;
  }

  form.register-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  form.register-form label {
    font-size: 0.85rem;
    margin-bottom: 6px;
    display: block;
    color: rgba(255, 255, 255, 0.75);
  }

  form.register-form input[type="text"],
  form.register-form input[type="email"],
  form.register-form input[type="tel"],
  form.register-form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid rgba(5, 3, 3, 0.35);
    background: rgba(255, 255, 255, 0.12);
    color: #ffffff;
    font-size: 0.95rem;
  }

  form.register-form input::placeholder {
    color: rgba(255, 255, 255, 0.6);
  }

  button.register-form__submit {
    padding: 12px;
    border: none;
    border-radius: 6px;
    background: rgb(234, 234, 234);
    color: #4a1d1d;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
  }

  /* error message under each input (added for PHP validation) */
  .register-form__message {
    font-size: 0.8rem;
    color: #ffcccc;
    margin-top: 4px;
  }

  footer.register-card__footer {
    text-align: center;
    margin-top: 18px;
    font-size: 0.85rem;
    color: rgba(254, 248, 248, 0.75);
  }

  footer.register-card__footer a {
    color: #ffffff;
    font-weight: 600;
    text-decoration: none;
  }

</style>
</head>


<body>
  <main class="register-card">
    <!--header-->
    <header class="register-card__header">
        <p class="register-card__eyebrow">Register</p>
        <h1>Be an <span class="register-card__accent">Avenger</span></h1>
    </header>

    <?php
    // function that cleans the input (removes extra spaces, slashes and special characters)
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // define variables and set to empty values
    $username = $email = $phone = $password = $confirm = "";
    $usernameErr = $emailErr = $phoneErr = $passwordErr = $confirmErr = "";

    if (isset($_POST['submit'])) { 
        $ok = true; 

        // clean the inputs with test_input() (passwords are left as they are)
        $username = test_input($_POST["username"]);
        $email    = test_input($_POST["email"]);
        $phone    = test_input($_POST["phone"]);
        $password = $_POST["password"];
        $confirm  = $_POST["confirm-password"];

        // check the username
        if (!isset($username) || $username == '') {
            $usernameErr = "Mamili ng username na iyong gagamitin.";
            $ok = false;
        } elseif (!preg_match("/^[a-zA-Z0-9_]{7,10}$/", $username)) {      
            $usernameErr = "Dapat 7 hanggang 10 character lang (letra, numero, at underscore).";
            $ok = false;
        }

        // check the email
        if (!isset($email) || $email == '') {
            $emailErr = "Ilagay ang iyong email address.";
            $ok = false;
        } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $emailErr = "Ilagay ang tamang email address.";
            $ok = false;
        }

        // check the phone number
        if (!isset($phone) || $phone == '') {
            $phoneErr = "Ilagay ang iyong numero ng telepono.";
            $ok = false;
        } elseif (!preg_match("/^09[0-9]{9}$/", $phone)) {
            $phoneErr = "Dapat ang numero ay nagsisimula sa (09) at may 11 digits.";
            $ok = false;
        }

        // check the password
        if (!isset($password) || $password == '') {
            $passwordErr = "Ilagay ang iyong password.";
            $ok = false;
        } elseif (!preg_match("/^.{8,}$/", $password)) {
            $passwordErr = "Kailangan ito ay 8 o mahigit pang character.";
            $ok = false;
        } elseif (!preg_match("/[A-Z].*[A-Z]/", $password)) {
            $passwordErr = "Kailangang may 2 malalaking character.";
            $ok = false;
        } elseif (!preg_match("/[0-9]/", $password)) {
            $passwordErr = "Kailangang mayroon itong numero.";
           $ok = false;
        }

        // check the confirm password
        if (!isset($confirm) || $confirm == '') {
            $confirmErr = "Kumpirmahin ang iyong password.";
            $ok = false;
        } elseif ($password != $confirm) {
            $confirmErr = "Hindi tugma ang iyong password.";
            $ok = false;
        }

        // if everything is valid, go to the login page 
        if ($ok) {
            header("Location: login.php");
            exit;
        }
    }
    ?>

    <!--form (method is post, novalidate so the PHP messages show instead of the browser's)-->
    <form class="register-form" action="register.php" method="post" novalidate>

        <!--username input-->
      <div class="register-form__field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Choose a username"
               value="<?php echo $username; ?>">
        <?php if ($usernameErr != "") { ?>
          <div class="register-form__message"><?php echo $usernameErr; ?></div>
        <?php } ?>
      </div>

        <!--email input-->
      <div class="register-form__field">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email"
               value="<?php echo $email; ?>">
        <?php if ($emailErr != "") { ?>
          <div class="register-form__message"><?php echo $emailErr; ?></div>
        <?php } ?>
      </div>

        <!--phone input-->
      <div class="register-form__field">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number"
               value="<?php echo $phone; ?>">
        <?php if ($phoneErr != "") { ?>
          <div class="register-form__message"><?php echo $phoneErr; ?></div>
        <?php } ?>
      </div>

        <!--password input-->
      <div class="register-form__field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password">
        <?php if ($passwordErr != "") { ?>
          <div class="register-form__message"><?php echo $passwordErr; ?></div>
        <?php } ?>
      </div>

        <!--confirm password input-->
      <div class="register-form__field">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter your password">
        <?php if ($confirmErr != "") { ?>
          <div class="register-form__message"><?php echo $confirmErr; ?></div>
        <?php } ?>
      </div>

      <button type="submit" name="submit" class="register-form__submit">Register</button>
    </form>

    <footer class="register-card__footer">
      <p>Already have an account? <a href="login.php">Login Here</a></p>
    </footer>
  </main>

</body>
</html>