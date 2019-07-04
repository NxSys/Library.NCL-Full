<?php
/**
 * Std GlobIterator Class
 *
 * $Id$
 *
 * @link http://nxsys.org/spaces/onx/wiki/Nexus_Common_Library
 * @package NxSys.Library\IO
 * @license http://nxsys.org/spaces/onx/wiki/License
 * Please see the license.txt file or the url above for full copyright and license information.
 * @copyright Copyright 2016 Nexus Systems, Inc.
 *
 * @author Chris R. Feamster <cfeamster@nxsysts.com>
 * @author $LastChangedBy$
 *
 * @version $Revision$
 */

/** Local Namespace **/
namespace NxSys\Library\IO\StdInterface;

// Project Namespaces
use NxSys\Library\IO as NclIo;

// PHP Names
use GlobIterator as PHP_GlobIterator;
use	SeekableIterator,
	Countable;

/**
 * GlobIterator wrapper
 *
 * This class is technically a wrapper (or facade) for the internal PHP class.
 * It also serves as a concretion of the respective interface so that its type
 * may be used without having to create a reference class yourself.
 *
 * This class will implement a trait that allows direct proxying of calls to an
 * underlying target object. Regardless of that magic, methods are "implemented"
 * (but stubbed) so as to formally fulfill the contract required by the interface.
 *
 * Occasionally if an internal method returns one of these wrapped objects it
 * will be *rewrapped* before beings returned.
 *
 * @see \GlobIterator
 * @link http://php.net/manual/en/class.globiterator.php
 */
class GlobIterator extends FilesystemIterator implements	IGlobIterator,
	SeekableIterator,
	Countable,
	NclIo\IhasTraitDecorating
{
	use NclIo\DecoratingTrait;

	/** ctor **/
	public function __construct($path, $flags = NULL )
	{
		$this->_refreshTarget(new PHP_GlobIterator($path, $flags));
	}

	/* Methods */
	public function count ()
	{
		return $this->__call(__FUNCTION__, func_get_args());
	}
}
