<?php
use NxSys\Library\IO;
use NxSys\Library\IO\StdInterface;
use Codeception\Verify;

//use SplFileInfo;
//use SplFileObject;
//use SplTempFileObject;
//use DirectoryIterator;
//use FilesystemIterator;
//use GlobIterator;
//use RecursiveDirectoryIterator;

// @group 'IO'
$I = new UnitTester($scenario);
$I->wantTo('test NxStdIO compatibility');

class SplFileInfoSigTest extends SplFileInfo implements StdInterface\ISplFileInfo {}
class SplFileObjectSigTest extends SplFileObject implements StdInterface\ISplFileObject {}

new SplFileObjectSigTest('c:\.rnd');
var_dump(new StdInterface\SplFileObject('c:\.rnd'));

class DirectoryIteratorSigTest extends DirectoryIterator implements StdInterface\IDirectoryIterator {}
new StdInterface\DirectoryIterator('C:/');

class FilesystemIteratorST extends FilesystemIterator implements StdInterface\IFilesystemIterator{}
var_dump(new StdInterface\FilesystemIterator('c:/'));

class GlobIteratorST extends GlobIterator implements StdInterface\IGlobIterator{}
var_dump(new StdInterface\GlobIterator('c:/'));

class RecursiveDirectoryIteratorST extends RecursiveDirectoryIterator implements StdInterface\IRecursiveDirectoryIterator{}
var_dump($c=new StdInterface\RecursiveDirectoryIterator('c:/'));
$c->next();
var_dump($c->current(), $c->current()->getRealPath());
