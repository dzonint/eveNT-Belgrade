<?php
require_once 'database.php';

// Check if username already exists in database - registration page AJAX.
if(isset($_REQUEST['username']) && $_REQUEST['task'] == 'checkUser'){
   $username = $_REQUEST['username'];
   $sql = "SELECT * FROM users WHERE user_name='$username'";
   $result = $conn->query($sql);
   echo mysqli_affected_rows($conn);
   exit();
}

// Check if email already exists in database - registration page AJAX.
if(isset($_REQUEST['email']) && $_REQUEST['task'] == 'checkEmail'){
   $email = $_REQUEST['email'];
   $sql = "SELECT * FROM users WHERE user_email='$email'";
   $result = $conn->query($sql);
   echo mysqli_affected_rows($conn);
   exit();
}

// Login.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'login'){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = md5(mysqli_real_escape_string($conn, $_POST['password'])); 
    $sql = "SELECT * FROM users WHERE user_name='$username'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()){
        if ($row['user_pass'] != $pwd){
            echo "Neispravna lozinka" . "<br />" . "Pokušajte ponovo, i obratite pažnju na velika i mala slova.";
            header("Refresh:2; url=../login.php");
            session_unset(); 
            session_destroy();
            exit();
        }
        if ($row['user_activated'] != 1){
            echo "Niste aktivirali nalog." . "<br />" . "Aktivirajte nalog preko linka poslatog na Vašu e-mail adresu kako biste pristupili sajtu.";
            header("Refresh:5; url=../index.php");
            session_unset(); 
            exit();
        }
        if ($row['user_banned'] == 1){
             echo "Imate zabranu pristupa sajtu." . "<br />" . "Za više informacija kontaktirajte administratora.";
             header("Refresh:5; url=../index.php");
             session_unset(); 
             session_destroy();
             exit();
        } 
        if ($row['user_administrator'] == 1){
             echo "Uspešno prijavljivanje administratora.<br/>";
             $_SESSION['administrator'] = true;
        }
        echo "Uspešno prijavljivanje...";
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $row['ID'];
        $_SESSION['username'] = $row['user_name'];
        header("Refresh:2; url=../index.php");
    } 
    else {
         echo "Nalog nije pronađen." . "<br />" . "Proverite da li ste ispravno uneli korisničko ime." . "<br />" . "Vraćanje na stranicu za prijavljivanje...";
         header("Refresh:2; url=../login.php");
    }
}

// Logout.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'logout'){
    session_unset(); 
    session_destroy();
    echo "Uspešno ste se odjavili." . "<br />" . "Vraćanje na početnu stranu...";
    header("Refresh:2; url=../index.php");
    exit();
}

// Registration.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'register'){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $confirmcode = rand();   
 $query = "INSERT INTO users (user_name, user_pass, user_email, user_confirmnum) ";
 $query .= "VALUES ('{$username}', '{$password}', '{$email}', {$confirmcode});";
 $result = mysqli_query($conn, $query);
 
 // Setting up localhost to send e-mails : https://stackoverflow.com/a/18185233
 $message =
    "
    Potvrdite Vaš nalog 
    Pritisnite link ispod kako biste potvrdili Vaš nalog
    http://localhost:8088/event_locator/admin/controller.php?task=confirmEmail&email=$email&confirmnum=$confirmcode
    ";
 mail($email, "eveNT Belgrade - Aktivirajte nalog", $message, "From: DoNotReply@eveNTBelgrade.com"); 
    
 $msg = "Registracija je uspešna!" . "<br />" . "<br />Ne zaboravite da aktivirate Vaš nalog.<br />" . "Vraćamo vas na početnu stranu...";
 echo $msg;
    
 header("Refresh:3; url=../index.php"); 
}

// E-mail account activation.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'confirmEmail'){
    $email = $_GET['email'];
    $confirmnum = $_GET['confirmnum'];
    
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $dbcode = $row['user_confirmnum'];
    if($confirmnum != $dbcode)
    {
        echo "GREŠKA : Kod za potvrdu iz linka se ne podudara sa kodom iz baze.";
    }
    else
    {
        $update = "UPDATE users SET user_activated=1 WHERE user_email='$email'";
        $result = $conn->query($update);
        echo "Vaš nalog je aktiviran. Od sada se možete prijaviti.";
    }
header("Refresh:3; url=../index.php");
}

// E-mail for password recover.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'passwordRecover'){
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($sql);
    
    if (!$row = $result->fetch_assoc()){
    echo "Nalog sa datom email adresom nije pronađen." . "<br>";
    header("Refresh:3; url=../pwrecover.php");
    } else {
    $confirmcode = $row['user_confirmnum'];
    $message =
        "Pritisnite link ispod kako biste obnovili vašu lozinku.
        http://localhost:8088/event_locator/pwrecover.php?task=passwordReset&email=$email&confirmnum=$confirmcode";

    mail($email, "eveNT Belgrade - Account details", $message, "From: DoNotReply@eveNTBelgrade.com");    
    echo "E-mail sa Vašim podacima je poslat. Proverite Vaš inboks za podatke.";
    header("Refresh:3; url=../index.php");
    }
}

// Password reset.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'passwordReset'){
    $email = $_REQUEST['email'];
    $pwd = md5(mysqli_real_escape_string($conn, $_POST['password']));

    $update = "UPDATE users SET user_pass='{$pwd}' WHERE user_email='$email'";
    $result = $conn->query($update);
    echo "Vaša lozinka je podešena. Od sada se možete prijaviti koristeći novi lozinku.";
    header("Refresh:3; url=../index.php");
}

// Add event.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'add-event'){
    !$_SESSION['administrator'] ? header("Location: ../index.php") : $a = 1;
    $events = array("event_name", "event_desc_short", "event_desc", "event_price", "event_location", "event_date", "event_picture", "category_id");
    $events_social = array("facebook", "twitter", "googleplus", "instagram", "youtube", "pinterest");
    $markers = array("lat", "lng", "icon_url");
    
    $events_query_flag = 0;
    $events_query_keys = "INSERT INTO events (";
    $events_query_values = " VALUES (";
    
    $events_social_query_flag = 0;
    $events_social_query_keys = "INSERT INTO events_social (";
    $events_social_query_values = " VALUES (";
    
    $markers_query_flag = 1;
    $markers_query_keys = "INSERT INTO markers (";
    $markers_query_values = " VALUES (";
    
    foreach($_REQUEST as $key => $val){
        if(in_array($key, $events)){
            $events_query_keys .= $key.",";
            $events_query_values .= "'$val'".",";
            $events_query_flag = 1;
        } else if(in_array($key, $events_social)){
            $events_social_query_keys .= $key.",";
            $events_social_query_values .= "'$val'".",";
            $events_social_query_flag = 1;
        } else if(in_array($key, $markers)){
            $markers_query_keys .= $key.",";
            $markers_query_values .= "'$val'".",";
            $markers_query_flag = 1;
        }
    }
    
    if($events_query_flag == 1){
        $events_query_keys = rtrim($events_query_keys,',').")";
        $events_query_values = rtrim($events_query_values,',').");";
        $events_query = $events_query_keys . $events_query_values;
        mysqli_query($conn, $events_query);
        $event_id = mysqli_insert_id($conn);
        
        // Event image upload
        $image_path = 'img\/event\/' . $_FILES['event_picture']['name'];
        copy($_FILES['event_picture']['tmp_name'], '..\/'.$image_path);
        mysqli_query($conn, "UPDATE events SET event_picture = '$image_path' WHERE ID = $event_id");
    }
    
    if($events_social_query_flag == 1){
        $events_social_query_keys = rtrim($events_social_query_keys,',').")";
        $events_social_query_values = rtrim($events_social_query_values,',').");";
        $events_social_query = $events_social_query_keys . $events_social_query_values;
        mysqli_query($conn, $events_social_query);
        $social_id = mysqli_insert_id($conn);
        mysqli_query($conn, "UPDATE events SET social_id = $social_id WHERE ID = $event_id");
    }
    
    if($markers_query_flag == 1){
        $markers_query_keys = rtrim($markers_query_keys, ',').")";
        $markers_query_values = rtrim($markers_query_values, ',').");";
        $markers_query = $markers_query_keys . $markers_query_values;
        mysqli_query($conn, $markers_query);
        $marker_id = mysqli_insert_id($conn);
        mysqli_query($conn, "UPDATE markers SET event_id = $event_id WHERE id = $marker_id");
    }
    
    echo "Događaj je uspešno dodat...";
    header("Refresh:2; url=../edit-event.php");
}

// Remove event.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'remove-event'){
    !$_SESSION['administrator'] ? header("Location: ../index.php") : $a = 1;
    $ID = mysqli_real_escape_string($conn, $_REQUEST['id']);
    // 1. markers 2. events 3. events_social
    mysqli_query($conn, "DELETE FROM markers WHERE event_id = $ID");
        $event_query = mysqli_query($conn, "SELECT * FROM EVENTS WHERE ID = $ID");
        $row = mysqli_fetch_assoc($event_query);
        $social_id = $row['social_id'];
    mysqli_query($conn, "DELETE FROM events WHERE ID = $ID");
    mysqli_query($conn, "DELETE FROM events_social WHERE ID = $social_id");
    
    echo "Događaj je uspešno uklonjen...";
    header("Refresh:2; url=../edit-events.php");
}

// Update event.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'update-event'){
    !$_SESSION['administrator'] ? header("Location: ../index.php") : $a = 1;
    $ID = mysqli_real_escape_string($conn, $_REQUEST['ID']);
    $events = array("event_name", "event_desc_short", "event_desc", "event_price", "event_location", "event_date", "event_picture", "category_id");
    $events_social = array("facebook", "twitter", "googleplus", "instagram", "youtube", "pinterest");
    $markers = array("lat", "lng", "icon_url");
    
    $events_query_flag = 0;
    $events_query = "UPDATE events SET ";
    
    $events_social_query_flag = 0;
    $events_social_query = "UPDATE events_social SET ";
    
    $markers_query_flag = 1;
    $markers_query = "UPDATE markers SET ";
    
    foreach($_REQUEST as $key => $val){
        if(in_array($key, $events)){
            $events_query .= $key."="."'$val'".",";
            $events_query_flag = 1;
        } else if(in_array($key, $events_social)){
            $events_social_query .= $key."="."'$val'".",";
            $events_social_query_flag = 1;
        } else if(in_array($key, $markers)){
            $markers_query .= $key."="."'$val'".",";
            $markers_query_flag = 1;
        }
    }
    
    if($events_query_flag == 1){
        $events_query = rtrim($events_query,',')." WHERE ID=$ID";
        mysqli_query($conn, $events_query);
        
        // Event image update
        if(isset($_FILES['event_picture']) && $_FILES['event_picture']['size'] > 0){
            $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT event_picture FROM events WHERE ID = $ID"));
            $image_path = 'img\/event\/' . $_FILES['event_picture']['name'];
            copy($_FILES['event_picture']['tmp_name'], '..\/'.$image_path);
            mysqli_query($conn, "UPDATE events SET event_picture = '$image_path' WHERE ID = $ID");
            unlink('..\/'.$row['event_picture']);
        }
    }
    
    if($events_social_query_flag == 1){
        $events_social_query = rtrim($events_social_query,',')." WHERE ID = $ID";
        mysqli_query($conn, $events_social_query);
    }
    
    if($markers_query_flag == 1){
        $markers_query = rtrim($markers_query, ',')." WHERE event_id = $ID";
        mysqli_query($conn, $markers_query);
    }
    
    echo "Događaj je uspešno izmenjen...";
    header("Refresh:2; url=../edit-event.php?id=$ID");
}

// Ban user.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'ban-user'){
    !$_SESSION['administrator'] ? header("Location: ../index.php") : $a = 1;
    $ID = mysqli_real_escape_string($conn, $_REQUEST['id']);
    mysqli_query($conn, "UPDATE users SET user_banned = 1 WHERE ID=$ID");
    header("Refresh:0; url=../users.php");
}

// Unban user.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'unban-user'){
    !$_SESSION['administrator'] ? header("Location: ../index.php") : $a = 1;
    $ID = mysqli_real_escape_string($conn, $_REQUEST['id']);
    mysqli_query($conn, "UPDATE users SET user_banned = 0 WHERE ID=$ID");
    header("Refresh:0; url=../users.php");
}

// Delete user's account.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'remove-user'){
    !$_SESSION['administrator'] ? header("Location: ../index.php") : $a = 1;
    $ID = mysqli_real_escape_string($conn, $_REQUEST['id']);
    mysqli_query($conn, "DELETE FROM users WHERE ID=$ID");
    header("Refresh:0; url=../users.php");
}

// Add review.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'add-review'){
    $user_id = $_SESSION['id'];
    $event_id = mysqli_real_escape_string($conn, $_REQUEST['event_id']);
    $rating = mysqli_real_escape_string($conn, $_REQUEST['rating']);
    $review = mysqli_real_escape_string($conn, $_REQUEST['review']);
    mysqli_query($conn, "INSERT INTO reviews(user_ID, event_ID, rating, comment) VALUES ('$user_id', '$event_id', '$rating', '$review')");
    
    echo "Recenzija je uspešno objavljena...";
    header("Refresh:2; url=../event.php?id=$event_id");
}

// Remove review.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'remove-review'){
    $event_id = mysqli_real_escape_string($conn, $_REQUEST['event_id']);
    $user_id = mysqli_real_escape_string($conn, $_REQUEST['user_id']);
    $a = 1 ? mysqli_query($conn, "DELETE FROM reviews WHERE user_ID = $user_id AND event_ID = $event_id") : header("Location: ../index.php");
    
    echo "Recenzija je uspešno uklonjena...";
    header("Refresh:2; url=../event.php?id=$event_id");
}

// Remove category.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'remove-category'){
    $category_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    mysqli_query($conn, "DELETE FROM categories WHERE ID = $category_id");
    
    echo "Kategorija je uspešno uklonjena...";
    header("Refresh:2; url=../categories.php");
}

// Add category.
if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'add-category'){
    $category = mysqli_real_escape_string($conn, $_REQUEST['category']);
    mysqli_query($conn, "INSERT INTO categories (category) VALUES ('$category')");
    
    echo "Kategorija je uspešno dodata...";
    header("Refresh:2; url=../categories.php");
}
?>

