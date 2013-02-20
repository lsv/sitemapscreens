#!/bin/bash
if [ -z $1 ];
then
    echo "Sitemap url (http://www.google.com/sitemap.xml)"
    read SITEMAP
else
    SITEMAP=$1
fi

SITEMAP="${SITEMAP//\//\\/}"

RAND=$RANDOM

cp _Base.php $RAND.php
sed -i "s/#SITEMAPURL#/$SITEMAP/g" $RAND.php

selenium2
phpunit $RAND.php
rm $RAND.php