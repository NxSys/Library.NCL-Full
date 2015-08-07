<?php
/**
 * Telemetry Measurement for Events
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
namespace NxSys\Library\Telemetry;

// Project Namespaces
use NxSys\Frameworks\Wacc;

// 3rdParty Namespaces
use Psr\Log,
	DateTime;

/**
 *
 */
class EventMeasurement extends Measurement
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
	 * @var string
	 */
	public $sNotation;

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
	 * @return Measurement
	 */
	public function setEvent($sEventName)
	{
		$this->oTimestamp=new DateTime;
		$this->mMeasure=$sEventName;
		return $this;
	}

	/**
	 * @param $sNotation
	 * @return Measurement
	 */
	public function setNotation($sNotation)
	{
		$this->notate=$sNotation;
		return $this;
	}
}
