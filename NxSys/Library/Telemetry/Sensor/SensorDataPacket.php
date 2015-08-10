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
namespace NxSys\Library\Telemetry\Sensor;

// Project Namespaces
use NxSys\Library\Telemetry;

// 3rdParty Namespaces
use SplQueue;

/**
 * SensorDataPacket
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
	 *
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
