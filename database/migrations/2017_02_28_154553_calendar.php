<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Calendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //https://www.brianshowalter.com/blog/calendar_tables
        Schema::table('migrations',function(Blueprint $table){
            $sql="CREATE TABLE calendar_table (
                    dt DATE NOT NULL PRIMARY KEY,
                    y SMALLINT NULL,
                    q tinyint NULL,
                    m tinyint NULL,
                    d tinyint NULL,
                    dw tinyint NULL,
                    monthName VARCHAR(9) NULL,
                    dayName VARCHAR(9) NULL,
                    w tinyint NULL,
                    isWeekday BINARY(1) NULL,
                    isHoliday BINARY(1) NULL,
                    holidayDescr VARCHAR(32) NULL
                );

                CREATE TABLE ints ( i tinyint );
                 
                INSERT INTO ints VALUES (0),(1),(2),(3),(4),(5),(6),(7),(8),(9);
                 
                INSERT INTO calendar_table (dt)
                SELECT DATE('2010-01-01') + INTERVAL a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i DAY
                FROM ints a JOIN ints b JOIN ints c JOIN ints d JOIN ints e
                WHERE (a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i) <= 11322
                ORDER BY 1;

                UPDATE calendar_table
                SET isWeekday = CASE WHEN dayofweek(dt) IN (1,7) THEN 0 ELSE 1 END,
                    isHoliday = 0,
                    y = YEAR(dt),
                    q = quarter(dt),
                    m = MONTH(dt),
                    d = dayofmonth(dt),
                    dw = dayofweek(dt),
                    monthname = monthname(dt),
                    dayname = dayname(dt),
                    w = week(dt),
                    holidayDescr = '';

                UPDATE calendar_table SET isHoliday = 1, holidayDescr = 'New Year''s Day' WHERE m = 1 AND d = 1;
                 
                UPDATE calendar_table c1
                LEFT JOIN calendar_table c2 ON c2.dt = c1.dt + INTERVAL 1 DAY
                SET c1.isHoliday = 1, c1.holidayDescr = 'Holiday for New Year''s Day'
                WHERE c1.dw = 6 AND c2.m = 1 AND c2.dw = 7 AND c2.isHoliday = 1;
                 
                UPDATE calendar_table c1
                LEFT JOIN calendar_table c2 ON c2.dt = c1.dt - INTERVAL 1 DAY
                SET c1.isHoliday = 1, c1.holidayDescr = 'Holiday for New Year''s Day'
                WHERE c1.dw = 2 AND c2.m = 1 AND c2.dw = 1 AND c2.isHoliday = 1;

                UPDATE calendar_table
                SET isHoliday = 1, holidayDescr = 'Christmas Day'
                WHERE m = 12 AND d = 25;
                 
                UPDATE calendar_table c1
                LEFT JOIN calendar_table c2 ON c2.dt = c1.dt + INTERVAL 1 DAY
                SET c1.isHoliday = 1, c1.holidayDescr = 'Holiday for Christmas Day'
                WHERE c1.dw = 6 AND c2.m = 12 AND c2.d = 25 AND c2.dw = 7 AND c2.isHoliday = 1;
                 
                UPDATE calendar_table c1
                LEFT JOIN calendar_table c2 ON c2.dt = c1.dt - INTERVAL 1 DAY
                SET c1.isHoliday = 1, c1.holidayDescr = 'Holiday for Christmas Day'
                WHERE c1.dw = 2 AND c2.m = 12 AND c2.d = 25 AND c2.dw = 1 AND c2.isHoliday = 1;

                DROP TABLE ints;";
            DB::connection()->getPdo()->exec($sql);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('calendar_table');
    }
}
