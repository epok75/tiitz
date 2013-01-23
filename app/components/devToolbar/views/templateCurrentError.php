<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    	<h3 id="myModalLabel">Tiitz error</h3>
  	</div>
  	<div class="modal-body">
	<?php $arrayError 	= tzErrorCore::getTemplateError(); ?>
	<?php $arrayCode 	= tzErrorCore::getTemplateCodePhp(); ?>
	<?php 
		for ($i=0; $i < count($arrayError); $i++) { 
			print $arrayError[$i];
			print $arrayCode[$i];
		}
	 ?>
	</div>
	<div class="modal-footer">
    	<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  	</div>
</div>
