<div id="currentError" style="display:none;">
	<div class="modal-body">
		<?php 
			foreach (DebugTool::$errorExtend->getTemplateHTMLError() as $value) {
				print $value;
			}
		?>
	</div>
</div>