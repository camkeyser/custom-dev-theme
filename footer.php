<footer class="site-footer">
    <div class="container">
        <!-- Centered Logo -->
        <div class="footer-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Company Logo">
        </div>

        <!-- Footer Widgets Section -->
        <div class="footer-widgets">
            <!-- About ACME Column -->
            <div class="footer-widget about-widget">
                <h3>ABOUT ACME</h3>
                <p>ACME is committed to delivering innovative solutions that empower businesses to achieve their goals globally through cutting-edge technology and dedicated support.</p>
                <ul class="footer-social">
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve" enable-background="new 0 0 24 24"><path d="M14.095 10.316 22.286 1h-1.94L13.23 9.088 7.551 1H1l8.59 12.231L1 23h1.94l7.51-8.543L16.45 23H23l-8.905-12.684zm-2.658 3.022-.872-1.218L3.64 2.432h2.98l5.59 7.821.869 1.219 7.265 10.166h-2.982l-5.926-8.3z" fill="#ffffff" class="fill-000000"></path></svg></a></li>
                    <li><a href="#"><svg data-name="Google alt" width="24px" height="24px" viewBox="0 0 420 419.997" xmlns="http://www.w3.org/2000/svg"><path d="M342.818 100.279a24.3 24.3 0 1 1-24.295-24.295 24.3 24.3 0 0 1 24.295 24.295ZM420 209.999l-.005.306-1.38 88.105a121.58 121.58 0 0 1-120.2 120.2L210 419.999l-.306-.006-88.105-1.376a121.586 121.586 0 0 1-120.206-120.2L0 209.999l.006-.306 1.376-88.108a121.59 121.59 0 0 1 120.206-120.2L210-.001l.306.006 88.105 1.376a121.584 121.584 0 0 1 120.2 120.2Zm-39.112 0-1.374-87.8A82.654 82.654 0 0 0 297.8 40.484L210 39.113l-87.8 1.371a82.658 82.658 0 0 0-81.716 81.715l-1.371 87.8 1.371 87.8a82.655 82.655 0 0 0 81.716 81.715l87.8 1.371 87.8-1.371a82.651 82.651 0 0 0 81.714-81.715Zm-63.048 0A107.841 107.841 0 1 1 210 102.158a107.962 107.962 0 0 1 107.84 107.841Zm-39.107 0A68.734 68.734 0 1 0 210 278.733a68.812 68.812 0 0 0 68.732-68.734Z" fill="#ffffff" class="fill-000000"></path></svg></a></li>
                    <li><a href="#"><svg width="24px" height="24px" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"><path d="m374.245 285.825 14.104-91.961h-88.233v-59.677c0-25.159 12.325-49.682 51.845-49.682h40.117V6.214S355.67 0 320.864 0c-72.67 0-120.165 44.042-120.165 123.775v70.089h-80.777v91.961h80.777v222.31A320.442 320.442 0 0 0 250.408 512a320.42 320.42 0 0 0 49.708-3.865v-222.31h74.129Z" fill="#ffffff" fill-rule="nonzero" class="fill-1877f2"></path></svg></a></li>
                </ul>
            </div>

            <!-- Company Column -->
            <div class="footer-widget">
                <h3>LINKS</h3>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about-us">About Us</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Information Column -->
            <div class="footer-widget">
                <h3>INFORMATION</h3>
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Press</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="footer-widget">
                <h3>CONTACT</h3>
                <ul>
                    <li><a href="tel:123456789"><i data-feather="phone"></i> (123) 456-7890</a></li>
                    <li class="hours"><i data-feather="clock"></i> Mon - Fri<br>9:00 AM - 5:00 PM</li>
                </ul>
            </div>
        </div>
        <div class="d-slash">
            <img src="<?php echo get_template_directory_uri(); ?>/img/foot-stripes.svg" alt="Footer Stripes">
        </div>
        <!-- Footer Bottom Section -->
        <div class="site-info">
            <p>&copy; <?php echo date('Y'); ?> ACME. All rights reserved.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>