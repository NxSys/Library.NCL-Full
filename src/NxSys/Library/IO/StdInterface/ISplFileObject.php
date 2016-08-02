<?php
/**
 * Std ISplFileObject Interface
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

/**
 * Constants for SplFileObject
 *
 * With constants in interfaces being a bit of an antipattern,
 * and also the usage of such interface constances leading to odd errors
 * for implementators (@see phpbug#63359) we have placed then here.
 * Also defined in the Std implementation.
 * @see SplFileObject
 */
const 	DROP_NEW_LINE	= 1,
	READ_AHEAD	= 2,
	SKIP_EMPTY	= 4 ,
	READ_CSV	= 8 ;

/**
 * Interface for SplFileObject
 *
 * This interface is an extraction of the prototype (contract) from the
 * respective class and exposes it as standard interface. It allows you to
 * 1) typehint on this interface and not miscellaneous concretions and
 * 2) augment and replace code with standard OOP hierarchies. Essentially we're
 * making these classes a little more SOLID.
 *
 * Note: While the presence of this interface (and related concretions) you can
 * now easily experiment with partial extensions of the decorated base class.
 * You are encouraged to do so, but do so with care as not all of the internal's
 * operation is well documented...
 *
 * @see \SplFileObject
 * @link http://php.net/manual/en/class.splfileobject.php
 */
interface ISplFileObject extends ISplFileInfo
{

	/* Methods */
	public function current ();
	public function eof ();
	public function fflush ();
	public function fgetc ();
	public function fgetcsv ($delimiter = "," , $enclosure = "\"" , $escape = "\\" );
	public function fgets ();
	public function fgetss ($allowable_tags);
	public function flock ( $operation , &$wouldblock );
	public function fpassthru ();
	public function fputcsv ( $fields , $delimiter = "," , $enclosure = '"' , $escape = "\\" );
	public function fread ( $length );
	public function fscanf ( $format );
	public function fseek ( $offset ,$whence = self::SEEK_SET  );
	public function fstat ();
	public function ftell ();
	public function ftruncate ( $size );
	public function fwrite ( $str , $length  );
	public function getChildren ();
	public function getCsvControl ();
	public function getFlags ();
	public function getMaxLineLen ();
	public function hasChildren ();
	public function key ();
	public function next ();
	public function rewind ();
	public function seek ( $line_pos );
	public function setCsvControl ($delimiter = "," , $enclosure = "\"", $escape = "\\" );
	public function setFlags ( $flags );
	public function setMaxLineLen ( $max_len );
	public function __toString ();
	public function valid ();
}
