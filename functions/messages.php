<?php

add_action('account_announces', 'mi_update_imovel_success_message');

function mi_update_imovel_success_message()
{
    if (isset($_SESSION['mi_imovel_success_message']) && $_SESSION['mi_imovel_success_message']) {
        echo '<div class="container"><div class="row"><div class="col">' . mi_dismissible_alert($_SESSION['mi_imovel_success_message']) . '</div></div></div>';
        unset($_SESSION['mi_imovel_success_message']);
    }
}

add_action('account_announces', 'mi_update_imovel_error_message');

function mi_update_imovel_error_message()
{
    if (isset($_SESSION['mi_imovel_error_message']) && $_SESSION['mi_imovel_error_message']) {
        echo '<div class="container"><div class="row"><div class="col">' . mi_dismissible_alert($_SESSION['mi_imovel_error_message'], 'danger') . '</div></div></div>';
        unset($_SESSION['mi_imovel_error_message']);
    }
}
