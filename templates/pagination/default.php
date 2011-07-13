<?php if ($pagination['total']) : ?>
<div class="ax-pagination">
    <span>Page</span>
    <?php if ($pagination['current']>1) : ?> <a href="">First Page</a> <?php endif ?>
    <?php if ($pagination['current']-1>1) : ?> <a href="">Previous Page</a><?php endif ?>

    <a href="">1</a>
    <a href="">2</a>
    <a href="">3</a>
    <?php if ($pagination['current']+1<$pagination['total_page']) : ?> <a href="">Next</a> <?php endif ?>
    <?php if ($pagination['current']-1>1) : ?> <a href="">Last</a><?php endif ?>
    
</div>
<?php endif ?>