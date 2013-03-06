<?php
/* PHPUnit.
* This script enables PHPUnit to run from a git checkout.
*
* Copyright (c) 2002-2013, Sebastian Bergmann <sebastian@phpunit.de>.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* * Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* * Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* * Neither the name of Sebastian Bergmann nor the names of his
* contributors may be used to endorse or promote products derived
* from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*/

$dir = dirname(__FILE__);
$vendor = $dir . '/vendor/';
set_include_path(implode(PATH_SEPARATOR, array(
$dir,
$vendor . 'phpunit/',
$vendor . 'php-code-coverage/',
$vendor . 'php-file-iterator/',
$vendor . 'php-text-template/',
$vendor . 'phpunit-mock-objects/',
$vendor . 'php-token-stream/',
$vendor . 'dbunit/',
$vendor . 'phpunit-story/',
$vendor . 'php-timer/',
$vendor . 'php-invoker/',
get_include_path()
)));
require $vendor . 'phpunit/phpunit.php';
