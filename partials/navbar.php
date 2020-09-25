<?php 

/* 

   Renders the top navbar only.


*/

$logout_link = esc_url( "https://support.auwebmasters.com.au/wp-login.php?action=logout&redirect_to=https%3A%2F%2Fauwebmasters.com.au&_wpnonce=b825afadbe" );
$profile_url = get_site_url( null, '/my/profile', 'https' ); 
$billing_url = get_site_url( null, '/account/?action=subscriptions', 'https' );

?>

