<?php
add_action('init', 'mi_init_session');

function mi_init_session()
{
    if (!session_id()) {
        session_start();
    }
}
