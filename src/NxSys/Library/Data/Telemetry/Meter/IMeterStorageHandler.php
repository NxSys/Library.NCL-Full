<?php
/**
 * NAME
 *
 * $Id: AbstractMeter.php 4 2015-08-10 18:27:09Z nxs.cfeamster $
 * DESCRIPTION
 *
 * @link http://nxsys.org/spaces/onx/wiki/Nexus_Common_Library
 * @package NxSys.Library\Data-Telemetry
 * @license http://nxsys.org/spaces/onx/wiki/License
 * Please see the license.txt file or the url above for full copyright and license information.
 * @copyright Copyright 2019 Nexus Systems, Inc.
 *
 * @author Chris R. Feamster <cfeamster@nxsysts.com>
 * @author $LastChangedBy: nxs.cfeamster $
 *
 * @version $Revision: 4 $
 */

/** Local Namespace **/
namespace NxSys\Library\Data\Telemetry\Meter;

// Project Namespaces
use NxSys\Library\Data\Telemetry;

interface IMeterStorageHandler
{
    /**
     * @param Telemetry\Meter\MeterDataPacket $oMeterDataPacket
     */
    public function persistData(MeterDataPacket $oMeterDataPacket);

    /**
     * @return Telemetry\Meter\MeterDataPacket
     */
    public function loadData($sMeterId, $sInstrumentId=null);
}