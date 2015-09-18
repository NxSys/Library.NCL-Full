<?php
use NxSys\Library\Telemetry;
use Codeception\Verify;

// @group 'Telemetry'
$I = new UnitTester($scenario);

$I->wantTo('perform actions and see result');
(new Verify(false))->true();
//$I->assertTrue('meter');

	$oInstrumentation=new Telemetry\Instrument('my.instument.group');
	$sensor=$oInstrumentation->createSensor('poke-sensor');
	$sensor->setDefaultUnit('pokes');
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
