<?php
/**
 * Std SplFileInfo Class
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
use SplFileObject as PHP_SplFileObject;

/**
 * SplFileInfo wrapper
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
 * @see \SplFileInfo
 * @link http://php.net/manual/en/class.splfileinfo.php
 */
class SplFileInfo implements	ISplFileInfo,
	NclIo\IhasTraitDecorating
{
	use NclIo\DecoratingTrait;

	/* ctor */
	public function __construct($file_name)
	{
		$this->_refreshTarget(new PHP_SplFileInfo($file_name));
	}

	/* Methods */
	//BEGIN-GENERATED
	public function getATime ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getBasename ($suffix=null) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getCTime ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getExtension ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getFileInfo ($class_name=null)
	{
		$ret=$this->__call(__FUNCTION__, func_get_args());
		if($ret instanceof PHP_SplFileInfo)
		{
			return self::_setTarget($ret);
		}
		return $ret;
	}

	public function getFilename ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getGroup ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getInode ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getLinkTarget ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getMTime ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getOwner ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getPath ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getPathInfo ($class_name=null)
	{
		$ret=$this->__call(__FUNCTION__, func_get_args());
		if($ret instanceof PHP_SplFileInfo)
		{
			return self::_setTarget($ret);
		}
		return $ret;
	}
	public function getPathname ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getPerms ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getRealPath ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getSize ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getType ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isDir ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isExecutable ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isFile ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isLink ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isReadable ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function isWritable ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function openFile ($open_mode="r", $use_include_path = false, $context = NULL)
	{
		$ret=$this->__call(__FUNCTION__, func_get_args());
		if($ret instanceof PHP_SplFileObject)
		{
			return SplFileObject::_setTarget($ret);
		}
		return $ret;
	}
	public function setFileClass ($class_name) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function setInfoClass ($class_name) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function __toString ( ) { return $this->__call(__FUNCTION__, func_get_args()); }
	//END-GENERATED
}
