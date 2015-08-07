<?php
/**
 * Telemetry Service
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
	NxSys\Library\Telemetry\Sensor;

// 3rdParty Namespaces
use SplQueue;

/**
 *
 */
class Sensor
{
	public $sSensorId;
	public $sInstrumentId;
	public $oProcessor;

	/* @var Sensor\SensorDataPacket
	 */
	public $oDataPacket;
	public $aCurrentContexts=[];

	/* @var Measurement
	 */
	public $oMeasurementBase;

	public $sDefaultUnit;

	public $bIsBuffered=false;

	public function __construct($sSensorId, $sInstrumentId=null,
								$sDefaultUnit='event')
	{
		$this->sDefaultUnit=$sDefaultUnit;
		$this->sSensorId=$sSensorId;
		$this->sInstrumentId=$sInstrumentId?:$sSensorId;

		$this->zero();

		//our measurement prototype
		$this->setMeasurementClass(new Measurement($sDefaultUnit));
		$this->setProcessor(new Processor\StubProcessor);
	}

	/**
	 *
	 *
	 */
	public function setProcessor(Processor\AbstractProcessor $oProcessor)
	{
		$this->oProcessor=$oProcessor;
	}

	public function getProcessor()
	{
		return $this->oProcessor;
	}

	public function addContext($sContextName, $mContextValue)
	{
		$this->oDataPacket->aContexts->enqueue([$sContextName, $mContextValue]);
		$ctxid=$this->oDataPacket->aContexts->count()-1;
		$this->aCurrentContexts[]=$ctxid;
		return key($this->aCurrentContexts);
	}

	public function removeContext($hContext)
	{
		if(array_key_exists($hContext, $this->aCurrentContexts))
		{
			unset($this->aCurrentContexts[$hContext]);
		}
		return;
	}

	public function clearCurrentContext()
	{
		$this->aCurrentContexts=[];
		return;
	}

	public function clearMeasurements()
	{
		//$this->oDataPacket->aMeasurements=new SplQueue;
		//$this->oDataPacket->aDictionary=new SplQueue;
		return;
	}

	public function flush()
	{
		$this->getProcessor()->processSensorData($this->oDataPacket);
		$this->clearMeasurements();
		return;
	}

	public function zero()
	{
		unset($this->oDataPacket);
		$this->oDataPacket=new Sensor\SensorDataPacket($this->sSensorId,
													   $this->sInstrumentId);
		$this->aCurrentContexts=[];
	}

	/**
	 *
	 * @throws Processor\ProcessorException by way of flush()
	 */
	public function addMeasurement(Measurement $oMeasurement)
	{
		$this->oDataPacket->aMeasurements->enqueue($oMeasurement);
		$mkey=$this->oDataPacket->aMeasurements->count()-1;
		$this->oDataPacket->aDictionary->enqueue([$mkey, $this->aCurrentContexts]);
		//aaaaand because we're not buffered...
		$this->flush();
	}

	public function addMeasurementWithNotation(Measurement $oMeasurement, $sNotation)
	{
		$hCtx=$this->addContext('notation', $sNotation);
		$this->addMeasurement($oMeasurement);
		$this->removeContext($hCtx);
		return $hCtx;
	}

	public function setMeasurementClass(Measurement $oMeasurementBase)
	{
		$old=$this->oMeasurementBase;
		$this->oMeasurementBase=$oMeasurementBase;
		return $old;
	}

	public function setDefaultUnit($sUnit)
	{
		$this->sDefaultUnit=$sUnit;
	}

	public function measure($mValue)
	{
		$newMeasurement=clone $this->oMeasurementBase;
		$newMeasurement->sUnit=$this->sDefaultUnit; #tinker tinker tinker....
		$this->addMeasurement($newMeasurement->setMeasure($mValue));
		return;
	}

	public function getInstrumentId()
	{
		//return object?
		return $this->sInstrumentId;
	}

	//public function resetInstrument(Instrument $oMeter)
	//{}
}
