<?php

$router->get('', 'controllers/index.php');
$router->get('index', 'controllers/index.php');
$router->get('about', 'controllers/about.php');
$router->get('partners', 'controllers/partners.php');
$router->get('blog', 'controllers/blog.php');
$router->get('contact', 'controllers/contact.php');
$router->get('gallery', 'controllers/galery.php');
$router->get('single_post', 'controllers/single_post.php');

$router->post('images-gallery/new', 'controllers/images_gallery_new.php');

?>