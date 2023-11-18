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
                   <form method="post" action="<?= SITE_ROOT.'addujhelyek' ?>">
                   <label for="telepules" >Telepulés:</label><br>
                        <input type="text" id="telepules" name="telepules"><br>
                        <label for="utca">Utca:</label><br>
                        <input type="text" id="utca" name="utca"><br>
                        <input type="submit" value="mentes">
                    </form>
                </tbody>
            </table>
    </section>
    
</body>

</html>