<?php  
require_once 'core/database/connect2.php';

	

?>
<!DOCTYPE html>
<html>
<?php require_once 'head.php'; ?>
<body> 
<div class="top-main" id="home">
<?php require_once 'header-top.php'; ?>  
<?php require_once 'carousel.php'; ?> 
</div> 
<?php require_once 'popUp.php'; ?>  
<?php require_once 'featured/featuredProjects.php'; ?>  
<?php require_once 'team.php'; ?> 
<?php require_once 'gallerypage.php'; ?> 
<?php require_once 'footer.php'; ?> 
<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<?php require_once 'footerScripts.php'; ?> 
</body>
</html>