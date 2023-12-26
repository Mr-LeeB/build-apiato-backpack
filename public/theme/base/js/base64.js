/**
 *
Unicode Strings
In most browsers, calling window.btoa on a Unicode string will cause a Character Out Of Range exception.
To avoid this, consider this pattern, noted by Johan Sundström(http://ecmanaut.blogspot.com/2006/07/encoding-decoding-utf8-in-javascript.html):
*/
function utf8ToBase64( str ) {
    try {
        return( Buffer.from(str).toString('base64'));
    } catch( e) {
        console.log('Error when try to base64 encode of string ' + str + e.toString());
    }
}

function base64ToUtf8( str ) {
    try {
        return( Buffer.from(str, 'base64').toString());
    } catch( e) {
        console.log('Error when try to base64 decode of string ' + str + e.toString());
    }
}

/*
Useage: 
utf8_to_b64('✓ à la mode'); // "4pyTIMOgIGxhIG1vZGU="
b64_to_utf8('4pyTIMOgIGxhIG1vZGU='); // "✓ à la mode"
 */