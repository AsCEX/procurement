<?php

function br2nl( $input ) {
    return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($input))));
}
?>
<div style="padding:20px 10px;">
    <form id="pr-item-detail-fm" method="post" novalidate>

        <input type="hidden" name="pri_id" value="<?php echo isset($pri->pri_id) ? $pri->pri_id : ''; ?>" />
        <div class="fitem">
            <label>Qty:</label>
            <input name="pri_qty" class="easyui-numberbox" required="true" align="right" precision="2" groupSeparator=","  value="<?php echo isset($pri->pri_qty) ? $pri->pri_qty : ""; ?>">
        </div>


        <div class="fitem">
            <label>Item Cost:</label>
            <input name="pri_cost" class="easyui-numberbox" required="true" min="0" precision="2" groupSeparator="," align="right" value="<?php echo isset($pri->pri_cost) ? $pri->pri_cost : ""; ?>">
        </div>


        <div class="fitem">
            <label>Description:</label>
            <input name="pri_description" class="easyui-textbox" required="true" multiline="true" style="width:200px;height:100px;" value="<?php echo isset($pri->pri_description) ? str_ireplace("<br />", "&#13;&#10;", $pri->pri_description) : ""; ?>">
        </div>

        <!--<input type="hidden" name="schedules" id="schedules" value="" />-->
    </form>

</div>