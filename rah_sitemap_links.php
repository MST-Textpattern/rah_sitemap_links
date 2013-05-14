<?php

/**
 * Links module for rah_sitemap.
 * 
 * @package   rah_sitemap
 * @author    Jukka Svahn
 * @copyright (c) 2012 Jukka Svahn
 * @license   GLPv2
 * @link      https://github.com/gocom/rah_sitemap__links
 */

class rah_sitemap__links
{
	/**
	 * Constructor.
	 */

	public function __construct()
	{
		register_callback(array($this, 'urlset'), 'rah_sitemap.urlset');
	}

	/**
	 * Adds links to the sitemap.
	 */

	public function urlset()
	{
		$local = str_replace(array('%', '_'), array('\\%', '\\_'), doSlash(hu));

		$rs = safe_rows_start(
			'url, date',
			'txp_link',
			"category = 'rah_sitemap' or url like '".$local."_%' or url like '/_%'"
		);

		if ($rs)
		{
			while ($a = nextRow($rs))
			{
				rah_sitemap::get()->url($a['url'], $a['date']);
			}
		}
	}
}

new rah_sitemap__links();