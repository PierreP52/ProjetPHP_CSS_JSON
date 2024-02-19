<header>
    <a href="/" class="logo">Hotel Meu-meu</a>
    <img class="image-logo" src="/public/images/logo.jpg" alt="Logo Hotel">
    <ul class="header-menu">
        <li class=<?php $_SERVER['REQUEST_URI'] === '/liste_chambres.php' ? 'active' : ''?>>
        <a href='/liste_chambres.php'>Chambres<article></article></a>
        </li>
        <li class=<?php $_SERVER['REQUEST_URI'] === '/contact.php' ? 'active' : ''?>>
        <a href='/contact.php'>Contact<article></article></a>
        </li>
    </ul>
</header>