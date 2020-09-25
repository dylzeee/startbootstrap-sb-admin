            
<?php

$context = [];

$id = get_current_user_id();
$open_tickets = wpas_get_tickets( 'open', array( 'posts_per_page' => -1, 'author' => $id ) );
$context['ticket'] = $open_tickets[0];

Timber::render( 'table.twig', $context)

?>