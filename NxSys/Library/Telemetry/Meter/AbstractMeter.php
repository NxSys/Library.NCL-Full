<?php
/**
 * NAME
 *
 * $Id$
 * DESCRIPTION
 *
 * @link http://nxsys.org/spaces/onx/wiki/Nexus_Common_Library
 * @package NxSys.Library\Telemetry
 * @license http://nxsys.org/spaces/onx/wiki/License
 * Please see the license.txt file or the url above for full copyright and license information.
 * @copyright Copyright 2015 Nexus Systems, Inc.
 *
 * @author Chris R. Feamster <cfeamster@nxsysts.com>
 * @author $LastChangedBy$
 *
 * @version $Revision$
 */

/** Local Namespace **/
namespace NxSys\Library\Telemetry\Meter;

// Project Namespaces
use NxSys\Library\Telemetry;

// 3rdParty Namespaces
use Some\Other\Project;

/**
 *
 */
class AbstractMeter
{
	public $sMeterId;
	public $sInstrumentId;
	public function __construct($sMeterId, $sInstrumentId=null)
	{
		$this->sMeterId=$sMeterId;
		$this->sInstrumentId=$sInstrumentId;
	}

	public final function processSensorData(Telemetry\Sensor\SensorDataPacket $oMutableData)
	{
		$this->onData($oMutableData);
		return;
	}

	/**
	 * @api
	 */
	public abstract function onData(Telemetry\Sensor\SensorDataPacket $oMutableData);

	public function getMeterId()
	{
		return $this->sMeterId;
	}

	public function getInstrumentId()
	{
		return $this->sInstrumentId;
	}
}
