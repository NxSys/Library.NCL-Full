<?php
/**
 * Telemetry Measurement for Events
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
namespace NxSys\Library\Data\Telemetry\Measurement;

/**
 *
 */
class EventMeasurement extends \NxSys\Library\Data\Telemetry\Measurement
{
	/**
	 * @var string
	 */
	public $sUnit;

	/**
	 * @var mixed
	 */
	public $mMeasure;

	/**
	 * @var DateTime
	 */
	public $oTimestamp;

	/**
	 * @param $sUnit
	 * @param $mMeasure
	 * @param $sNotation
	 */
	public function __construct($sEventName=null, $sNotation=null)
	{
		$this->sUnit='event';
		$this->setMeasure($sEventName);
		$this->setNotation($sNotation);
	}

	/**
	 * @param $mMeasure
	 * @return EventMeasurement
	 */
	public function setEvent($sEventName)
	{
		$this->setMeasure($sEventName);
		return $this;
	}
}
