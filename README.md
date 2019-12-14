# primary-domain-redirect

WordPress Core understands multiple Domains while in a Multisite setup and redirects accordingly but it doesn't take into account multiple domains while on a Single setup.

There are plenty of server setups out there which are utilizing Nginx / CNAMEs etc that can end up on multiple domains not being redirected.

This will help on efficiently redirect all domains to whatever is set as a home url in WordPress.

This mu-plugin was made while testing out theories on my WPMU DEV hosted website and it utilizes some extra constants that are found on these environments. You can use the same structure but you should alter the code to match your hosting regarding possible staging environments or temporary domains.

Note that is should not be used on Multisites or Single installations that require multiple domains ( i.e. a multilanguage setup ).