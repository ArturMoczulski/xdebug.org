<?php
$features = array(
	'install' => array(
		'Installation',
		FUNC_INSTALL,
		'This section describes on how to install Xdebug.',
		"
<span class='sans'>PRECOMPILED MODULES</span><br />

<p>
There are a few precompiled modules for Windows, they are all for the non-debug
version of PHP.  See the links on the right side.
</p>
<p>
Installing the precompiled modules is easy. Just place them in a directory, and
add the following line to php.ini: (don't forget to change the path and
filename to the correct one)
<pre>
zend_extension_ts='c:/php/modules/php_xdebug-4.4.1-2.0.0beta5.dll'
</pre>
</p>

<a name='pecl'></a>
<span class='sans'>PECL INSTALLATION</span><br />

<p>
As of Xdebug 0.9.0 you can install Xdebug through PEAR/PECL. This only works
with with PEAR version 0.9.1-dev or higher and some UNIX.
</p>
<p>
Installing with PEAR/PECL is as easy as:
</p>
<pre>
# pecl install xdebug-beta
</pre>
<p>
but you still need to add the correct line to your php.ini: (don't forget to
change the path and filename to the correct one)
</p>
<pre>
zend_extension='/usr/local/php/modules/xdebug.so'
</pre>

<a name='source'></a>
<span class='sans'>INSTALLATION FROM SOURCE</span><br />

<p>
You can download the source of the latest <b>stable</b> release <?php url ('xdebug200beta5', 'here'); ?>.
Alternatively you can obtain Xdebug from CVS:
</p>
<pre>
cvs -d :pserver:srmread@cvs.xdebug.org:/repository login
CVS password: srmread
cvs -d :pserver:srmread@cvs.xdebug.org:/repository co xdebug
</pre>
<p>
This will checkout the latest development version which is currently 2.0dev.
</p>

<a name='compile'></a>
<span class='sans'>COMPILING</span><br />

<p>
You compile Xdebug separately from the rest of PHP.  Note, however,
that you need access to the scripts 'phpize' and 'php-config'.  If
your system does not have 'phpize' and 'php-config', you will need to
compile and install PHP from a source tarball first, as these script
are by-products of the PHP compilation and installation processes. (Debian users
can install the required tools with <code>apt-get install php4-dev</code>). It
is important that the source version matches the installed version as there are
slight, but important, differences between PHP versions.  For a detailed
installation on Mac OSX see <a
href='http://pressedpants.com/archives/dated/2004/04/08/xdebug_on_os_x/'>Jason
Perkins'</a> installation instructions. Once you have access to 'phpize' and
'php-config', do the following:
</p>
<p>
<ol>
<li>Unpack the tarball: tar -xzf xdebug-2.0.x.tgz.  Note that you do
not need to unpack the tarball inside the PHP source code tree.
Xdebug is compiled separately, all by itself, as stated above.</li>

<li>cd xdebug-2.0.x</li>

<li>Run phpize: phpize
(or /path/to/phpize if phpize is not in your path). See in the <a
href='#phpize'>table below</a> which version numbers it should show for
different PHP versions. Make sure you use the phpize that belongs to the PHP
version that you want to use Xdebug with.</li>

<li>./configure --enable-xdebug
(or:
./configure --enable-xdebug --with-php-config=/path/to/php-config
if php-config is not in your path).
<br /><br />
If this fails with something like:
<pre>../configure: line 1960: syntax error near unexpected token
`PHP_NEW_EXTENSION(xdebug,'
../configure: line 1960: `  PHP_NEW_EXTENSION(xdebug, xdebug.c
xdebug_code_coverage.c xdebug_com.c xdebug_handler_gdb.c
xdebug_handler_php3.c xdebug_handlers.c xdebug_llist.c xdebug_hash.c
xdebug_profiler.c xdebug_superglobals.c xdebug_var.c usefulstuff.c,
\$ext_shared)'</pre> then it means that you do not meet the PHP 4.3.x version
requirement for Xdebug.
<br /><br />
Another problem that might occur is:
<pre>configure: line 1145: PHP_INIT_BUILD_SYSTEM: command not found
configure: line 1151: syntax error near unexpected token `config.nice'
configure: line 1151: `PHP_CONFIG_NICE(config.nice)'</pre> You will need to
upgrade your autotools (autoconf, automake and libtool) or install the known
working versions: autoconf-2.13, automake-1.5 and libtool-1.4.3.</p></li>

<li>make</li>

<li>cp modules/xdebug.so /to/wherever/you/want/it</li>
</ol>

<a name='configure-php'></a>
<span class='sans'>CONFIGURE PHP TO USE XDEBUG</span><br />

<ol>
<li>add the following line to php.ini:
zend_extension='/wherever/you/put/it/xdebug.so' (for non-threaded use of PHP,
for example the CLI, CGI or Apache 1.3 module) or:
zend_extension_ts='/wherever/you/put/it/xdebug.so' (for threaded usage of PHP,
for example the Apache 2 work MPM or the the ISAPI module).
<strong>Note:</strong> In case you compiled PHP yourself and used
--enable-debug you would have to use zend_extension_debug=.</li>

<li>Restart your webserver.</li>

<li>Write a PHP page that calls '<i>phpinfo()</i>' Load it in a browser and
look for the info on the Xdebug module.  If you see it next to the Zend logo,
you have been successful! You can also use 'php -m' if you have a command
line version of PHP, it lists all loaded modules. Xdebug should appear
twice there (once under 'PHP Modules' and once under 'Zend Modules').</li>
</ol>
</p>

<a name='compat'></a>
<span class='sans'>COMPATIBILITY</span><br />
<p>
Xdebug does not work together with the Zend Optimizer or any other Zend
extension (DBG, APC, APD etc).  This is due to compatibility problems with
those modules. We will be working on figuring out what the problems are, and of
course try to fix those.
</p>


<a name='phpize'></a>
<span class='sans'>PHPIZE OUTPUT TABLE</span><br />
<p>
<table border='1' cellspacing='0'>
	<tr>
		<th class='ctr'>PHP Version:</th>
		<td class='ctr'>PHP Api Version:</td>
		<td class='ctr'>Zend Module Api No:</td>
		<td class='ctr'>Zend Extension Api No:</td>
		<td class='ctr'>Recommended version:</td>
	</tr>
	<tr>
		<th class='ctr'>4.4.x</th>
		<td class='ctr'>20020918</td>
		<td class='ctr'>20020429</td>
		<td class='ctr'>20050606</td>
		<td class='ctr'>2.0.0-rc1 or cvs</td>
	</tr>
	<tr>
		<th class='ctr'>5.1.x</th>
		<td class='ctr'>20041225</td>
		<td class='ctr'>20050922</td>
		<td class='ctr'>220051025</td>
		<td class='ctr'>2.0.0-rc1 or cvs</td>
	</tr>
	<tr>
		<th class='ctr'>5.2.x</th>
		<td class='ctr'>20041225</td>
		<td class='ctr'>20060613</td>
		<td class='ctr'>220060519</td>
		<td class='ctr'>2.0.0-rc1 or cvs</td>
	</tr>
</table>
<br/>
</p>

<a name='debugclient'></a>
<span class='sans'>DEBUGCLIENT INSTALLATION</span><br />

<p>
Unpack the Xdebug source tarball and issue the following commands:
</p>
<pre class='example'>
$ cd debugclient
$ ./configure --with-libedit
$ make
# make install
</pre>
<p>
This will install the debugclient binary in /usr/local/bin unless you don't 
have libedit installed on your system. You can either install it, or leave
out the '--with-libedit' option to configure. Debian 'unstable' users can
install the library with <code>apt-get install libedit-dev libedit2</code>.
</p>
<p>
If the configure script can not find libedit and you are sure you have (and
it's headers) installed correctly and you get link errors like the
following in your configure.log:
</p>
<pre class='example'>
/usr/lib64/libedit.so: undefined reference to `tgetnum'
/usr/lib64/libedit.so: undefined reference to `tgoto'
/usr/lib64/libedit.so: undefined reference to `tgetflag'
/usr/lib64/libedit.so: undefined reference to `tputs'
/usr/lib64/libedit.so: undefined reference to `tgetent'
/usr/lib64/libedit.so: undefined reference to `tgetstr'
collect2: ld returned 1 exit status
</pre>
<p>
you need to change your configure command to:
</p>
<pre class='example'>
$ LDFLAGS=-lncurses ./configure --with-libedit
</pre>"
	),
	'basic' => array(
		'Basic Features',
		FUNC_BASIC,
		'Xdebug\'s basic functions include the display of stack traces on error
		conditions, maximum nesting level protection and time tracking.',
		""
	),
	'display' => array(
		'Variable Display Features',
		FUNC_VAR_DUMP,
		'Xdebug replaces PHP\'s var_dump() function for displaying variables.
		Xdebug\'s version includes different colors for different types and
		places limits on the amount of array elements/object properties,
		maximum depth and string lengths. There are a few other functions
		dealing with variable display as well.',
		""
	),
	'stack_trace' => array(
		'Stack Traces',
		FUNC_STACK_TRACE,
		'The information that stack traces display, and the way how they are
		presented, can be configured to suit your needs.',
		""
	),
	'execution_trace' => array(
		'Function Traces',
		FUNC_FUNCTION_TRACE,
		'Xdebug allows you to log all function calls, including parameters and
		return values to a file in different formats.',
		""
	),
	'code_coverage' => array(
		'Code Coverage Analysis',
		FUNC_CODE_COVERAGE,
		'Code coverage tells you which lines of script (or set of scripts) have
		been executed during a request. With this information you can for
		example find out how good your unit tests are.',
		""
	),
	'profiler' => array(
		'Profiling PHP Scripts',
		FUNC_PROFILER,
		'Xdebug\'s built-in profiler allows you to find bottlenecks in your
		script and visualize those with an external tool such as KCacheGrind or
		WinCacheGrind.',
		""
	),
	'remote' => array(
		'Remote Debugging',
		FUNC_REMOTE,
		'Xdebug provides an interface for debugger clients that interact with
		running PHP scripts. This section explains how to set-up PHP and Xdebug
		to allow this, and introduces a few clients.',
		""
	),
);
?>