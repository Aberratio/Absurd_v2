<?php
session_start();
include("get_ranking.php");

if ($_SESSION['language'] == 1) {
    include("lang/lang_eng.php");
} else {
    include("lang/lang_pl.php");
}

$infos = new Infos();

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<!-- COMPETITION -->


<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">

                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            Ranking konkursowy
                        </h4>

                        <a href='menu.php' class='text-decoration-none ml-2 mb-2'>
                            <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
                        </a>

                        <?php get_competition_table($infos); ?>

                    </div>
                </div>
            </div>

            <!-- WHAT YOU HAVE TO DO -->
            <div class="col-sm-10 col-lg-5 mx-auto">
                <div class="container mt-5">
                    <div class="card process text-center px-4">
                        <h3 class="d-block text-center mt-2 mx-1 text-capitalize">
                            Chcesz wziąć udział w konkursie?
                        </h3>
                        <hr class="hr-dark py-3" />

                        <div class="mx-auto mb-3">
                            <div class="text-left">
                                <p class="text-left">
                                    <b>Termin:</b> 📅 24.05.2020 – 31.08.2020 (do północy) <br> <br>
                                    Ciekawe nagrody, dobry trening i wspaniały sposób na produktywne spędzenie czasu 😊 <br> <br>
                                    <b> Co musisz zrobić? </b>
                                    <ol>
                                        <li> Wyślijcie mi z partnerem informację, że bierzecie udział w konkursie (na <a href="https://www.facebook.com/joanna.gertrud.kokot" target="_blank">facebooku</a> lub na bezatux@gmail.com). </li>
                                        <li> Dostaniecie ode mnie zadania z licytacji jednostronnej (aż 260 rozkładów!). </li>
                                        <li> Rozwiązujecie i patrzycie, jak Wasze szanse na wygraną rosną. </li>
                                    </ol>

                                    Uwaga! Folder z ocenianymi tutaj zadaniami to "Bidding Competition". Zestawy z "First Step Into Absurd" nie biorą udziału w konkursie!
                                    <br>

                                    <br>
                                    <b>Nagrody</b> <br>
                                    <b>I miejsce </b> 🥇<br>
                                    <ul>
                                        <li> ✔️ dodatkowe 600 punktów w aplikacji Absurd </li>
                                        <li> ✔️ uwiecznienie w galerii sław w Absurdzie oraz w poście na facebooku </li>
                                        <li> ✔️ spersonalizowane zdjęcie brydżowe z dedykacją </li>
                                        <li> ✔️ karta konwencyjna: laminowana, w wybranej wersji językowej (eng\pl\de) oraz jej wersja edytowalna </li>
                                    </ul>
                                    Dodatkowo do wyboru: <br>
                                    <ol>
                                        <li> równowartość wylicytowanego wyniku w % </li>
                                        <li> gry planszowe – jedna dla każdej osoby z pary </li>
                                        <li> książki brydżowe – dostosowane do poziomu zaawansowania graczy</li>
                                    </ol><br>
                                    <b>II miejsce </b>🥈 <br>
                                    <ul>
                                        <li> ✔️ dodatkowe 450 punktów w aplikacji Absurd </li>
                                        <li> ✔️ uwiecznienie w galerii sław w Absurdzie oraz w poście na facebooku </li>
                                        <li> ✔️ spersonalizowane zdjęcie brydżowe z dedykacją </li>
                                        <li> ✔️ karta konwencyjna: laminowana, w wybranej wersji językowej (eng\pl\de) oraz jej wersja edytowalna </li>
                                    </ul>
                                    Dodatkowo do wyboru: <br>
                                    <ol>
                                        <li> równowartość połowy wylicytowanego wyniku w % </li>
                                        <li> książki brydżowe – dostosowane do poziomu zaawansowania graczy </li>
                                        <li> kawa/herbata/co kto lubi przy najbliższej okazji </li>
                                    </ol><br>
                                    <b>III miejsce </b> 🥉 <br>
                                    ✔️ dodatkowe 300 punktów w aplikacji Absurd <br>
                                    ✔️ uwiecznienie w galerii sław w Absurdzie oraz w poście na facebooku <br>
                                    ✔️ spersonalizowane zdjęcie brydżowe z dedykacją <br>
                                    ✔️ karta konwencyjna: laminowana, w wybranej wersji językowej (eng\pl\de) oraz jej wersja edytowalna <br>
                                    ✔️ kawa/herbata/co kto lubi przy najbliższej okazji <br> <br>
                                    Dodatkowo dla miejsc IV-VI zostały przewidziane nagrody: <br>
                                    ✔️ 150 punktów w aplikacji Absurd <br>
                                    ✔️ uwiecznienie w poście na facebooku <br>
                                    ✔️ widokówka (pisana wierszem!) z następnego ciekawego miejsca, do którego rzuci mnie los <br> <br>
                                    <b>Regulamin konkursu </b> <br>
                                    Jesteśmy sportowcami, więc każdy w pewnym stopniu wie, co kryje się pod pojęciem fair play. Forma przeprowadzenia konkursu nie utrudnia nikomu w żaden sposób oszukiwania, ale… jaki to ma sens? Żywię głęboką nadzieję, że do takiej sytuacji nie dojdzie! 🙄
                                    Wzięcie udziału jest równoznaczne z wyrażeniem zgody na publikację danych w poście ogłaszającym zwycięzców oraz w galerii sław aplikacji Absurd 😎 <br> <br>

                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->

        <div class="navbar fixed-bottom justify-content-center align-content-center" id="main-footer">
            <div class="footer-container">
                <p class="copyright">
                    Copyright &copy; 2020 by
                    <a href="https://www.facebook.com/joanna.gertrud.kokot/" target="_blank">Aberratio</a>. All Rights Reserved
                </p>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>