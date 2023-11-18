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
                   <form method="post" action="<?= SITE_ROOT.'szerelomod' ?>">
                   <input type="hidden" name="az" value='<?= $_GET["az"] ?>'>
                   <label for="nev" >Név:</label><br>
                        <input type="nev" id="nev" name="nev"><br>
                        <label for="kezdev">kezdési év:</label><br>
                        <input type="number" id="kezdev" name="kezdev"><br>
                        <label for="deactivate">deactivate:</label><br>
                        <input type="number" id="deactivate" name="deactivate"><br>
                        <input type="submit" value="mentes">
                    </form>
                </tbody>
            </table>
    </section>
    
</body>

</html>