<div class="container">
    <?php $picsInRow = 0;
        foreach ($photoLinks as $link) {
            if ($picsInRow % 3 === 0):
                ?>
                <div class="row">
                <?php endif; ?>
                <div class="col img-wrap">
                    <a href="<?= $link ?>" data-lightbox="album" >
                        <img src="<?= $link ?>" alt="" class="img-thumbnail"/>
                    </a>
                    <img class="ajax" data-path="<?= $link ?>" src="lightbox_imgs/close.png" alt=""/>
                </div>
                <?php
                $picsInRow++;
                if ($picsInRow % 3 === 0):
                    ?>
                </div>
                <?php
            endif;
        }?>
</div>

