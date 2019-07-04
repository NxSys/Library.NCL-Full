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
namespace NxSys\Library\Data\Telemetry;

/**
 *
 */
class InstrumentationService
{
	public function __construct()
	{}

	public function getNewInstrument()
	{}
	public function measure($sSensorName, $mValue)
	{}

	public function getCurentInstrument()
	{}
	public function resetInstrument(Instrument $oMeter)
	{}

	protected function addInternalTelemetryMeter(Telemetry\Meter\AbstractMeter $oMeter)
	{}
}
