<?php
/**
 * Std DirectoryIterator class
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

// PHP names
use SplFileInfo as PHP_SplFileInfo;
use DirectoryIterator as PHP_DirectoryIterator;
use SeekableIterator;

/**
 * DirectoryIterator wrapper
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
 * @see \DirectoryIterator
 * @link http://php.net/manual/en/class.directoryiterator.php
 */
class DirectoryIterator extends SplFileInfo implements	IDirectoryIterator,
	SeekableIterator,
	NclIo\IhasTraitDecorating
{
	use NclIo\DecoratingTrait;

	/** ctor **/
	public function __construct($path)
	{
		$this->_refreshTarget(new PHP_DirectoryIterator($path));
	}

	/* Methods */
	//BEGIN-GENERATED
	public function current ()
	{
		$ret=$this->__call(__FUNCTION__, func_get_args());
		if($ret instanceof PHP_DirectoryIterator)
		{
			return self::_setTarget($ret);
		}
		return $ret;
	}

	public function getATime () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getBasename ( $suffix=null ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getCTime () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getExtension () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getFilename () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getGroup () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getInode () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getMTime () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getOwner () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getPath () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getPathname () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getPerms () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getSize () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getType () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isDir () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isDot () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isExecutable () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isFile () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isLink () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isReadable () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isWritable () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function key () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function next () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function rewind () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function seek ( $position ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function __toString () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function valid () { return $this->__call(__FUNCTION__, func_get_args()); }
	//END-GENERATED
}
