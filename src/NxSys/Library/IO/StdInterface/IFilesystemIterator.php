<?php
/**
 * Std IFilesystemIterator Interface
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
 * Constants for IFilesystemIterator
 *
 * With constants in interfaces being a bit of an antipattern,
 * and also the usage of such interface constances leading to odd errors
 * for implementators (@see phpbug#63359) we have placed then here.
 * Also defined in the Std implementation.
 * @see \FilesystemIterator
 */
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

/**
 * Interface for FilesystemIterator
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
 * @see \FilesystemIterator
 * @link http://php.net/manual/en/class.filesystemiterator.php
 */
interface IFilesystemIterator extends IDirectoryIterator
{
	/* Methods */
	public function current();
	public function getFlags();
	public function key();
	public function next();
	public function rewind();
	public function setFlags($flags=NULL);
}
