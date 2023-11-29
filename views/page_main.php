<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MVC - PHP</title>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>css/main_style.css">
    <?php if ($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="' . $viewData['style'] . '">'; ?>
</head>

<body>
    <header>
        <div id="user"><em><?= $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] ?></em></div>
        <h1 class="header">Vízvezetékszerelők</h1>
    </header>
    <nav>
        <?php echo Menu::getMenu($viewData['selectedItems']); ?>
    </nav>
    <aside>
        <p>        furcsán szökken a pentameter-sor elő:<br>
         "Tóth Gyula bádogos és vízvezeték-szerelő"</p>
        <img src="<?php echo SITE_ROOT ?>static/plumber.jpg"style="width:100px">
    </aside>
    <section>
        <?php if ($viewData['render']) include($viewData['render']); ?>
    </section>
    <footer>&copy; <?= date('Y') ?> - Vizvezetékszerelők (WEB II. 2. beadandó) by Balogh Norbert & Farkas Tibor</footer>
</body>

</html>
