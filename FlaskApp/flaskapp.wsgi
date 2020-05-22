#!/usr/bin/python
import sys
import logging
logging.basicConfig(stream=sys.stderr)
sys.path.insert(0,"/var/www/html/FlaskApp/")

from FlaskApp import app as application
application.secret_key = 'b"\xc1m\xef\xaa\x01_\xdc\x8d3Z'KP\x17\xfd\xfe"'