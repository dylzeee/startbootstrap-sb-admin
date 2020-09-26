<?php

$context          = Timber::context();
$context['sidebar_title'] = "Hello World";

Timber::render( 'sidebar.twig', $context);

?>