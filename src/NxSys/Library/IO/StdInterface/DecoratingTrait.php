<?php
/**
 * #####
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

use ReflectionClass as RefClass;
use InvalidArgumentException as IVAX;
/**
 * Trait that allows the using object to (somewhat) transparently decorate the Target
 *
 * Note: This does does not yet do two important things.
 * <ol>
 *  <li> Allow 100% same behavior for statics. a) php doesn't allow static member
 *  magic and b) even supporting __callStatic turned up a stackoverflow in a
 *  few odd edge (error) cases. (If we're going to fail we need to fail
 *  predictably!)</li>
 *
 *  <li> Preemptive error handling to clarify what happens when using invalid labels (names)</li>
 * </ol>
 * Note: Wrapping objects containing __call magic is not "strictly" supported. Does 
 *  this affect a use case of yours? Let us know!
 * @todo proper staic support
 * @todo richer error handling
 * @see IhasTraitDecorating
 * @author Chris R. Feamster <cfeamster@nxsysts.com>
 */
trait DecoratingTrait
{
	/* @var object Decorated object */
	protected $_oTargetObject;

	/* @var array Decorated object's operations */
	protected $_aTargetObjectOperations;

	public function __get($sLabel)
	{
		return $this->_oTargetObject->$sLabel;
	}

	public function __set($sLabel, $mValue)
	{
		return $this->_oTargetObject->$sLabel=$mValue;
	}

	public function __isset($sLabel)
	{
		return isset($this->_oTargetObject->$sLabel);
	}

	public function __unset($sLabel)
	{
		unset($this->_oTargetObject->$sLabel);
	}

	public function __call($sMethName, $aArgs=[])
	{
		if(!in_array($sMethName, $this->_aTargetObjectOperations))
		{
			throw new IVAX($sMethName.'() is not a valid method on '.get_class($this->_oTargetObject));
		}
		return call_user_func_array([$this->_oTargetObject, $sMethName], (array)$aArgs);
	}

	/**
	 * Configures the decoration target
	 *
	 * and returns a newly configured instance. Here we assume the target is
	 * constructed already (it must be) so we "skip" our own constructor
	 * @param object $oTarget the target of decoration
	 * @return object a new "self" with a new target
	 */
	public static function _setTarget($oTarget)
	{
		if(!is_object($oTarget))
		{
			throw new IVAX(sprintf('%s is not an object. An object is required.', $oTarget));
		}
		//its either reflection or double wrapped objects, so...
		//wasting a O(1) function call is better then clogging the stack, right?
		$object=(new RefClass(__CLASS__))->newInstanceWithoutConstructor();
		$object->_refreshTarget($oTarget);
		return $object;
	}

	/**
	 * Allows refreshing of the target.
	 * @param object $oTarget the target
	 * @return object new targeted object
	 */
	protected function _refreshTarget($oTarget)
	{
		if(!is_object($oTarget))
		{
			throw new IVAX(sprintf('Unable to refresh. An object is required.', $oTarget));
		}
		$this->_aTargetObjectOperations=get_class_methods($oTarget);
		return $this->_oTargetObject=$oTarget;
	}
}
