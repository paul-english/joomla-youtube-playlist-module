<?php
/**
* @version		$Id: helper.php 15200 2010-03-05 09:12:56Z ian $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class modYtPlaylistHelper
{
	function getList($params)
	{
		$url = "http://gdata.youtube.com/feeds/api/playlists/". $params->get('playlistid','') ."?v=2";

		$cache = & JFactory::getCache('yt_playlist');
		$cache->setCaching(1);
		$cache->setLifeTime(3600);

		$xml = $cache->call('file_get_contents', $url);

		$response = simplexml_load_string($xml);

		return $response->entry;
	}

}
