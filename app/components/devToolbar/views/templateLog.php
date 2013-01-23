<div id="myLogError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    	<h3 id="myModalLabel">Log file</h3>
	</div>
	<div class="modal-body">
		<?php for ($i=0; $i < count($errorArray); $i++) : ?> 
  		<div <?php ($i%2 == 0) ? print "class='odd'" : print "class='even'" ?>>
  			<p><strong>Date </strong>: <?php print $errorArray[$i]['date']; ?> | <strong>Num&eacute;ro erreur </strong>: <?php print $errorArray[$i]['type']; ?></p>
  			<p><strong>Message </strong>: <?php print $errorArray[$i]['message']; ?></p>
  			<p><strong>File </strong>: <?php print $errorArray[$i]['file']; ?> | <strong>Ligne </strong>: <?php print $errorArray[$i]['line']; ?></p>
  		</div>		
  	<?php endfor ?>
	</div>
	<div class="modal-footer">
  	<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
	</div>
</div>