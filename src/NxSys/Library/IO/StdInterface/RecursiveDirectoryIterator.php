<?php
/**
 * Std RecursiveDirectoryIterator Class
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
use SplFileInfo as PHP_SplFileInfo;
use RecursiveDirectoryIterator as PHP_RecursiveDirectoryIterator;
use	SeekableIterator,
	RecursiveIterator;

/**
 * RecursiveDirectoryIterator wrapper
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
 * @see \RecursiveDirectoryIterator
 * @link http://php.net/manual/en/class.recursivedirectoryiterator.php
 */
class RecursiveDirectoryIterator extends FilesystemIterator implements	IRecursiveDirectoryIterator,
	SeekableIterator,
	RecursiveIterator,
	NclIo\IhasTraitDecorating
{
	/** allows decorating */
	use NclIo\DecoratingTrait;

	/** ctor **/
	public function __construct($path, $flags = NULL )
	{
		$this->_refreshTarget(new PHP_RecursiveDirectoryIterator($path, $flags));
	}

	/* Methods */
	//BEGIN-GENERATED
	public function current ()
	{
		$ret=$this->__call(__FUNCTION__, func_get_args());
		if($ret instanceof PHP_FilesystemIterator)
		{
			return FilesystemIterator::_setTarget($ret);
		}
		if($ret instanceof PHP_SplFileInfo)
		{
			return SplFileInfo::_setTarget($ret);
		}
		return $ret;
	}
	public function hasChildren ($allow_links = null) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getChildren () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getSubPath () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getSubPathname () { return $this->__call(__FUNCTION__, func_get_args()); }
	//END-GENERATED
}
