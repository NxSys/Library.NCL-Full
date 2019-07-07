<?php
use NxSys\Library\Data\Telemetry;
use Codeception\Verify;

// @group 'Telemetry'
$I = new UnitTester($scenario);

$I->wantTo('test my instrument');
$oInstrumentation=new Telemetry\Instrument('my.instument.group');
(new Verify($oInstrumentation))->isInstanceOf('NxSys\Library\Data\Telemetry\Instrument');

$sensor=$oInstrumentation->createSensor('meh-sensor');
(new Verify($sensor))->isInstanceOf('NxSys\Library\Data\Telemetry\Sensor');

$newSensor=new Telemetry\Sensor('mehzors');
$I->assertEquals($oInstrumentation->attachSensor($newSensor), $newSensor);

//test default setDefaultMeterStorageHandler usage
$oInstrumentation->setDefaultMeterStorageHandler(new Telemetry\Meter\VoidStorageHandler);

//test default setSensorGroupHeadProcessor
$oInstrumentation->setSensorGroupHeadProcessor(new Telemetry\Processor\UltimateVoidProcessor);