<?php
/**
 * Std ISplTempFileObject Interface
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
 * Interface for SplTempFileObject
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
 * @see \SplTempFileObjectss
 * @link http://php.net/manual/en/class.spltempfileobject.php
 */
interface ISplTempFileObject extends ISplFileObject
{
	/* ctor */
	public function __construct($max_memory);
}
