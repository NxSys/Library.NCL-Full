<?php
/**
 * Std FilesystemIterator Class
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

//PHP Names
use SplFileInfo as PHP_SplFileInfo;
use FilesystemIterator as PHP_FilesystemIterator;
use SeekableIterator;

/**
 * FilesystemIterator wrapper
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
 * @see \FilesystemIterator
 * @link http://php.net/manual/en/class.filesystemiterator.php
 */
class FilesystemIterator extends DirectoryIterator implements	IFilesystemIterator,
	SeekableIterator,
	NclIo\IhasTraitDecorating
{
	use NclIo\DecoratingTrait;

	/* Constants */
	const	CURRENT_AS_PATHNAME	= 32,
		CURRENT_AS_FILEINFO	= 0,
		CURRENT_AS_SELF	= 16,
		CURRENT_MODE_MASK	= 240,
		KEY_AS_PATHNAME	= 0,
		KEY_AS_FILENAME	= 256 ,
		FOLLOW_SYMLINKS	= 512 ,
		KEY_MODE_MASK	= 3840 ,
		NEW_CURRENT_AND_KEY	= 256 ,
		SKIP_DOTS	= 4096 ,
		UNIX_PATHS	= 8192;

	/** ctor **/
	public function __construct($path, $flags = NULL )
	{
		$this->_refreshTarget(new PHP_FilesystemIterator($path, $flags));
	}

	/* Methods */
	//BEGIN-GENERATED
	public function current ()
	{
		$ret=$this->__call(__FUNCTION__, func_get_args());
		if($ret instanceof PHP_FilesystemIterator)
		{
			return self::_setTarget($ret);
		}
		if($ret instanceof PHP_SplFIleinfo)
		{
			return SplFileInfo::_setTarget($ret);
		}
		return $ret;
	}
	public function getFlags() { return $this->__call(__FUNCTION__, func_get_args()); }
	public function key() { return $this->__call(__FUNCTION__, func_get_args()); }
	public function next() { return $this->__call(__FUNCTION__, func_get_args()); }
	public function rewind() { return $this->__call(__FUNCTION__, func_get_args()); }
	public function setFlags($flags=NULL) { return $this->__call(__FUNCTION__, func_get_args()); }
	//END-GENERATED
}
