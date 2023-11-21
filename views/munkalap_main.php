<!DOCTYPE html>
<html>
<?php include_once 'views/common/header.php';    ?>

<body>
    <div class="container">

        <div>
            <div class="form-group">
                <label for="szerelok-select">Szerelők</label>
                <select id="szerelok-selector">
                    <option value="">------ Válasszon egyet --------</option>
                    <?php foreach ($viewData["szerelok"] as $option) {
                        echo "<option value='$option->id'>$option->nev</option>";
                    }
                    ?>
                </select>

                <label for="helyek-select">Települések</label>
                <select id="helyek-selector">
                    <option value="">----- Válasszon egyet --------</option>
                    <?php foreach ($viewData["helyek"] as $option) {
                        echo "<option value='$option->id'>$option->telepules</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="filter-btn">Keresés</button>
            </div>

            <div class="form-group">
                <a class="btn btn-secondary" href="<?= SITE_ROOT . 'print/' ?>">pdf-mentése </a>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Munkalap azonosító</th>
                    <th>Település</th>
                    <th>utca</th>
                    <th>Beadás dátuma</th>
                    <th>Szerelő</th>
                    <th>Javítás dátuma</th>
                    <th>Munkaóra</th>
                    <th>Anyagár</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($viewData["munkalapok"] as $ml) { ?>
                    <tr>
                        <td>
                            <?= $ml->getMunkaLapId() ?>
                        </td>
                        <td>
                            <?= $ml->getTelepules() ?>
                        </td>
                        <td>
                            <?= $ml->getUtca() ?>
                        </td>
                        <td>
                            <?= $ml->getBeadasDatuma() ?>
                        </td>
                        <td>
                            <?= $ml->getSzereloNeve() ?>
                        </td>
                        <td>
                            <?= $ml->getJavitasDatuma() ?>
                        </td>
                        <td>
                            <?= $ml->getMunkaora() ?>
                        </td>
                        <td>
                            <?= $ml->getAnyagar() ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </section>
</body>

</html>