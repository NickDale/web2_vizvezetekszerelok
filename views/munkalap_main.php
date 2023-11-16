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
                                <?= $g["bedatum"] ?>
                            </td>
                            <td>
                                <?= $g["javdatum"] ?>
                             </td>
                             <td>
                                <?= $g["munkaora"] ?>
                            </td>
                            <td>
                                <?= $g["anyagar"] ?>
                             </td>    
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </section>
    
</body>

</html>