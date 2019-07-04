<?php
/**
 * NAME
 *
 * $Id$
 * DESCRIPTION
 *
 * @link http://nxsys.org/spaces/onx/wiki/Nexus_Common_Library
 * @package NxSys.Library\Data-Telemetry
 * @license http://nxsys.org/spaces/onx/wiki/License
 * Please see the license.txt file or the url above for full copyright and license information.
 * @copyright Copyright 2019 Nexus Systems, Inc.
 *
 * @author Chris R. Feamster <cfeamster@nxsysts.com>
 * @author $LastChangedBy$
 *
 * @version $Revision$
 */

/** Local Namespace **/
namespace NxSys\Library\Data\Telemetry\Processor;

// Project Namespaces
use NxSys\Library\Data\Telemetry\Sensor;

// 3rdParty Namespaces
use SplQueue;

/**
 *
 */
class CallableQueueProcessor extends AbstractProcessor
{
	/* @var SplQueue
	 */
	public $aCallableQueue;

	public function __construct()
	{
		$this->aCallableQueue=new SplQueue;
	}

	/**
	 *
	 * @return CallableQueueProcessor
	 */
	public function addCallable(callable $hUserOperation)
	{
		$this->aCallableQueue->enqueue($hUserOperation);
		return $this;
	}

	public function process(Sensor\SensorDataPacket &$oMutableData)
	{
		foreach($this->aCallableQueue as $callable)
		{
			if(!$this->verifyCallableSignature($callable))
			{
				throw new ProcessorRuntimeException();
			}
			call_user_func($callable, $oMutableData);
		}
	}

	public function verifyCallableSignature(callable $hUserOperation)
	{
		return false;
	}
}
