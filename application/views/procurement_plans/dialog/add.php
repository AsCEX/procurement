
<form id="ppmp-fm" method="post" novalidate>

<input type="hidden" name="ppmp_id" value="<?php echo ($ppmp_id) ? $ppmp_id : 0; ?>" />
<div id="cc" class="easyui-layout" fit="true" style="height:450px;">
    <div data-options="region:'east',title:'Schedules',split:true,hideCollapsedContent:false" style="width:50%;">
        <table id="pg-setting" class="easyui-propertygrid" fit="true" border="false" sortable="false"
               toolbar="#tb-setting" showGroup="true">
        </table>
    </div>
    <div data-options="region:'center',title:'Procurement'" style="padding:5px;">
        <div class="fitem">
            <label>Code:</label>
            <input name="ppmp_code" class="easyui-numberbox" required="true" align="right" value="<?php echo isset($ppmp->ppmp_code) ? $ppmp->ppmp_code : ""; ?>">
        </div>

        <div class="fitem">
            <label>Office:</label>
            <select class="easyui-combobox" editable="false" name="ppmp_office_id" style="width:250px"
                    url="<?php echo site_url('offices/getComboboxOffices'); ?>/<?php echo isset($ppmp->ppmp_office_id) ? $ppmp->ppmp_office_id : ''; ?>"
                    method="get"
                    valueField="name"
                    prompt="Select Office"
                    textField="value"
                    required="true">
            </select>
        </div>

        <div class="fitem">
            <label>Category:</label>
            <select class="easyui-combobox" editable="false" name="ppmp_category" style="width:250px"
                    url="<?php echo site_url('categories/getCategories'); ?>/<?php echo isset($ppmp->ppmp_category_id) ? $ppmp->ppmp_category_id : ''; ?>"
                    method="get"
                    valueField="name"
                    prompt="Select Category"
                    textField="value"
                    required="true">
            </select>
        </div>

        <div class="fitem">
            <label>Description:</label>
            <input name="ppmp_description" class="easyui-textbox" required="true" multiline="true" style="width:200px;height:100px;" value="<?php echo isset($ppmp->ppmp_description) ? $ppmp->ppmp_description : ""; ?>">
        </div>

        <div class="fitem">
            <label>Unit:</label>
            <input id="units" name="ppmp_unit" value="<?php echo isset($ppmp->ppmp_unit) ? $ppmp->ppmp_unit : ''; ?>" style="width:150px"/>
            <!--<select class="easyui-combobox" editable="false" name="ppmp_unit" style="width:150px"
                    url="<?php /*echo site_url('units/getUnits'); */?>"
                    method="get"
                    valueField="name"
                    prompt="Select Units"
                    textField="value"
                    required="true">
            </select>-->
        </div>

        <div class="fitem">
            <label>Estimated Budget:</label>
            <input name="ppmp_budget" class="easyui-numberbox" required="true" min="0" precision="2" align="right" value="<?php echo isset($ppmp->ppmp_budget) ? $ppmp->ppmp_budget : ""; ?>">
        </div>

        <div class="fitem">
            <label>Funds:</label>
            <select class="easyui-combobox" editable="false" name="ppmp_source_fund" style="width:200px"
                    url="<?php echo site_url('funds/getSourceFunds'); ?>/<?php echo isset($ppmp->ppmp_source_fund) ? $ppmp->ppmp_source_fund : ''; ?>"
                    method="get"
                    valueField="name"
                    textField="value"
                    prompt="Select Funds"
                    required="true">
            </select>
        </div>
    </div>
</div>

    <input type="hidden" name="schedules" id="schedules" value="" />
</form>


<script>
    $(function(){
        $('#pg-setting').propertygrid({
            url: site_url + 'procurement_plan/schedules/<?php echo $ppmp_id; ?>',
            columns: [[
                {field:'name',title:'Month',width:100,sortable:true},
                {field:'value',title:'Quantity',width:100,resizable:false,align:'right',
                    formatter:function(value){
                        var s = '<div>';
                        s += '<div style="float:right;width:18px;height:18px;background:'+value+'">&nbsp;</div>';
                        s += value;
                        s += '<div style="clear:both"></div>';
                        s += '</div>';
                        return s;
                    }
                }
            ]],
            onClickRow: function(index, row){
                var ed = $(this).propertygrid('getEditor', {index:index,field:'value'});
                if (ed){
                    $(ed.target).unbind('.pg').bind('keydown.pg', function(e){
                        if (e.keyCode == 13){	// enter
                            $(document).triggerHandler('mousedown');
                        }

                    });

                    $(this).triggerHandler('dblclick');


                }
            },
            onLoadSuccess: function(){
                //  alert("SUCCESS");
                //previewTheme();
            },
            onAfterEdit: function(index, row){
                console.log(index);
                console.log(row);
            },
            onBeforeEdit: function(index, row){
                $(this).select();
            }
        });
    });



    function onChange(theme){
        //$('#pg-setting').propertygrid('load', {theme: theme});
    }

    procurement_plan.initForms();
</script>
<style type="text/css">
    .ic-table td{
        text-align:right;
    }
    .ic-table input{
        width:60px;
    }
    .ta-box{
        width:100%;
        height:100%;
        border:0;
        resize:none;
        -webkit-box-sizing:border-box;
        -moz-box-sizing:border-box;
        -ms-box-sizing:border-box;
        -o-box-sizing:border-box;
        box-sizing:border-box;
    }
</style>

