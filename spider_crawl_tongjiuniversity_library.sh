#!/bin/bash

for (( i=337; i < 338; i++))
do
	let OFFSET=10000
	let MARC_START=$OFFSET*i+1
	TARGET=$(printf 'spider/Library/TongjiUniversity/result%.10d.txt' $MARC_START)
	ERROR=$(printf 'spider/Library/TongjiUniversity/error%.10d.txt' $MARC_START)
	./yii spider/library/crawl TongjiUniversity "$MARC_START" "$OFFSET" 1>"$TARGET" 2>"$ERROR" &
done

