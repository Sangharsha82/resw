<?php
$isSubDirectory = isset($isSubDirectory) ? $isSubDirectory : false;
$basePath = $isSubDirectory ? '../' : '';
?>

<div style="background-color: #0BE0FD">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4>Information</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="<?php echo $basePath; ?>">Home</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="<?php echo $basePath; ?>about.php">About</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="<?php echo $basePath; ?>contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Follow us</h4>
                <a href="#"><img src="<?php echo $basePath; ?>images/facebook.png" alt="facebook"></a>
                <a href="#"><img src="<?php echo $basePath; ?>images/twitter.png" alt="twitter"></a>
                <a href="#"><img src="<?php echo $basePath; ?>images/linkedin.png" alt="linkedin"></a>
                <a href="#"><img src="<?php echo $basePath; ?>images/instagram.png" alt="instagram"></a>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Contact us</h4>
                <p><b>Jaggamandu</b><br>
                    <span class="glyphicon glyphicon-map-marker"></span>Bhaktapur<br>
                    <span class="glyphicon glyphicon-envelope"></span>jaggamandubkt@gmail.com<br>
                    <span class="glyphicon glyphicon-earphone"></span> +123456789
                </p>
            </div>
        </div>
        <p class="copyright">Copyright 2024. All rights reserved.</p>
    </div>
</div> 