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
use SplQueue;

/**
 * SensorDataPacket
 *
 * This represents a packet of data that the Sensor "pumps" back to processors.
 */
class SensorDataPacket
{
	/*
	 */
	public $sSensorId;

	/*
	 */
	public $sInstrumentId;

	/*
	 */
	public $sDictionayMode;

	/*
	 */
	public $aDictionary;

	/* @var SplQueue
	 */
	public $aMeasurements;

	/*
	 */
	public $aContexts;

	/**
	 * You will need at least the sensor name an and instrument group name to construct this
	 */
	public function __construct($sSensorId, $sInstrumentId)
	{
		$this->sSensorId=$sSensorId;
		$this->sInstrumentId=$sInstrumentId;

		$this->aContexts=new SplQueue;
		$this->aDictionary=new SplQueue;
		$this->aMeasurements=new SplQueue;

		$this->sDictionayMode='sequence-ordered'; //@todo
	}
}
