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
namespace NxSys\Library\Telemetry\Processor;

// Project Namespace
use NxSys\Library\Telemetry,
	NxSys\Library\Telemetry\Meter,
	NxSys\Library\Telemetry\Sensor;

// 3rdParty Namespaces
use SplPriorityQueue;

/**
 * AbstractProcessor
 */
abstract class AbstractProcessor
{
	/* @var AbstractProcessor
	 */
	public $oNextProcessor;
	public $oUltimateProcessor;

	public function processSensorData(Sensor\SensorDataPacket $mMutableData)
	{
		$this->process($mMutableData);
		if(!$this->oNextProcessor)
		{
			//meter time
			if(!$this->oUltimateProcessor)
			{
				$this->oUltimateProcessor=new Meter\MeterDispatcher;
			}
			$this->oNextProcessor=$this->oUltimateProcessor;
		}
		$this->oNextProcessor->processSensorData($mMutableData); //ad infinitum
	}

	public function setNextProcessor(AbstractProcessor $oProcessor)
	{
		$this->oNextProcessor=$oProcessor;
	}

	abstract function process(Sensor\SensorDataPacket &$mMutableData);
}
