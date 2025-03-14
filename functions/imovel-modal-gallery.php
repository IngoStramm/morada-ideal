<?php

add_action('mi_modal', 'mi_imovel_modal_gallery');

function mi_imovel_modal_gallery()
{
    $post_id = get_the_ID();
    $imovel_galeria = get_post_meta($post_id, 'imovel_galeria', true);
    $output = '';
    if ($imovel_galeria) {
        $output .= '
    <!-- Modal -->
<div class="modal fade" id="modal-gallery-' . $post_id . '" tabindex="-1" aria-labelledby="modal-gallery-' . $post_id . 'Label" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-gallery-' . $post_id . 'Label">' . __('Fotos', 'mi') . ': ' . get_the_title($post_id) . '</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . __('Fechar', 'mi') . '"></button>
      </div>
      <div class="modal-body">
        <div id="carousel-post-' . $post_id . '" class="carousel slide">
            <div class="carousel-inner">';
        $count = 0;
        foreach ($imovel_galeria as $image) {
            $active_class = $count === 0 ? 'active' : '';
            $output .=
                '<div class="carousel-item ' . $active_class . '">
                    <img src="' . $image . '" class="d-block w-100" >
                </div>';
            $count++;
        }
        $output .= '</div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-post-' . $post_id . '" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">' . __('Anterior', 'mi') . '</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-post-' . $post_id . '" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">' . __('Próximo', 'mi') . '</span>
            </button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . __('Fechar', 'mi') . '</button>
      </div>
    </div>
  </div>
</div>
';
    }
    echo $output;
}
