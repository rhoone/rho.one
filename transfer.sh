#!/bin/bash
for (( i=1; i < 1386; i++))
do
    let OFFSET=1000
    let START=$OFFSET*i
    ./yii spider/library/transfer TongjiUniversity "$START" "$OFFSET"
done
