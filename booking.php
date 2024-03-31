<!DOCTYPE html>
<html>
<?php
	include "inc/head.inc.php";
	?>
    <body>
        
    <?php
	include "inc/header.inc.php";
	?>

        <!-- main -->
        <section class = "section-five">
            <div class = "container">
                <div class = "contact-top">
                    <h3>Send an enquiry</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur, nobis.</p>
                </div>

                <div class = "contact-middle">
                    <div>
                        <span class = "contact-icon">
                            <i class = "fas fa-map-signs"></i>
                        </span>
                        <span>Address</span>
                        <p>Main Street - 3456, California 0000</p>
                    </div>

                    <div>
                        <span class = "contact-icon">
                            <i class = "fas fa-phone"></i>
                        </span>
                        <span>Contact Number</span>
                        <p>4567 3485 2902</p>
                    </div>

                    <div>
                        <span class = "contact-icon">
                            <i class = "fas fa-paper-plane"></i>
                        </span>
                        <span>Email Address</span>
                        <p>info@gmail.com</p>
                    </div>

                    <div>
                        <span class = "contact-icon">
                            <i class = "fas fa-globe"></i>
                        </span>
                        <span>Website</span>
                        <p>www.sarahlab.com</p>
                    </div>
                </div>

                <div class = "contact-bottom">
                    <form class = "form">
                        <input type = "text" placeholder="Your Name">
                        <input type = "email" placeholder="Your Email">
                        <input type = "text" placeholder="Subject">
                        <textarea rows = "9" placeholder="Message"></textarea>
                        <input type = "submit" class = "btn" value = "Send Message">
                    </form>

                    <!-- Map -->
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509916.01527587!2d-123.79730890241156!3d37.18431437946637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2snp!4v1595133867574!5m2!1sen!2snp" width="100%" height="600px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of main -->


        <!-- footer -->
        <?php
	    include "inc/footer.inc.php";
	    ?>
        <!-- end of footer -->
        

        <script src="script.js"></script>
    </body>
</html>