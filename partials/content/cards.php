<?php 

// Get the total number of Awesome Support tickets

function get_open_ticket_count() {
    $id = get_current_user_id();
    $open_array = wpas_get_tickets( 'open', array( 'posts_per_page' => -1, 'author' => $id ) );

    if ( is_array ( $open_array ) ) {
        $number_of_open_tickets = count( $open_array );
    }
    return $number_of_open_tickets;
}

?>