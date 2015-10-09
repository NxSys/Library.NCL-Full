<?php
/**
 * Instrument Class
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
	public $oMeterManager;
	public $oDefaultMeterStorageHandler;

	public function __construct($sInstrumentId)
	{
		$this->sInstrumentId=$sInstrumentId;
		$this->sDefaultProcessor=new Processor\StubProcessor;
		$this->sDefaultProcessor->setInstrumentId($sInstrumentId);
		$this->oMeterManager=Telemetry\Meter\MeterManager::getInstance();
	}

	/**
	 * Create a sensor and adds it to this instrument's sensor group
	 * 
	 * @param string $sId id to name the sensor
	 * @param string $sUnit default unit of measure for the sensor
	 * @return Sensor
	 */
	public function createSensor($sId, $sUnit='event')
	{
		$sensor=new Sensor($sId, $this->sInstrumentId, $sUnit);
		$sensor->setProcessor($this->sDefaultProcessor);
		$this->attachSensor($sensor);
		return $sensor;
	}

	/**
	 * Attaches a sensor to this instrument's sensor group
	 *
	 * @param Sensor $oSensor Sensor to attached
	 * @return Sensor
	 */
	public function attachSensor(Sensor $oSensor)
	{
		$this->aSensorGroup[$oSensor->getSensorId()]=$oSensor;
		return $this->aSensorGroup[$oSensor->getSensorId()];
	}

	/**
	 * Sets a default MeterStorageHandler
	 *
	 * @param Telemetry\Meter\IMeterStorageHandler $oMeterStorageHandler
	 */
	public function setDefaultMeterStorageHandler(Telemetry\Meter\IMeterStorageHandler $oMeterStorageHandler)
	{
		$this->oDefaultMeterStorageHandler=$oMeterStorageHandler;
	}

	/**
	 * Sets or resets the default processor "chain head" for attached sensors
	 *
	 * @param Processor\AbstractProcessor $oProcessor
	 */
	public function setSensorGroupHeadProcessor(Processor\AbstractProcessor $oProcessor)
	{
		foreach($this->aSensorGroup as $sensor)
		{
			$sensor->setProcessor($oProcessor);
		}
		$this->sDefaultProcessor=$oProcessor;
	}
}
