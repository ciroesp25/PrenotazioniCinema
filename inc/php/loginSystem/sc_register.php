<?php
    require_once("../db_connection.php");

    $fields = array('name','surname','emailRegister','passRegister', 'confirmPass', 'confirmTerms');
    
    //Check for special characters
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $surname = mysqli_real_escape_string($conn,$_POST['surname']);
    $email = mysqli_real_escape_string($conn,$_POST['emailRegister']);
    $pass = password_hash(mysqli_real_escape_string($conn,$_POST['passRegister']), PASSWORD_DEFAULT);

    //Check for empty fields
    $emptyFieldDetected= false;
    foreach($fields as $needed){
        if(empty($_POST[$needed])){
            $emptyFieldDetected = true;
        }
    }

    //Output error in case of empty fields
    if($emptyFieldDetected){
        
        echo('
            <script type="text/javascript">
                alert("Errore nella creazione utente... Riprova! Reindirizzamento...");
            </script>
        ');
        header("Location:../../../index");
        
        exit();
    }

    $q = "SELECT user_email, user_name, user_surname
            FROM users
           WHERE user_email = '$email' OR user_name = '$name' OR user_surname = '$surname'";
    $result = mysqli_query($conn, $q);

    if (mysqli_num_rows($result) > 0) {
        
        echo('
            <script type="text/javascript">
                alert("Utente con queste credenziali già creato!");
            </script>
        ');
        header("Location:../../../index");
        exit();
    }

    //Query to add a ner user as a record
    $q = "INSERT INTO users (user_name,user_surname,user_email,user_pass)
                     VALUES ('$name','$surname','$email','$pass')";
    

    $result = mysqli_query($conn, $q);
    mysqli_close($conn);
    echo '<script language="javascript">window.location.href ="../../../index"</script>';
    
?>