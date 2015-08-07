<?php
/**
 * Telemetry Service
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
class Measurement
{
	/**
	 * @var string
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
