<?php
session_start();
include("get_comp_test.php");

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<body>

    <main>

        <section class="menu_view_container">
            <div class="container">
                <p style="font-size: 28px; color: rgb(247, 109, 109); margin-top: 20px;"> Test zgodności </p>
                <div class="row" style="margin-top: 50px;">
                    <?php get_test($_GET['set'], $_GET['friend']); ?>
                </div>
                <div>
                    <button class="search_button" name="save_results_btn">Zapisz</button>
                </div>
            </div>

    </main>

    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>