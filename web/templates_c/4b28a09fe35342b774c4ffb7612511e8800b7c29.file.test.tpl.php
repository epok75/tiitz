<?php /* Smarty version Smarty-3.1.12, created on 2012-12-18 01:10:01
         compiled from "/Applications/MAMP/htdocs/tiitz/src/test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78061723950cfb1524e5434-58152030%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b28a09fe35342b774c4ffb7612511e8800b7c29' => 
    array (
      0 => '/Applications/MAMP/htdocs/tiitz/src/test.tpl',
      1 => 1355789398,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78061723950cfb1524e5434-58152030',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50cfb15259b4c1_43700794',
  'variables' => 
  array (
    'name' => 0,
    'prenom' => 0,
    'renseignement' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50cfb15259b4c1_43700794')) {function content_50cfb15259b4c1_43700794($_smarty_tpl) {?><p>Hello world, ceci est un template smarty!!!!</p>
<p>Name : <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</p>
<p>Prenom : <?php echo $_smarty_tpl->tpl_vars['prenom']->value;?>
</p>
<p>Renseignement : adresse <?php echo $_smarty_tpl->tpl_vars['renseignement']->value['adresse'];?>
 // Ville <?php echo $_smarty_tpl->tpl_vars['renseignement']->value['ville'];?>
</p><?php }} ?>