<div class="img-pagination">
    <?php $technex_prevPost = get_previous_post();
    if($technex_prevPost) {?>
        <div class="pagi-nav-box previous">
            <?php $technex_prevthumbnail = get_the_post_thumbnail($technex_prevPost->ID, array(150,150) ); $technex_prev = esc_html__('Previous post', 'technex'); ?>
            <?php previous_post_link('%link',"<div class='img-pagi'><i class='lnr lnr-arrow-left'></i> 
            $technex_prevthumbnail</div>  <div class='imgpagi-box'><p>$technex_prev</p> <h4 class='pagi-title'>%title</h4> </div>"); ?> 
        </div>

    <?php } $technex_nextPost = get_next_post();  
    if($technex_nextPost) { ?>
        <div class="pagi-nav-box next">
            <?php $technex_nextthumbnail = get_the_post_thumbnail($technex_nextPost->ID, array(150,150) ); $technex_next = esc_html__('Next post', 'technex'); ?>
            <?php next_post_link('%link',"<div class='imgpagi-box'><p>$technex_next</p><h4 class='pagi-title'>%title</h4> </div> <div class='img-pagi'><i class='lnr lnr-arrow-right'></i>
            $technex_nextthumbnail</div> "); ?>
        </div>
    <?php } ?>
</div><!--/.img-pagination-->