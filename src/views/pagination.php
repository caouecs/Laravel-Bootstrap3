<?php

$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);

if ($paginator->getLastPage() > 1) {
    echo '<ul class="pagination">'.$presenter->render().'</ul>';
}
