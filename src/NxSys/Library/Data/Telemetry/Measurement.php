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

// 3rdParty Namespaces
use DateTime;

/**
 *
 */
class Measurement implements Measurement\IMeasurement
{
	/**
	 * @var string
	 * @link http://physics.nist.gov/cuu/Units/index.html
	 */
	public $sUnit;

	/**
	 * @var mixed
	 */
	protected $mMeasure;

	/**
	 * @var DateTime
	 */
	protected $oTimestamp;

	/**
	 * @var string
	 */
	//public $sNotation;

	/**
	 * @param $sUnit
	 * @param $mMeasure
	 * @param $sNotation
	 */
	public function __construct($sUnit, $mMeasure=null)
	{
		$this->sUnit=$sUnit;
		$this->setMeasure($mMeasure);
	}

	/**
	 * @param $mMeasure
	 * @return Measurement
	 */
	public function setMeasure($mMeasure)
	{
		$this->oTimestamp=new DateTime;
		$this->mMeasure=$mMeasure;
		return $this;
	}

	public function getMeasure()
	{
		return $this->mMeasure;
	}

	public function getTimestamp()
	{
		return $this->oTimestamp;
	}

	/**
	 * @param $sNotation
	 * @return Measurement
	 */
	//public function setNotation($sNotation)
	//{
	//	$this->notate=$sNotation;
	//	return $this;
	//}
}
