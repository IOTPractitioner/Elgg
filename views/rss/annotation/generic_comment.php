<?php
/**
 * Elgg RSS view for a generic_comment annotation
 *
 * @package Elgg
 * @subpackage Core
 */

$annotation = $vars['annotation'];

$poster = $annotation->getOwnerEntity();
$poster_name = htmlspecialchars($poster->name, ENT_NOQUOTES, 'UTF-8');
$pubdate = date('r', $annotation->getTimeCreated());
$permalink = $annotation->getURL();

$title = elgg_echo('generic_comment:title', [$poster_name]);

$creator = elgg_view('page/components/creator', ['entity' => $annotation]);
$extensions = elgg_view('extensions/item', $vars);

$item = <<<__HTML
<item>
	<guid isPermaLink='true'>$permalink</guid>
	<pubDate>$pubdate</pubDate>
	<link>$permalink</link>
	<title><![CDATA[$title]]></title>
	<description><![CDATA[{$vars['annotation']->value}]]></description>
	$creator$extensions
</item>

__HTML;

echo $item;
