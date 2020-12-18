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
 * Uri Class
 *
 * This is an immutable version of the uri class.
 *
 * @since  1.0
 */
final class UriImmutable extends AbstractUri
{
	/**
	 * @var    boolean  Has this class been instantiated yet.
	 * @since  1.0
	 */
	private $constructed = false;

	/**
	 * Prevent setting undeclared properties.
	 *
	 * @param   string  $name   This is an immutable object, setting $name is not allowed.
	 * @param   mixed   $value  This is an immutable object, setting $value is not allowed.
	 *
	 * @return  void  This method always throws an exception.
	 *
	 * @since   1.0
	 * @throws  \BadMethodCallException
	 */
	public function __set($name, $value)
	{
		throw new \BadMethodCallException('This is an immutable object');
	}

	/**
	 * This is a special constructor that prevents calling the __construct method again.
	 *
	 * @param   string  $uri  The optional URI string
	 *
	 * @since   1.0
	 * @throws  \BadMethodCallException
	 */
	public function __construct($uri = null)
	{
		if ($this->constructed === true)
		{
			throw new \BadMethodCallException('This is an immutable object');
		}

		$this->constructed = true;

		parent::__construct($uri);
	}
}
