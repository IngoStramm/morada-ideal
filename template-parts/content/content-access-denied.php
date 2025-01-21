<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3"><i class="bi bi-x-circle-fill text-danger"></i> <?php _e('Acesso Negado!', 'mi'); ?></h3>
            <?php echo mi_alert(__('Você não tem permissão para acessar este conteúdo.', 'mi'), 'danger'); ?>
            <a class="go-back-btn btn btn-warning" href="#"><?php _e('Voltar', 'mi'); ?></a>
        </div>
    </div>
</div>