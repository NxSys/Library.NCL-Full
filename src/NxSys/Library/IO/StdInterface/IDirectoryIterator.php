<?php
/**
 * Std IDirectoryIterator Interface
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
 * Interface for DirectoryIterator
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
 * @see \DirectoryIterator
 * @link http://php.net/manual/en/class.directoryiterator.php
 */
interface IDirectoryIterator extends ISplFileInfo
{
	/* Methods */
	public function current ();
	public function getATime ();
	public function getBasename ( $suffix=null );
	public function getCTime ();
	public function getExtension ();
	public function getFilename ();
	public function getGroup ();
	public function getInode ();
	public function getMTime ();
	public function getOwner ();
	public function getPath ();
	public function getPathname ();
	public function getPerms ();
	public function getSize ();
	public function getType ();
	public function isDir ();
	public function isDot ();
	public function isExecutable ();
	public function isFile ();
	public function isLink ();
	public function isReadable ();
	public function isWritable ();
	public function key ();
	public function next ();
	public function rewind ();
	public function seek ( $position );
	public function __toString ();
	public function valid ();
}
