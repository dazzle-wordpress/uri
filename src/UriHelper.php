<?php
declare(strict_types=1);

/**
 * Part of the Dazzle WordPress URI Package.
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Dazzle.WordPress
 * @subpackage URI
 * @author     Dazzle Software <support@dazzlesoftware.org>
 * @copyright  Copyright (C) 2018 - 2020 Dazzle Software, LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.md
 * @link       https://github.com/dazzle-wordpress/uri
 * @since      1.0.0
 */

namespace Dazzle\Uri;

/**
 * Uri Helper
 *
 * This class provides a UTF-8 safe version of parse_url().
 *
 * @since  1.0
 */
class UriHelper
{
	/**
	 * Does a UTF-8 safe version of PHP parse_url function
	 *
	 * @param   string  $url  URL to parse
	 *
	 * @return  array|boolean  Associative array or false if badly formed URL.
	 *
	 * @link    https://www.php.net/manual/en/function.parse-url.php
	 * @since   1.0
	 */
	public static function parse_url($url)
	{
		$result = false;

		// Build arrays of values we need to decode before parsing
		$entities     = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", '(', ')', ';', ':', '@', '&', '=', '$', ',', '/', '?', '#', '[', ']');

		// Create encoded URL with special URL characters decoded so it can be parsed
		// All other characters will be encoded
		$encodedURL = str_replace($entities, $replacements, urlencode($url));

		// Parse the encoded URL
		$encodedParts = parse_url($encodedURL);

		// Now, decode each value of the resulting array
		if ($encodedParts)
		{
			foreach ($encodedParts as $key => $value)
			{
				$result[$key] = urldecode(str_replace($replacements, $entities, $value));
			}
		}

		return $result;
	}
}
