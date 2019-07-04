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
     * Sets the logger message format
     * @param string $sMessageFmt the message fmt (see sprintf)
     * @return void
     */
    public function setLogMessageFmt($sMessageFmt)
    {
    	$this->sMessageFmt=$sMessageFmt;
    }

	/**
	 * @inheritDoc
	 * Must call ->setLogger() before use.
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
