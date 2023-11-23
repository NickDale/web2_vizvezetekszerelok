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
                   <form method="post" action="<?= SITE_ROOT.'munkalapmod' ?>">
                   <input type="hidden" name="az" value='<?= $_GET["id"] ?>'>
                   <label for="bedatum" >bedatum:</label><br>
                        <input type="datetime-local" value="<?=$viewData["adatok"]['adat']["bedatum"] ?>" id="bedatum" name="bedatum"><br>
                        <label for="javdatum">javdatum:</label><br>
                        <input type="datetime-local" value="<?=$viewData["adatok"]['adat']["javdatum"] ?>" id="javdatum" name="javdatum"><br>
                        <label for="munkaora">munkaora:</label><br>
                        <input type="number" value="<?=$viewData["adatok"]['adat']["munkaora"] ?>" id="munkaora" name="munkaora"><br>
                        <label for="anyagar">anyagar:</label><br>
                        <input type="number" value="<?=$viewData["adatok"]['adat']["anyagar"] ?>" id="anyagar" name="anyagar"><br>
                        <label for="deactivate">deactivate:</label><br>
                        <input type="number" value="<?=$viewData["adatok"]['adat']["deactivate"] ?>" id="deactivate" name="deactivate"><br>
                        <input type="submit" value="mentes">
                    </form>
                </tbody>
            </table>
    </section>
    
</body>

</html>