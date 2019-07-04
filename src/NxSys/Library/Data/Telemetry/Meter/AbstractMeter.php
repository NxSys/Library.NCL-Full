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
namespace NxSys\Library\Data\Telemetry\Meter;

// Project Namespaces
use NxSys\Library\Data\Telemetry;

/**
 *
 */
abstract class AbstractMeter
{
	public $sMeterId;
	public $sInstrumentId;

	/* @var IMeterStorageHandler
	 */
	public $oStorageHandler;

	public $oMeterDataPacket;

	public function __construct($sMeterId, $sInstrumentId=null, IMeterStorageHandler $oStorageHandler=null)
	{
		$this->sMeterId=$sMeterId;
		$this->sInstrumentId=$sInstrumentId;
		$this->oStorageHandler=$oStorageHandler?:new VoidStorageHandler;
		$this->oMeterDataPacket=$this->oStorageHandler->loadData($sMeterId, $sInstrumentId);
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

	public function getStorageHandler()
	{
		return $this->oStorageHandler;
	}

	public function flushMeterData()
	{
		$this->oStorageHandler->persistData($this->oMeterDataPacket);
	}

	/**
	 *
	 *
	 */
	public function __destruct()
	{
		$this->flushMeterData();
	}
}
