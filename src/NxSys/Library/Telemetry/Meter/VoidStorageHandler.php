<?php
/**
 * NAME
 *
 * $Id: AbstractMeter.php 4 2015-08-10 18:27:09Z nxs.cfeamster $
 * DESCRIPTION
 *
 * @link http://nxsys.org/spaces/onx/wiki/Nexus_Common_Library
 * @package NxSys.Library\Telemetry
 * @license http://nxsys.org/spaces/onx/wiki/License
 * Please see the license.txt file or the url above for full copyright and license information.
 * @copyright Copyright 2015 Nexus Systems, Inc.
 *
 * @author Chris R. Feamster <cfeamster@nxsysts.com>
 * @author $LastChangedBy: nxs.cfeamster $
 *
 * @version $Revision: 4 $
 */

/** Local Namespace **/
namespace NxSys\Library\Telemetry\Meter;

// Project Namespaces
use NxSys\Library\Telemetry;

/**
 * VoidStorageHandler
 */
class VoidStorageHandler implements IMeterStorageHandler
{
        /**
     * @param Telemetry\Meter\MeterDataPacket $oMeterDataPacket
     */ 
    public function persistData(MeterDataPacket $oMeterDataPacket)
    {
        return; //noop
    }
    
    /**
     * @return Telemetry\Meter\MeterDataPacket
     */
    public function loadData($sMeterId, $sInstrumentId=null)
    {
        $mdp=new MeterDataPacket;
        $mdp->sMeterID=$sMeterId;
        $mdp->sInstrumentId=$sInstrumentId;
        return $mdp;
    }

}
 