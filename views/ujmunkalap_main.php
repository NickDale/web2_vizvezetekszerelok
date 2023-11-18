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
                   <form method="post" action="<?= SITE_ROOT.'addujmunkalap' ?>">
                        <label for="bedatum" >bedatum:</label><br>
                        <input type="datetime-local" id="bedatum" name="bedatum"><br>
                        <label for="javdatum">javdatum:</label><br>
                        <input type="datetime-local" id="javdatum" name="javdatum"><br>
                        <label for="helyaz" >helyaz:</label><br>
                        <input type="number" id="helyaz" name="helyaz"><br>
                        <label for="szereloaz">szereloaz:</label><br>
                        <input type="number" id="szereloaz" name="szereloaz"><br>
                        <label for="munkaora" >munkaora:</label><br>
                        <input type="number" id="munkaora" name="munkaora"><br>
                        <label for="anyagar">anyagar:</label><br>
                        <input type="number" id="anyagar" name="anyagar"><br>
                        <input type="submit" value="mentes">
                    </form>
                </tbody>
            </table>
            
    </section>
    
</body>

</html>