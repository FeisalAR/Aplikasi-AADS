

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwprd recovery</title>
</head>
<body>
<main>
                    <div class="row">
                        <!-- Form Title -->
                        <div class="col">
                            <h1>Pwd Recovery</h1>
                        </div>
                    </div>
                    <!-- Form fields -->
                    <form method="GET" action="">
                   
                        <div class="form-group">
                            <label for="namaprogram">Password:</label>
                            <input type="password" class="form-control" id="password" name="tbpwd" required aria-required="true">
                        </div>

                        <!-- <button type="submit" class="btn btn-primary">Log In</button> -->
                        <input type="submit" class="btn btn-primary" name="submit" value="Log In">
                    </form>

            </div> <!-- Main Container end -->

            </main>
<?php

$pwd          = password_hash($_GET['tbpwd'], PASSWORD_DEFAULT);
echo $pwd;
?>
    
</body>
</html>