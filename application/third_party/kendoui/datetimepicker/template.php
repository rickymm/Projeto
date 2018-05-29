<?php

require_once '../lib/Kendo/Autoload.php';
require_once '../include/header.php';
?>
<div class="demo-section k-content">
    <h4>Birthday Calendar</h4>
<?php
$dateTimePicker = new \Kendo\UI\DateTimePicker('datetimepicker');
$dateTimePicker->value(new DateTime('today', new DateTimeZone('UTC')))
            ->month(array(
               'content' => <<<TEMPLATE
# if (isInArray(data.date, birthdays)) { #
    <div class="birthday"></div>
# } #
#= data.value #
TEMPLATE
            ))
            ->footer("Today - #= kendo.toString(data, 'd') #")
            ->open("onOpen")
            ->attr('style', 'width: 100%;');

echo $dateTimePicker->render();
?>
</div>
<script>
    function onOpen() {
        var dateViewCalendar = this.dateView.calendar;
        if (dateViewCalendar) {
            dateViewCalendar.element.width(300);
        }
    }

    var today = new Date();
    var birthdays = [
           new Date(today.getFullYear(), today.getMonth(), 11),
           new Date(today.getFullYear(), today.getMonth() + 1, 6),
           new Date(today.getFullYear(), today.getMonth() + 1, 27),
           new Date(today.getFullYear(), today.getMonth() - 1, 3),
           new Date(today.getFullYear(), today.getMonth() - 2, 22)
    ];

    function isInArray(date, dates) {
        for(var idx = 0, length = dates.length; idx < length; idx++) {
            var d = dates[idx];
            if (date.getFullYear() == d.getFullYear() &&
                date.getMonth() == d.getMonth() &&
                date.getDate() == d.getDate()) {
                return true;
            }
        }

        return false;
    }
</script>

<style>
    .birthday {
        background: transparent url(../content/web/calendar/cake.png) no-repeat 0 50%;
        display: inline-block;
        width: 16px;
        height: 16px;
        vertical-align: middle;
        margin-right: 3px;
    }
</style>
<?php require_once '../include/footer.php'; ?>
