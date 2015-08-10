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
namespace NxSys\Library\Telemetry;

// Project Namespaces
use NxSys\Library\Telemetry,
	NxSys\Library\Telemetry\Sensor,
	NxSys\Library\Telemetry\Processor;

/**
 *
 */
class Instrument
{
	public $sInstrumentId;
	public $aSensorGroup;

	public $sDefaultProcessor;

	public function __construct($sInstrumentId)
	{
		$this->sInstrumentId=$sInstrumentId;
		$this->sDefaultProcessor=new Processor\StubProcessor;
		$this->sDefaultProcessor->setInstrumentId($sInstrumentId);
	}

	/**
	 *
	 * @return Sensor
	 */
	public function createSensor($sId, $sUnit='event')
	{
		$sensor=new Sensor($sId, $this->sInstrumentId, $sUnit);
		$sensor->setProcessor($this->sDefaultProcessor);
		$this->attachSensor($sensor);
		return $sensor;
	}

	public function attachSensor(Sensor $oSensor)
	{
		$this->aSensorGroup[$oSensor->getSensorId()]=$oSensor;
	}

	public function setSensorGroupHeadProcessor(Processor\AbstractProcessor $oProcessor)
	{
		foreach($this->aSensorGroup as $sensor)
		{
			$sensor->setProcessor($oProcessor);
		}
		$this->sDefaultProcessor=$oProcessor;
	}
}
