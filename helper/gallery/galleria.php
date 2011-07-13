<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelpGalleryGalleria extends WfalbumHelperGallery {
    static public function info() {
        return array(
            'id' => 'Galleria',
            'name' => 'jQuery Galleria'
        );
    }
    
    public function render($photos) {
?>
<div id="galleria">
<?php foreach ($photos['data'] as $photo) : ?>    
    <a href="<?php echo $photo['name']?>"><img title="<?php echo $photo['name']?>" alt="<?php echo $photo['name']?>" src="<?php echo $photo['picture']?>"></a>
<?php endforeach; ?>    
</div>
<?php
    }
    
    public function bootstrap() {
        ;
    }
}