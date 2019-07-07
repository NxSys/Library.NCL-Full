<?php

use NxSys\Library\Data\Telemetry;

use Codeception\Verify;

/**
 * @group Telemetry
 */
class Telemetry_sensorTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests

	/**
	 * depends general operation
	 * @group Telemetry.Meter
	 */
	public function testMeterCreation()
	{
		$this->tester->wantTo('===================');
//		$this->tester->assertTrue('===================');
		(new Verify(true))->true();
	}

	/**
	 * depends general operation
	 * @group Telemetry.Meter
	 */
	public function testMeterManagement()
	{
		(new Verify(true))->true();
	}
	/**
	 * depends general operation
	 * @group Telemetry.Meter
	 */
	public function testMeterStoreAndLoad()
	{
		(new Verify(true))->true();
	}

	/**
	 * depends general operation
	 * @group Telemetry.Meter
	 */
	public function testMeterIntegration()
	{
		(new Verify(true))->true();
	}

	/**
	 * depends general operation
	 * @group Telemetry.Meter
	 */
	public function testMeterGeneralOperation()
	{
		(new Verify(true))->true();
	}

	/**
	 * depends general operation
	 * @group Telemetry.Meter
	 */
	public function testRawMeter()
	{
		(new Verify(true))->true();
	}

    public function testGeneralOperation()
    {
		$oInstrumentation=new Telemetry\Instrument('my.instument.group');
		$sensor=$oInstrumentation->createSensor('poke-sensor', 'pokes');
		// $sensor->setDefaultUnit('pokes'); this method is protected now
		$sensor->measure('10');

		//or don't use the Instrument utility...
		//$sensor=new Telemetry\Sensor('mysensor1', null);
		//$sensor->getProcessor()->setInstrumentId('mysensor1');
		$sensor->getProcessor() //StubProcessor
			   ->setNextProcessor(new Telemetry\Processor\CallableQueueProcessor)
			   ->setNextProcessor(new Telemetry\Processor\StubProcessor);


		$tdata=new Telemetry\Measurement('meaningfulnes-units', 42);
		$tdata->setMeasure(7);

		//misc usage
		$sensor->addMeasurementWithNotation($tdata, 'zomg stuff');
		$sensor->addMeasurementWithNotation($tdata, 'zo1mg stuff');
		$hctx=$sensor->addContext('bag-o-stuff', $_SERVER);
		$sensor->addMeasurementWithNotation($tdata, 'with ctx');
		$sensor->clearCurrentContext();
		$hctx=$sensor->addContext('bag-o-stuff2', getcwd());
		$sensor->addMeasurement($tdata);
		$sensor->removeContext($hctx);
		//$sensor->removeContext($hctx);
		$sensor->measure('10');
		$sensor->addMeasurement(new Telemetry\Measurement('success-units', 1));
    }

}