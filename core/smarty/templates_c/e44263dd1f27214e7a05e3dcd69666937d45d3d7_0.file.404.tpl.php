<?php
/* Smarty version 3.1.30, created on 2017-07-16 16:19:45
  from "/Volumes/DATA500/00_Windows/Documents/PhpStormProjects/BrainProject/templates/mainTemplate/404.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_596b67f1d0ef71_05385420',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e44263dd1f27214e7a05e3dcd69666937d45d3d7' => 
    array (
      0 => '/Volumes/DATA500/00_Windows/Documents/PhpStormProjects/BrainProject/templates/mainTemplate/404.tpl',
      1 => 1500211183,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_596b67f1d0ef71_05385420 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if ($_smarty_tpl->tpl_vars['title']->value) {
echo $_smarty_tpl->tpl_vars['title']->value;
}?></title>
</head>
<body>
<h1><?php if ($_smarty_tpl->tpl_vars['title']->value) {
echo $_smarty_tpl->tpl_vars['title']->value;
}?></h1>
<?php if ($_smarty_tpl->tpl_vars['content']->value) {?>
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }?>
</body>
</html><?php }
}
