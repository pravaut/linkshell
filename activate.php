<?php 
include 'includes/overall/overall_header.php'; 
logged_in_redirect();
?>
<div style="height:20px;"></div>
<section>
<div class="inpagewindow"></div>
<div class="pad">
<?php include 'includes/side.php'; ?>

<div class="right pad-box2">	    	

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
    <h2>Thanks we have activated your account...</h2>
    <p>you are free to log in!</p>
<?php
    
} else if (isset($_GET['email'], $_GET['email_code']) === true) {
    
    $email      = trim($_GET['email']);
    $email_code = trim($_GET['email_code']);

    if (email_exists($email) === false) {
        $errors[] = 'Oops, something went wrong, and we could\'t find that email address';
    } else if (activate($email, $email_code) === false) {
        $errors[] = 'we had problems activating your account';
        
    }

    if (empty($errors) === false) {
        ?>
            <h2>Oops...</h2>
    <?php
        echo output_errors($errors);
    } else {
        header('Location: activate.php?success');
        exit();
    }


} else {
    header('Location: index.php');
    exit;
}

?>
</div>
<br style="clear:both;">
</div>
</section>

<?php include 'includes/overall/overall_footer.php'; ?>
