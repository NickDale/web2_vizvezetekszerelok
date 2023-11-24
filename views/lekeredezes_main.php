<!DOCTYPE html>
<html>
<body>
    <section>
        <div class="container">
          
                <?php
                //var_dump( $viewData);

                ?>
                <select name="helyek" id="helyek">
                    <option value="">összes</option>
                    <?php foreach ($viewData['telepulesek']as $g) { ?>
                        <option value='<?= $g["telepules"] ?>'><?= $g["telepules"] ?></option>
                            
                             
                       
                    <?php } ?>
                </select>
                <select name="szerelo" id="szerelo">
                <option value="">összes</option>
                    <?php foreach ($viewData["adatok"]['adat'] as $g) { ?>
                        <option value='<?= $g["nev"] ?>'><?= $g["nev"] ?></option>   
                    <?php } ?>
                </select>
                    <input type="number" id="anyagar" name="anyagar" placeholder="anyagár" value="0"><br>
                    <input type="hidden" id="SITEROOT" value="<?=SITE_ROOT?>">
                    
         </div> 
         <div id="eredmeny">

         </div>
    </section>
    <script src="<?=SITE_ROOT?>/static/api.js">

    </script>
</body>

</html>