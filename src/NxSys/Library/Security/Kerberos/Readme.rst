Simple Kerberos Implementation for PHP (nxsys/library.security-kerberos)
########################################################################

Part of the Nexus Common Library
""""""""""""""""""""""""""""""""

SYNOPSIS
========

Need the protection of the kerberos protocol but not the KADM5 implemenation? Need a pure PHP implementation for non-standard transports? This l

.. admonition:: What this library is NOT:

    - A modification of the security mechincinshs of the Kerberos specifictaion.
    - To be a *drop-in* replacement for fully configured SSO solutions. This is *just* a library. You could build that with this however...

..
    Drop the version ## *somewhere*

Badge-Belt
===========

.. image:: https://img.shields.io/maintenance/yes/2019.svg?style=for-the-badge
   :alt: the buckle

.. image:: https://img.shields.io/packagist/l/nxsys/library.ncl-full.svg?style=flat-square
    :alt: Packagist
    :target: https://packagist.org/packages/nxsys/library-ncl.full
.. image:: https://img.shields.io/packagist/v/nxsys/library.ncl-full.svg?style=flat-square
    :alt: Packagist Version
    :target: https://packagist.org/packages/nxsys/library-ncl.full
.. image:: https://img.shields.io/packagist/php-v/nxsys/library.ncl-full.svg?logo=php&style=flat-square
    :alt: PHP from Packagist
    :target: https://packagist.org/packages/nxsys/library-ncl.full

.. image:: https://img.shields.io/appveyor/ci/nxsys/trunk.svg?logo=appveyor&style=flat-square
    :alt: AppVeyor
.. image:: https://img.shields.io/sonar/sqale_debt_ratio/nxsys.library-ncl.full.svg?server=https%3A%2F%2Fsonarcloud.io&style=flat-square
    :alt: Sonar Tech Debt
    :target: https://packagist.org/packages/nxsys/library-ncl.full
.. image:: https://img.shields.io/sonar/alert_status/nxsys.library-ncl.full.svg?server=https%3A%2F%2Fsonarcloud.io&style=flat-square
    :alt: Sonar Quality Gate
    :target: https://packagist.org/packages/nxsys/library-ncl.full

.. image:: https://img.shields.io/cii/summary/2982.svg?style=flat-square
    :alt: CII Best Practices Summary


REQUIREMENTS
============
- PHP 7.3+
- Composer


INSTALLATION
============

::

    composer require nxsys/library.security-kerberos

USAGE (Quickstart)
==================



RESOURCES
=========
- API Docs
- Usage Docs\\Wiki

Need help? Talk to us! We only bother to release code if we think it could help someone, so if you have any questsions at all, please `chat <https://onx.zulipchat.com/#narrow/stream/105970-general>`_, `email <mailto:onx@nxs.systems>`_, or leave an issue.

For vulnerabilities or other sensitive issues, please contact onx@nxs.systems and CC cfeamster@nxs.systems. If you are inclinded to publish the behavior, we respectfully request a 5 day embargo from the moment you contact us. We value your effort to improve the security and privacy of this project!

{design docs loc, usage docs loc, wiki page}

CONTRIBUTING
============

{$HeadURL$}



ORIGIN
=======
This libray is part of the Nexus Common Library. It came about after a discussion of kerberos over websockets.

This project is offered for use under the terms of the MIT License.


REFERENCES
==========

Key words for use in RFCs to Indicate Requirement Levels
http://www.ietf.org/rfc/rfc2119.txt

https://www.kerberos.org/software/appskerberos.pdf
