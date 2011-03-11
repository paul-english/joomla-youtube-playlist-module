<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addScript('modules/mod_yt_playlist/tmpl/yt_playlist.js');
$document->addStylesheet('modules/mod_yt_playlist/tmpl/yt_playlist.css');

$i = 0;
$len = sizeof($list);

foreach ($list as $item) :	
    $id = $item->xpath('media:group/yt:videoid'); 
    if ($i == 0) : 
        ?>
		<div id="yt-player">
            <iframe class="youtube-player" type="text/html" width="640" height="385" src="http://www.youtube.com/embed/<?php echo $id[0]; ?>" frameborder="0"></iframe>
    		<div class="title"><?php echo $item->title; ?></div>
		</div>
        <ul id="yt-playlistitems">
	    <?php 
    endif;
    ?>
	<li data-id="<?php echo $id[0]; ?>" style="<?php if ($i >= $params->get('playlist-length')) echo "display:none;"; ?>" class="<?php if($i == 0) echo "active"; ?>">
        <a href="javascript:;" class="thumbnail">
		    <?php
   		    $thumb = $item->xpath('media:group/media:thumbnail');
            $thumb = $thumb[0]->xpath('@url');
		    ?>
            <img src="<?php echo $thumb[0]; ?>" />
		</a>
		<a href="javascript:;" class="title"><?php echo $item->title; ?></a>
		<div class="description">
	        <?php
	        $description = $item->xpath('media:group/media:description');
            echo $description[0];
            ?>
        </div>
        <div class="button">Watch Now</div>
	</li>
	<?php 
    $i++; 
endforeach; 
?>
</ul>
<?php 
$pages = ($len / $params->get('playlist-length')); 

if ($pages > 1) : ?>
<div id="yt-paging">
	<div class="back">
    	<a style="display:none;" href="javascript:;">Back</a>
	</div>
    <div class="pages">
    	<?php 
    	$i = 0;
        while($i++ < $pages) :
    		?>
    		<a href="javascript:;" class="<?php if ($i == 1) echo "active"; ?>"><?php echo $i; ?></a>
    	    <?php
    	endwhile;
    	?>
    </div>
	<div class="next">
    	<a href="javascript:;">Next</a>
	</div>
</div>
<?php endif; ?>