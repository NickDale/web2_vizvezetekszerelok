<!DOCTYPE html>
<html>

<?php include_once './View/common/head.php';    ?>
<body>
    <section>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Hely</th>
                        <th>IPCím</th>
                        <th>Típus</th>
                        <th>Aktív</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($viewData["adatok"] as $g) { ?>
                        <tr>
                            <td>
                                <?= $g->hely ?>
                            </td>
                            <td>
                                <?= $g->ipcim ?>
                            </td>
                            <td>
                                <?= $g->tipus ?>
                            </td>
                            <td>
                                <?php if ($g->deactivate === 0) : ?>
                                    <input type="checkbox" checked disabled>
                                <?php else : ?>
                                    <input type="checkbox" disabled>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?page=telepitesc&gep_id=<?= $g->id ?>">telepített szoftverek</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </section>
    
</body>

</html>