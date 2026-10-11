<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "web_content/header.php"; ?>
</head>
<body>
    <?php include "web_content/navbar.php"; ?>
    <?php include "web_content/introduction.php"; ?>
    <?php include "web_content/carousel.php"; ?>
    <?php include "web_content/team_member.php"; ?>
    <?php include "web_content/cards.php"; ?>
    <?php include "web_content/history.php"; ?>
    <?php include "web_content/subscribe.php"; ?>
    <?php include "web_content/footer.php"; ?>

    <!-- bootstrap 5 js bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("welcome-username").textContent = localStorage.getItem("username") || "Guest";
    </script>
</body>
</html>