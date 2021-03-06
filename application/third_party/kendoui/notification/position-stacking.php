<?php
require_once '../include/header.php';
require_once '../lib/Kendo/Autoload.php';
?>

<?php

$centeredNotification = new \Kendo\UI\Notification('centeredNotification');
$centeredNotification->stacking('down');
$centeredNotification->show('onShow');
$centeredNotification->button(true);

echo $centeredNotification->render();

$configurableNotification = new \Kendo\UI\Notification('configurableNotification');

echo $configurableNotification->render();

?>

<div class="demo-section k-content">
    <div class="box-col">
    <h4>Centered notification:</h4>
        <ul>
            <li><button id="showNotification" class="k-button">Show centered notification</button></li>
        </ul>
    </div>

    <div class="box-col">
    <h4>Custom positioning:</h4>
        <ul>
            <li><label for="left">Left position:</label> <input type="number" id="left" class="num" /></li>
            <li><label for="left">Top position:</label> <input type="number" id="top" class="num" /></li>
            <li><label for="left">Right position:</label> <input type="number" id="right" class="num" value="20" /></li>
            <li><label for="left">Bottom position:</label> <input type="number" id="bottom" class="num" value="20" /></li>
            <li>
                <label for="stacking">Notification stacking:</label>
                <select id="stacking" style="width:6em">
                    <option selected="selected">default</option>
                    <option>up</option>
                    <option>right</option>
                    <option>down</option>
                    <option>left</option>
                </select>
            </li>
            <li><button id="showConfigurable" class="k-button">Show notification</button></li>
            <li><p class="demo-hint">Top / Left position settings take precedence over Bottom / Right, if both pairs are set.</p></li>
            
        </ul>
    </div>

    <div class="box-col">
    <h4>Hide notification:</h4>
        <ul>
            <li><button id="hideAllNotifications" class="k-button">Hide all notifications</button></li>
        </ul>
    </div>
</div>

<script>

  function onShow(e) {
    if (e.sender.getNotifications().length == 1) {
      var element = e.element.parent(),
      eWidth = element.width(),
      eHeight = element.height(),
      wWidth = $(window).width(),
      wHeight = $(window).height(),
      newTop, newLeft;

      newLeft = Math.floor(wWidth / 2 - eWidth / 2);
      newTop = Math.floor(wHeight / 2 - eHeight / 2);

      e.element.parent().css({top: newTop, left: newLeft});
    }
  }

  $(document).ready(function() {
    var centered = $("#centeredNotification").data("kendoNotification");

    $("#showNotification").click(function(){
      var d = new Date();
      centered.show(kendo.toString(d, 'HH:MM:ss.') + kendo.toString(d.getMilliseconds(), "000"));
    });

    var configurable = $("#configurableNotification").data("kendoNotification");

    $("#hideAllNotifications").click(function(){
      centered.hide();
      configurable.hide();
    });

    function applyConfiguration() {
      configurable.hide();
      configurable.setOptions({
        position: {
          top: $("#top").data("kendoNumericTextBox").value(),
          left: $("#left").data("kendoNumericTextBox").value(),
          bottom: $("#bottom").data("kendoNumericTextBox").value(),
          right: $("#right").data("kendoNumericTextBox").value()
        },
        stacking: $("#stacking").data("kendoDropDownList").value()
      });
    }

    var config = {
      decimals: 0,
      min: 0,
      format: "n0",
      change: applyConfiguration
    };

    $(".num").each(function(){
      $(this).kendoNumericTextBox(config);
    });

    $("#stacking").kendoDropDownList({
      change: applyConfiguration
    });

    $("#showConfigurable").click(function(){
      var d = new Date();
      configurable.show(kendo.toString(d, 'HH:MM:ss.') + kendo.toString(d.getMilliseconds(), "000"));
    });
  });
</script>

<style>

 .box-col label {
      display: inline-block;
      width: 11em;
      padding-right: .8em;
  }

  .box-col li {
      padding-bottom: .3em;
  }

  .num {
      width: 6em;
  }

</style>

<?php require_once '../include/footer.php'; ?>