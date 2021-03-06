<?php
/**
 * Get a list of Goods or Categories for cobmobox
 *
 * @package minishop
 * @subpackage processors
 */
if (!$modx->hasPermission('view')) {return $modx->error->failure($modx->lexicon('ms.no_permission'));}

// Getting ids of templates
$categories_tpls = explode(',', $modx->getOption('minishop.categories_tpl', '', 1));
$goods_tpls = explode(',', $modx->getOption('minishop.goods_tpl', '', 1));

// Getting variables
$isLimit = !empty($scriptProperties['limit']);
$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,round($modx->getOption('default_per_page') / 2));
$sort = $modx->getOption('sort',$scriptProperties,'pagetitle');
$dir = $modx->getOption('dir',$scriptProperties,'ASC');
$query = $modx->getOption('query', $scriptProperties, 0);
$mode = $modx->getOption('mode', $scriptProperties, 'category');
$addall = $scriptProperties['addall'] ? 1 : 0;

// Starting new query
$c = $modx->newQuery('modResource', array('deleted:!=' => 1));
$c->select('id,pagetitle,parent');

// Depending on the mode refine query
if ($mode == 'category') {
	$c->where(array('template:IN' => $categories_tpls));
}
else if ($mode == 'goods') {
	$c->where(array('template:IN' => $goods_tpls));
}
else if ($mode == 'kits') {
	$c->where(array('template:NOT IN' => $categories_tpls));
}

// Filtering by name
if (!empty($query)) {
	$c->andCondition(array('pagetitle:LIKE' => '%'.$query.'%'));
}

// Getting count of results
$count = $modx->getCount('modResource',$c);
$c->sortby($sort,$dir);

// Setting limit for query
if ($isLimit) {$c->limit($limit,$start);}

// Getting collection
$res = $modx->getCollection('modResource',$c);

// Pre-processing of results
$tmp = array();
foreach ($res as $v) {
	$id = $v->get('id');
	$parent = $v->get('parent');
	// If it is nested category - adding name of parent
	if ($mode == 'category' && $tmp2 = $modx->getObject('modResource', array('id' => $parent, 'template:IN' => $categories_tpls))) {
		$pagetitle = $tmp2->get('pagetitle') . ' - ' . $v->get('pagetitle');
	}
	else {$pagetitle = $v->get('pagetitle');}
	
	$tmp[$id] = $pagetitle;
}
// Sorting array by name of items
asort($tmp);

// Adding "addall" item if needed
if ($addall && empty($query) && empty($start)) {
	$arr = array(array('id' => 0, 'pagetitle' => $modx->lexicon('ms.combo.all')));
}
else {$arr = array();}

// Final proccessing of items
foreach ($tmp as $k => $v) {
	$arr[]= array('id' => $k,'pagetitle' => $v);
}

return $this->outputArray($arr,$count);
