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

// Project Namespace
use NxSys\Library\Data\Telemetry;

// 3rdParty Namespaces
//use SplPriorityQueue;

/**
 * AbstractProcessor
 */
abstract class AbstractProcessor implements Telemetry\Sensor\ISensorDataProcessor
{
	/**
	 * @var AbstractProcessor
	 */
	public $oNextProcessor=null;
	public $sInstrumentId=null;
	static public $aUltimateProcessor=[];

	/**
	 *
	 */
	public final function setUltimateProcessor(Telemetry\Sensor\ISensorDataProcessor $oUltimateProcessor, $sInstrumentId=null)
	{
		if(!$sInstrumentId)
		{
			$sInstrumentId=$this->sInstrumentId;
		}
		self::$aUltimateProcessor[$sInstrumentId]=$oUltimateProcessor;
		return;
	}

	/**
	 *
	 */
	public function setInstrumentId($sInstrumentId)
	{
		$this->sInstrumentId=$sInstrumentId;
		return;
	}

	/**
	 *
	 *
	 */
	public final function processSensorData(Telemetry\Sensor\SensorDataPacket $oMutableData)
	{
		//
		$sInstrumentId=$oMutableData->sInstrumentId;
		if($sInstrumentId==$this->sInstrumentId)
		{
			$this->process($oMutableData);
		}

		//
		if(!$this->oNextProcessor)
		{
			//meter time
			if(!isset(self::$aUltimateProcessor[$this->sInstrumentId]))
			{
				self::$aUltimateProcessor[$this->sInstrumentId]=Telemetry\Meter\MeterManager::getInstance();
			}
			if(!$this===self::$aUltimateProcessor[$this->sInstrumentId])
			{
				//if we're using the UP then we should quit
				self::$aUltimateProcessor[$this->sInstrumentId]->processSensorData($oMutableData);
			}
			return;
		}
		$this->oNextProcessor->processSensorData($oMutableData); //ad infinitum
		return;
	}

	/**
	 * @return AbstractProcessor
	 */
	public function setNextProcessor(AbstractProcessor $oProcessor)
	{
		$oProcessor->setInstrumentId($this->sInstrumentId);
		return $this->oNextProcessor=$oProcessor;
	}

	/**
	 *
	 * Note: while processing, do not change the sInstrumentId.
	 * You could foul the execution of the UltimateProcessor!
	 *
	 */
	abstract protected function process(Telemetry\Sensor\SensorDataPacket &$oMutableData);
}
