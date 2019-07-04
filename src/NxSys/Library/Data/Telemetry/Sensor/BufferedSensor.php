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
namespace NxSys\Library\Data\Telemetry\Sensor;

// Project Namespaces
use NxSys\Library\Data\Telemetry;

// 3rdParty Namespaces
//use Some\Other\Project;

/**
 *
 */
class BufferedSensor extends Telemetry\Sensor
{
	/**
	 *
	 */
	public function addContext($sContextName, $mContextValue)
	{
		$this->oDataPacket->aContexts->enqueue([$sContextName, $mContextValue]);
		$ctxid=$this->oDataPacket->aContexts->count()-1;
		$this->oDataPacket->aCurrentContexts[]=$ctxid;
		return $ctxid;
	}

	/**
	 *
	 */
	public function removeContext($hContext)
	{
		if(array_key_exists($hContext, $this->oDataPacket->aCurrentContexts))
		{
			unset($this->oDataPacket->aContexts[$hContext]);
		}
		return;
	}

	/**
	 *
	 */
	public function addMeasurement(Measurement $oMeasurement)
	{
		$this->aMeasurements->enqueue($oMeasurement);
		//check buffer stragety
	}

	/**
	 *
	 */
	public function setBufferStrategy()
	{

	}

}
