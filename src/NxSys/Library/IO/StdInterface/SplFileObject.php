<?php
/**
 * Std SplFileObject Class
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
use SplFileObject as PHP_SplFileObject;
use	RecursiveIterator,
	SeekableIterator;

/**
 * SplFileObject wrapper
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
 * @see \SplFileObject
 * @link http://php.net/manual/en/class.splfileobject.php
 */
class SplFileObject extends SplFileInfo implements	ISplFileObject,
	RecursiveIterator,
	SeekableIterator,
	NclIo\IhasTraitDecorating
{
	use NclIo\DecoratingTrait;

	const DROP_NEW_LINE  = 1 ;
	const READ_AHEAD  = 2 ;
	const SKIP_EMPTY  = 4 ;
	const READ_CSV  = 8 ;

	//* ctor *//
	public function __construct($filename, $open_mode = "r", $use_include_path = false, $context=null)
	{
		$object=new PHP_SplFileObject($filename, $open_mode = "r", $use_include_path = false, $context=null);
		$this->_refreshTarget($object);
	}

	/* Methods */
	//BEGIN-GENERATED
	public function current ()		{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function eof ()		{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function fflush ()		{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function fgetc ()		{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function fgetcsv ($delimiter = "," , $enclosure = "\"" , $escape = "\\" )
	{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function fgets ()			{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function fgetss ($allowable_tags) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function flock ( $operation , &$wouldblock ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function fpassthru () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function fputcsv (  $fields ,  $delimiter = "," ,  $enclosure = '"' ,  $escape = "\\" )
	{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function fread ( $length ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function fscanf ( $format ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function fseek ( $offset ,$whence = self::SEEK_SET  ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function fstat () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function ftell () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function ftruncate (  $size ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function fwrite ( $str , $length  ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getChildren () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getCsvControl () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getFlags () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function getMaxLineLen () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function hasChildren () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function key () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function next () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function rewind () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function seek ( $line_pos ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function setCsvControl ($delimiter = "," , $enclosure = "\"", $escape = "\\" )
	{ return $this->__call(__FUNCTION__, func_get_args()); }
	public function setFlags ( $flags ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function setMaxLineLen ( $max_len ) { return $this->__call(__FUNCTION__, func_get_args()); }
	public function __toString () { return $this->__call(__FUNCTION__, func_get_args()); }
	public function valid () { return $this->__call(__FUNCTION__, func_get_args()); }
	//END-GENERATED
}
