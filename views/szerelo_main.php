<!DOCTYPE html>
<html>
<body>
    <section>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($viewData["adatok"]['adat']as $g) { ?>
                        <tr>
                            <td>
                                <?= $g["az"] ?>
                            </td>
                            <td>
                                <?= $g["nev"] ?>
                             </td> 
                             <td>
                                <?= $g["kezdev"] ?>
                            </td>
                            <td>
                                <?= $g["deactivate"] ?>
                             </td> 
                             <td><a href="<?= SITE_ROOT.'szerelo/szerelomodosit&id=$g["az"]' ?>">módosít  </a>
                            </td>
                            <td><a href="<?= SITE_ROOT.'szerelotorol&id=$g["az"]' ?>">TÖRÖL  </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </section>
    
</body>

</html>