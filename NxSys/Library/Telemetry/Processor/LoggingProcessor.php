<?php
/**
 * Telemetry Service
 *
 * $Id: StubProcessor.php 4 2015-08-10 18:27:09Z nxs.cfeamster $
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
namespace NxSys\Library\Telemetry\Processor;

// Project Namespaces
use NxSys\Library\Telemetry\Sensor;

use Psr\Log as StdLogging;
use LogicException;

/**
 * LoggingProcessor
 */
class LoggingProcessor extends AbstractProcessor implements StdLogging\LoggerAwareInterface
{
	public $sMessageFmt='Processing Telemetry from %1$s\%2$s. Measurements attached.';

    /** @var LoggerInterface */
    protected $oLogger;

    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(StdLogging\LoggerInterface $oLogger)
    {
        $this->oLogger = $oLogger;
    }

    /**
     *
     */
    public function setLogMessageFmt($sMessageFmt)
    {
    	$this->sMessageFmt=$sMessageFmt;
    }

	/**
	 *
	 */
	public function process(Sensor\SensorDataPacket &$oMutableData)
	{
		if(!$this->oLogger)
		{
			throw new NoLoggerSetForProcessor('Please call ::setLogger() with a PSR LoggerAwareInterface');
		}
		$measures=[];
		foreach ($oMutableData->aMeasurements as $measure)
		{
			$measures[]=$measure->getMeasure().' '.$measure->sUnit;
		}
		$this->oLogger->debug(sprintf($this->sMessageFmt,
									  $oMutableData->sInstrumentId,
									  $oMutableData->sSensorId),
							  $measures);
		return;
	}
}

class NoLoggerSetForProcessor extends LogicException implements ProcessorExceptionType
{}
