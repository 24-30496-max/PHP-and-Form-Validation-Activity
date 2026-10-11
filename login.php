<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Marvel Studios — Login</title>

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
    background: url("images/login.jpg") center/cover no-repeat;
    color: #ffffff;
  }

  /*login card*/
  main.login-card {
    width: 100%;
    max-width: 360px;
    margin: 24px;
    padding: 32px 28px;
    background: rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(16, 16, 16, 0.35);
    border-radius: 12px;
    backdrop-filter: blur(50px);
  }

  header.login-card__header {
    text-align: center;
    margin-bottom: 24px;
  }

  header.login-card__header h1 {
    margin: 0;
    font-size: 1.6rem;
    font-weight: 600;
    letter-spacing: 7px;
  }
  .marvel {
      color: white;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background-color: rgb(231, 24, 24);
      padding: 2px 8px;
      font-weight: bold;
  }
  .studios {
        color: white;
        font-family: sans-serif;
        border-top: 3px solid white;
        border-bottom: 3px solid white;
  }

  form.login-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  form.login-form label {
    font-size: 0.85rem;
    margin-bottom: 6px;
    display: block;
    color: rgba(255, 255, 255, 0.75);
  }

  form.login-form input[type="text"],
  form.login-form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid rgba(5, 3, 3, 0.35);
    background: rgba(255, 255, 255, 0.12);
    color: #ffffff;
    font-size: 0.95rem;
  }

  form.login-form input::placeholder {
    color: rgba(255, 255, 255, 0.6);
  }

  .login-form__options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.8rem;
  }

  .login-form__options a {
    color: rgba(255, 255, 255, 0.75);
    text-decoration: none;
  }

  button.login-form__submit {
    padding: 12px;
    border: none;
    border-radius: 6px;
    background: rgb(234, 234, 234);
    color: #4a1d1d;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
  }

  button.login-form__submit.login-form__submit--locked {
    background: rgb(211, 47, 47);
    color: #ffffff;
    cursor: not-allowed;
  }

  .login-form__message {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.75);
    margin-top: 4px;
  }

  .login-form__message--locked {
    color: #ffcccc;
  }

  /* error message under each input (added for PHP validation) */
  .login-form__error {
    font-size: 0.8rem;
    color: #ffcccc;
    margin-top: 4px;
  }

  footer.login-card__footer {
    text-align: center;
    margin-top: 18px;
    font-size: 0.85rem;
    color: rgba(254, 248, 248, 0.75);
  }

  footer.login-card__footer a {
    color: #ffffff;
    font-weight: 600;
    text-decoration: none;
  }
</style>
</head>


<body>
  <main class="login-card">
    <!--marvel header logo-->
    <header class="login-card__header">
        <h1>
            <span class="marvel">Marvel</span>
            <span class="studios">Studios</span>
        </h1>
    </header>

    <?php
    // function that cleans the input (removes extra spaces, slashes and special characters)
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $maxAttempts   = 5;
    $validUsername = "gutierrez";
    $validPassword = "PAssword123";

    // attempts counter 
    if (!isset($_SESSION['attempts'])) {      
    $_SESSION['attempts'] = 0;
    }

    // define variables and set to empty values
    $username = $password = "";
    $usernameErr = $passwordErr = $formMessage = "";
    $loginSuccess = false;
    $locked = false;

    // check if the user already reached the maximum attempts
    if ($_SESSION['attempts'] >= $maxAttempts) {      
    $locked = true;
    }

    if (isset($_POST['submit']) && !$locked) { 
        $ok = true; 
    
        $username = test_input($_POST["username"]); 
        $password = $_POST["password"];
    
        // check the username 
        if (!isset($username) || $username == '') {     
        $usernameErr = "Ilagay ang iyong username.";
        $ok = false;
       } elseif (!preg_match("/^[a-zA-Z0-9_]{7,10}$/", $username)) {    
        $usernameErr = "Dapat 7 hanggang 10 character lang (letra, numero, at underscore).";
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

    // check the username and password 
        if ($ok) {
            if ($username == $validUsername && $password == $validPassword) {
            $loginSuccess = true;
            $_SESSION['attempts'] = 0; 
            } else {
               $_SESSION['attempts'] = $_SESSION['attempts'] + 1;
    
                if ($_SESSION['attempts'] >= $maxAttempts) {
                $locked = true;
                } else {
                    $remaining = $maxAttempts - $_SESSION['attempts'];
                    $formMessage = "invalid credentials. attempts remaining: " . $remaining;
                }
            }
        }
    }
    ?>
    <!--form (method is post, novalidate so the PHP messages show instead of the browser's)-->
    <form class="login-form" action="login.php" method="post" novalidate>

        <!--username input-->
      <div class="login-form__field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username"
               value="<?php echo $username; ?>">
        <?php if ($usernameErr != "") { ?>
          <div class="login-form__error"><?php echo $usernameErr; ?></div>
        <?php } ?>
      </div>

        <!--password input-->
      <div class="login-form__field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <?php if ($passwordErr != "") { ?>
          <div class="login-form__error"><?php echo $passwordErr; ?></div>
        <?php } ?>
      </div>

      <div class="login-form__options">
        <label>
          <input type="checkbox" id="remember" name="remember">
          Remember me
        </label>
        <a href="#">Forgot password?</a>
      </div>

      <!--the button is disabled when the maximum attempts is reached-->
      <?php if ($locked) { ?>
        <button type="submit" name="submit" class="login-form__submit login-form__submit--locked" disabled>Login Disabled</button>
        <div class="login-form__message login-form__message--locked">maximum attempts reached. Login disabled.</div>
      <?php } else { ?>
        <button type="submit" name="submit" class="login-form__submit">Login</button>
        <?php if ($formMessage != "") { ?>
          <div class="login-form__message"><?php echo $formMessage; ?></div>
        <?php } ?>
      <?php } ?>
    </form>

    <?php if ($loginSuccess) { ?>
    <script>
      localStorage.setItem("username", <?php echo json_encode($username); ?>);
      window.location.href = "index.php";
    </script>
    <?php } ?>

    <footer class="login-card__footer">
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </footer>
  </main>

</body>
</html>