<?php
/**
 * Telemetry Service
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

// Project Namespaces
use NxSys\Library\Data\Telemetry\Sensor;

/**
 * StubProcessor
 */
class UltimateVoidProcessor extends AbstractProcessor
{
	/**
	 *
	 */
	public function __construct()
	{
		$this->setUltimateProcessor($this);
	}


	/**
	 *
	 */
	public function process(Sensor\SensorDataPacket &$oMutableData)
	{
		return; //noop
	}
}
