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

/**
 *
 */
class MeterManager
{
	/*
	 */
	public $aMeterList;

	static public $oInstance;

	private function __construct()
	{}

	static public function getInstance()
	{
		if(!self::$oInstance)
		{
			self::$oInstance=new MeterManager;
		}
		return self::$oInstance;
	}

	/**
	 *
	 */
	public function registerMeter(AbstractMeter $oMeter)
	{
		$this->aMeterList[$oMeter->getInstrumentId()][]=$oMeter;
	}

	/**
	 *
	 */
	public function processSensorData(Telemetry\Sensor\SensorDataPacket $oMutableData)
	{
		$sInstrumentId=$oMutableData->sInstrumentId;
		if(isset($this->aMeterList[$instrumentId]))
		{
			foreach($this->aMeterList[$instrumentId] as $oMeter)
			{
				$oMeter->onData($oMutableData);
			}
		}
	}
}
