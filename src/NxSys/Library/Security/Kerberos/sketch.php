<?php
// https://www.kerberos.org/software/whykerberos.pdf
// http://www.kerberos.org/software/rolekerberos.pdf
// https://www.kerberos.org/software/appskerberos.pdf
// https://major.io/2012/02/02/kerberos-for-haters/

// - `RFC 4120 - The Kerberos Network Authentication Service (V5) <https://www.rfc-editor.org/rfc/rfc4120.html>`_
// - `RFC 2743 - Generic Security Service Application Program Interface Version 2, Update 1 <https://www.rfc-editor.org/rfc/rfc2743.html>`_
// - `RFC 4121 - The Kerberos Version 5 Generic Security Service Application Program Interface (GSS-API) Mechanism: Version 2 <https://www.rfc-editor.org/rfc/rfc4121.html>`_
// - `RFC 4178 - The Simple and Protected Generic Security Service Application Program Interface (GSS-API) Negotiation Mechanism <https://www.rfc-editor.org/rfc/rfc4178.html>`_
// - `RFC 2119 - Key words for use in RFCs to Indicate Requirement Levels <https://www.rfc-editor.org/rfc/rfc2119.html>`_

// https://www.kerberos.org/software/appskerberos.pdf


namespace NxSys\Library\Security\Kerberos;

// http://php.net/manual/en/book.sodium.php
// https://download.libsodium.org/doc/


///////
// A solid implmentation test
///////
interface IKADM5Polyfil
{
	public function chpass_principal(IKADM5PolyfillState $handle, string $principal, string $password): bool;
	public function create_principal(IKADM5PolyfillState $handle, string $principal, string $password=null, array $options=[]): bool;
	public function delete_principal(IKADM5PolyfillState $handle, string $principal): bool;
	public function destroy(IKADM5PolyfillState $handle): bool;
	public function flush(IKADM5PolyfillState $handle): bool;
	public function get_policies(IKADM5PolyfillState $handle): array;
	public function get_principal(IKADM5PolyfillState $handle, string $principal): array;
	public function get_principals(IKADM5PolyfillState $handle): array;
	public function init_with_password(string $admin_server, string $realm, string $principal, string $password): IKADM5PolyfillState;
	public function modify_principal(IKADM5PolyfillState $handle, string $principal, array $options): bool;
}

class KADM5Polyfil implements IKADM5Polyfil
{

}
//@todp c&p into the global scope if kadm5 not around, also CONSTANTS

if (!function_exists('kadm5_init_with_password'))
{
	# code...
}

interface IKADM5PolyfillState
{}
///////////////////////////////////////////////////////////////////////////////

/**
 *
 */
class Client
{
	public function authn($server)
	{
		$server->requestServerCreds($myPrincipal, $server);
	}
}

class Ticket
{
	$transited=[];
}

/**
 *
 */
class AuthServer
{

	function __construct()
	{

	}

	public function requestServerCreds($client, $server)
	{
		//new session
		$creds=$ASCredStore->getServerCreds($server);
		$sSessionKey=CryptoManager::generateKey();

		return CryptoManager::encrypt([$creds, $sSessionKey], $client->key);
	}
}

class ASSession
{
	$sSessionKey;
	$sClientPrincipal;
	$iCreationTime;
	$iTTL;
}

class ASSessionStore
{
	public function getNewSession(): ASSession
	{
		return new ASSession;
	}
}

class ASCredStore
{
	public function getServerCreds($value='')
	{
		$sServerTicket;
		return [$sServerTicket, $sSessionKey];
	}
}

class CryptoManager
{
	public function generateKey()
	{
		# code...
	}
	public function encrypt($data, $key, $opts)
	{
		# code...
	}
	public function decrypt($data, $key, $opts)
	{
		# code...
	}
}