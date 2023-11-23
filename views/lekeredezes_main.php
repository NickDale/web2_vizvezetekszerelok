<!DOCTYPE html>
<html>
<body>
    <section>
        <div class="container">
          
                <?php
                //var_dump( $viewData);

                ?>
                <select name="helyek" id="helyek">
                    <?php foreach ($viewData['telepulesek']as $g) { ?>
                        <option value='<?= $g["telepules"] ?>'><?= $g["telepules"] ?></option>
                            
                             
                       
                    <?php } ?>
                    </select>
                    <select name="szerelo" id="szrelo">
                    <?php foreach ($viewData["adatok"]['adat'] as $g) { ?>
                        <option value='<?= $g["nev"] ?>'><?= $g["nev"] ?></option>   
                    <?php } ?>
                    </select>
                    <input type="number" id="anyagar" name="anyagar" placeholder="anyagár"><br>
           
    </section>
    
</body>

</html>