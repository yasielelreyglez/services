<div class="toolbar">
    <div class="uou-block-1a blog">
        <div class="container">
            <ul class="quick-nav">
                <li><a href="about.html">About Us</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>

            <ul class="social">
                <li><a href="#" class="fa fa-facebook"></a></li>
                <li><a href="#" class="fa fa-twitter"></a></li>
                <li><a href="#" class="fa fa-google-plus"></a></li>
            </ul>

            <ul class="authentication">
                <?php if (isset($showlogin) == true) { ?>
                    <li><a href="<?= site_url("/login") ?>">Iniciar sesión</a></li>
                    <li><a href="<?= site_url("/register") ?>">Crear cuenta</a></li>
                <?php } else { ?>
                    <li><a href="<?= site_url("client/logout") ?>">Cerrar sesión</a></li>
                <?php } ?>
            </ul>
        </div>
    </div> <!-- end .uou-block-1a -->
</div> <!-- end toolbar -->