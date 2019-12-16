# primary-domain-redirect

![Tests](https://github.com/mrxkon/primary-domain-redirect/workflows/Tests/badge.svg)
[![PHP Compatibility 7.0+](https://img.shields.io/badge/PHP%20Compatibility-7.0+-8892BF)](https://github.com/PHPCompatibility/PHPCompatibility)
[![WordPress Coding Standards](https://img.shields.io/badge/WordPress%20Coding%20Standards-latest-blue)](https://github.com/WordPress/WordPress-Coding-Standards)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=mrxkon_primary-domain-redirect&metric=alert_status)](https://sonarcloud.io/dashboard?id=mrxkon_primary-domain-redirect) [![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=mrxkon_primary-domain-redirect&metric=security_rating)](https://sonarcloud.io/dashboard?id=mrxkon_primary-domain-redirect)
 [![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=mrxkon_primary-domain-redirect&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=mrxkon_primary-domain-redirect) [![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=mrxkon_primary-domain-redirect&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=mrxkon_primary-domain-redirect)


[![My Website](https://img.shields.io/badge/My-Website-orange.svg)](https://xkon.gr)  [![WordPress Profile](https://img.shields.io/badge/WordPress-Profile-blue.svg)](https://profiles.wordpress.org/xkon)

[![Built for WordPress](https://img.shields.io/badge/built%20for-WordPress-blue)](https://wordpress.org) [![Built for WPMU DEV](https://img.shields.io/badge/built%20for-WPMU%20DEV-blue)](https://premium.wpmudev.org/)
[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2+-red)](http://www.gnu.org/licenses/gpl-2.0.html)

---

It seems that WordPress Core understands multiple Domains while in a Multisite setup and redirects accordingly but it doesn't take into account multiple domains while on a Single setup. There are plenty of server setups out there which are utilizing Nginx / CNAMEs etc that can end up on multiple domains not being redirected.

This `mu-plugin` will help on efficiently redirect all domains to whatever is set as a home url in WordPress.

This mu-plugin was made while testing out theories on my WPMU DEV hosted website and it utilizes some extra constants that are found on these environments. You can use the same structure but you should alter the code to match your hosting regarding possible staging environments or temporary domains. Note that is should not be used on Multisites or Single installations that require multiple domains (i.e. a multilanguage setup).