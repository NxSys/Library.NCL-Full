<?php
/**
 * Telemetry Service class
 *
 * $Id$
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
namespace NxSys\Library\Data\Telemetry;

// Project Namespaces
use NxSys\Library\Data\Telemetry\Processor;

// 3rdParty Namespaces
use SplQueue;

/**
 * Sensor object
 *
 * This represents a control object that accepts Measurements and
 * emits SensorDataPackets.
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

	/**
	 * Create a new sensor
	 *
	 * This creates a new sensor that can be used to collect Meansurements and
	 * push SensorDataObjects to Processors and Meters
	 *
	 * @param $sSensorId string Id (name) of sensor
	 * @param $sInstrumentId string Id (name) of the instrument group this sensor is a part of
	 * @param $sDefaultUnit string The default unit that composited (via ::measure() )
	 * 	measurements will have
	 */
	public function __construct($sSensorId,
								$sInstrumentId=null,
								$sDefaultUnit='event')
	{
		$this->setDefaultUnit($sDefaultUnit);
		$this->sSensorId=$sSensorId;
		// we can't have null InstrumentIds, no really. its a bad idea
		$this->sInstrumentId=$sInstrumentId?:$sSensorId;

		$this->zero();

		//our measurement prototype
		$this->setMeasurementClass(new Measurement($sDefaultUnit));

		$oProc=new Processor\StubProcessor;
		$oProc->setInstrumentId($sInstrumentId);
		$this->setProcessor($oProc);
	}

	/**
	 * Sets a the Processor that SensorDataPackets are sent to
	 *
	 * Here you can set the "root" of the Processor chain. Note, its is generally
	 * easier to simply "flow" via ->getProcessor()->setNextProcessor(...) as
	 * $this->oProcessor will be initialized with VoidProcessor
	 *
	 * @param $oProcessor Processor\AbstractProcessor a Processor of SensorDataPackets
	 */
	public function setProcessor(Processor\AbstractProcessor $oProcessor)
	{
		$oProcessor->setInstrumentId($this->sInstrumentId);
		$this->oProcessor=$oProcessor;
	}

	/**
	 * Returns the Processor of this sensor
	 *
	 * @return Telemetry\Processor\AbstractProcessor the current Processor
	 */
	public function getProcessor()
	{
		return $this->oProcessor;
	}

	/**
	 * Adds a context to subsequent measurments
	 *
	 * This adds a "context set" to additional Measurements stored in
	 * the SensorDataPacket. This set:
	 *  <code>
	 *  ['sContextName' => $sContextName,
	 *  'mContextValue' => $mContextValue]
	 *  </code>
	 * is enqued onto the current SDP in a context queue and also in a
	 * CurrentContext cache. We then return the index of the new local cache entry.
	 *
	 * @see removeContext
	 *
	 * @param $sContextName string name of the context
	 * @param $mContextValue mixed context value
	 * @return int handle (index) of new context entry
	 */
	public function addContext($sContextName, $mContextValue)
	{
		$this->oDataPacket->aContexts->enqueue((object)['sContextName' => $sContextName,
														'mContextValue' => $mContextValue]);
		#if ever threaded, consider a lock
		$ctxid=$this->oDataPacket->aContexts->count()-1;
		$this->aCurrentContexts[]=$ctxid;
		return key($this->aCurrentContexts);
	}

	/**
	 * Removes a context from current contexts via handle returned from ::addContext
	 *
	 * Please note that this will not remove a context from inside of the SensorDataPacket,
	 * as we do not "garbage collect" them.
	 *
	 * @see addContext
	 * @see $hContext handle|int handle (index) to the stored context
	 * @param $hContext the return of ::addContext
	 * @return void
	 */
	public function removeContext($hContext)
	{
		if(array_key_exists($hContext, $this->aCurrentContexts))
		{
			unset($this->aCurrentContexts[$hContext]);
		}
		return;
	}

	/**
	 * Clears all of the current contexts without needing a handle to a context
	 * @param void
	 * @return void
	 */
	public function clearCurrentContext()
	{
		$this->aCurrentContexts=[];
		return;
	}

	/**
	 * This will empty the SensorDataPacket of its measurments and its lookup dictionary.
	 *
	 * Note this does not explicently clear contexts from the SDP
	 * as we don't care to invalidate $this->aCurrentContexts from here
	 *
	 * @param void
	 * @return void
	 */
	public function clearMeasurements()
	{
		//when testing comment out these lines to inspect dictionary operation
		$this->oDataPacket->aMeasurements=new SplQueue;
		$this->oDataPacket->aDictionary=new SplQueue;
		return;
	}

	/**
	 * Send the SensorDataPacket back to the Processor (chain)
	 *
	 * After that we clear the measurements, so we can resume collection
	 * with current contexts
	 *
	 * @param void
	 * @return void
	 */
	public function flush()
	{
		$this->getProcessor()->processSensorData($this->oDataPacket);
		$this->clearMeasurements();
		return;
	}

	/**
	 * Zeros the sensor
	 *
	 * Removes the SensorDataPacket, removes all current contexts,
	 * and instantiates a new SDP. Use this instead of destroying a
	 * Sensor so you don't have to configure an new one.
	 *
	 * @param void
	 * @return void
	 */
	public function zero()
	{
		$this->clearCurrentContext();
		unset($this->oDataPacket);
		$this->oDataPacket=new Sensor\SensorDataPacket($this->sSensorId,
													   $this->sInstrumentId);
	}

	/**
	 * Adds a Measurement to the Sensor
	 *
	 * Once it enques the measurement it stores related indexes into the
	 * SDP dictionary
	 *
	 * @throws Processor\ProcessorException by way of flush()
	 * @param $oMeasurement Measurement the measurement to record
	 * @return void
	 */
	public function addMeasurement(Measurement $oMeasurement)
	{
		$this->oDataPacket->aMeasurements->enqueue($oMeasurement);
		$iMeasurementKey=$this->oDataPacket->aMeasurements->count()-1;
		$this->oDataPacket->aDictionary->enqueue((object)['iMeasurementKey' => $iMeasurementKey,
														  'aCurrentContexts' => $this->aCurrentContexts]);
		//aaaaand because we're not buffered...
		$this->flush();
	}

	/**
	 * Shortcut to add a measurment with a one-off context of 'notatation'
	 *
	 * @param $oMeasurement Measurement measurement to add
	 * @param $sNotation string notation to add
	 * @return void
	 */
	public function addMeasurementWithNotation(Measurement $oMeasurement, string $sNotation)
	{
		$this->addMeasurementWithContext($oMeasurement, 'notation', (string) $sNotation);
		return;
	}

	/**
	 * Shortcut to add a measurment with a single one-off context
	 *
	 * @param $oMeasurement Measurement measurement to add
	 * @param $sNotation string notation to add
	 * @return void
	 */
	public function addMeasurementWithContext(Measurement $oMeasurement, $sContextName, $mContext)
	{
		$hCtx=$this->addContext($sContextName, $mContext);
		$this->addMeasurement($oMeasurement);
		$this->removeContext($hCtx);
		return;
	}

	/**
	 * Sets a template Measurement class for use with ::measure()
	 *
	 * @see measure()
	 * @param $oMeasurementBase Measurement
	 * @return Measurement previous MeasurementBase
	 */
	public function setMeasurementClass(Measurement $oMeasurementBase)
	{
		$old=$this->oMeasurementBase;
		$this->oMeasurementBase=$oMeasurementBase;
		return $old;
	}

	/**
	 * Sets default unit of the MeasurementBase
	 *
	 * Note: this has limited to n effect once you use ::setMeasureMentClass()
	 *
	 * @see setMeasureMmentClass
	 * @see measure()
	 * @param $sUnit string default unit of measure
	 * @return string previous measurement unit (likely to be 'event')
	 */
	protected function setDefaultUnit($sUnit)
	{
		$old=$this->sDefaultUnit;
		$this->sDefaultUnit=$sUnit;
		return $old;
	}

	/**
	 * Copies the default Measurement base object, applies a value to it, and records it.
	 *
	 * Shortcut method
	 * @param $mValue mixed value to be measured
	 * @return void
	 */
	public function measure($mValue)
	{
		$newMeasurement=clone $this->oMeasurementBase;
		$newMeasurement->sUnit=$this->sDefaultUnit; #tinker tinker tinker....
		$this->addMeasurement($newMeasurement->setMeasure($mValue));
		return;
	}

	/**
	 * Returns the current sensor ID
	 *
	 * @return string the current sensor ID
	 */
	public function getSensorId()
	{
		return $this->sSensorId;
	}

	/**
	 * Returns the current instrument ID
	 *
	 * @return string the current instrument ID
	 */
	public function getInstrumentId()
	{
		//return object?
		return $this->sInstrumentId;
	}
}
