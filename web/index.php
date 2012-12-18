<?php
define('ROOT', realpath(__dir__.'/..'));
//var_dump(ROOT);

if (file_exists(ROOT.'/app/components/views.class.php')) {
	require_once ROOT.'/app/components/views.class.php';

	$tplEngine = Render::getInstance('smarty');
	// call method to insert your template
	$tplEngine->run('test', array('name'=>'arnaud',
										'prenom'=>'raulet',
										'renseignement' => array('adresse' => '44 rue de la federation','ville' => 'Montreuil'))); 
	
	// $tplEngine->run('test');
	print('<pre>');
		var_dump($tplEngine->getRender());
	print('</pre>');

} else {
	print ROOT.'/app/components/views.class.php';
}
