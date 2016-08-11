
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<style>
    .table>thead>tr>th {
        vertical-align: middle;
    }
</style>


                <div class="panel panel-default">
                    <div class="panel-heading">Purchased Requests</div>

                    <!-- /.box-header -->
                    <div class="panel-body">

                        <form method="post" id="add-procurement-form" action="<?php echo site_url('purchased_request/save_request'); ?>">
                            <input type="hidden" name="pr_id" value="<?php echo $requests->pr_id; ?>" />
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label>Department</label>
                                    <select name="office_id" class="form-control required" id="office_id">
                                        <option value="">Select Department</option>
                                        <?php foreach($offices as $office):?>
                                            <option value="<?php echo $office->ofc_id; ?>" <?php echo ($requests->pr_department_id == $office->ofc_id) ? "selected":""; ?> ><?php echo $office->ofc_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>SAI No:</label>
                                    <input class="form-control" type="text" placeholder="" name="pr_sai_no" value="<?php echo $requests->pr_sai_no; ?>" />
                                </div>
                                <div class="form-group col-md-3">
                                    <label>SAI DATE</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control text-right date-picker" name="pr_sai_date" value="<?php echo strtotime($requests->pr_sai_date) ? $requests->pr_sai_date : ""; ?>" />
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-md-6">
                                    <label>Schedule</label>
                                    <select name="pr_quarter" class="form-control required" id="quarter">
                                        <option value="">Select Quarter</option>
                                        <?php for($i=1;$i<=4;$i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($i == $requests->pr_quarter) ? "selected" : ""; ?>>Quarter <?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>ALOBS No:</label>
                                    <input class="form-control" type="text" placeholder="" name="pr_alobs_no" value="<?php echo $requests->pr_alobs_no; ?>" />
                                </div>

                                <div class="form-group col-md-3">
                                    <label>ALOBS DATE</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control text-right date-picker" name="pr_alobs_date" type="text" placeholder=""  value="<?php echo strtotime($requests->pr_alobs_date) ? $requests->pr_alobs_date : ""; ?>" />
                                    </div>
                                </div>




                                <div class="form-group col-md-6">
                                    <label>Purpose</label>
                                    <textarea name="pr_purpose" class="form-control" placeholder="Purpose text here"><?php echo $requests->pr_purpose; ?></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Section</label>
                                    <input class="form-control" name="pr_section" type="text" placeholder="Section" value="<?php echo $requests->pr_section; ?>" />
                                </div>


                                <div class="clearfix"></div>

                            </div>


                            <div class="form-group col-md-12"  style="padding: 10px;border: 4px solid #d3d3d3;">

                                <div class="grid panel panel-default" id="grid_ppmp">
                                    <div class="panel-heading">
                                        Procurement Plans
                                    </div>
                                    <div class="panel-body">
                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
                                            <thead>
                                            <tr class="header">
                                                <th width="1%"><input name="select_all" value="1" type="checkbox"></th>
                                                <th width="5%">Code</th>
                                                <th>General Description</th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Cost</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tr class="init-row">
                                                <td><input type="checkbox" class="pri_chk ppmp_id" name="pr_ppmp_id[]" /></td>
                                                <td>
                                                    <span class="ppmp_code"></span>
                                                </td>
                                                <td><span class="ppmp_description"></span></td>
                                                <td><span class="qty"></span></td>
                                                <td><span class="unit_name"></span></td>
                                                <td><span class="qty_cost"></span></td>
                                                <td>
                                                    <div class="quicklinks pull-right">
                                                        <a href="<?php echo site_url('purchased_request/editItems'); ?>/" class="ppmp_id display-modal param" title="Edit Record">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="grid-controls panel-footer">
                                        <div class="pad row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="currentPage"></span> of <span class="totalPages"></span> of <span class="totalRecords"></span> records.</span>
                                                    <input type="text" class="form-control gotopage" name="gotopage">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-default go-page">Go To Page</button>
                                                    </div><!-- /btn-group -->
                                                </div><!-- /input-group -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="paging pull-right">
                                                    <a href="#" class="page-previous page-link btn btn-default" rel="">Previous Page</a>
                                                    <a href="#" class="page-next page-link btn btn-default" rel="">Next Page</a>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="grid_url" value="<?php echo site_url('purchased_request/getProcurementPlans'); ?>" />
                                    <input type="hidden" name="parameters" value="" />
                                </div>

                            </div>

                            <div class="form-group col-md-4">
                                <label>Requested By</label>
                                <select name="pr_requested_by" class="form-control required">
                                    <option value="">Select User</option>
                                    <?php foreach($users as $user): ?>
                                        <option value="<?php echo $user->u_id; ?>" <?php echo ($user->u_id == $requests->pr_requested_by) ? "selected" : ""; ?>><?php echo $user->u_firstname . " " . @$user->u_middlename[0] . " " . $user->u_lastname . " " . $user->u_extname; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <input type="hidden" name="action" value="<?php echo $requests->pr_id ? "edit" : "add"; ?>">
                            <input type="hidden" name="id" value="<?php echo $requests->pr_id; ?>">
                            <input type="hidden" name="parent_grid" value="#grid_pr">
                            <input type="hidden" name="reload_grid" value="">
                            <input type="hidden" name="add_last_id" value="true">
                            <input type="hidden" name="type" value="users">


                        </form>

                    </div>


                    <script language="javascript">
                        var ppmp_grid = null;
                        function checkPlans(){
                            var office_id = $("#office_id").val();
                            var quarter = $("#quarter").val();
                            var load = false;
                            if(office_id && quarter)
                                load = true;

                            $("input[name=parameters]").val( "pr_id=<?php echo $pr_id; ?>" + "&load=" + load + "&quarter=" + quarter + "&office=" + office_id )
                        }



                        $(document).ready(function(){
                            checkPlans();
                            ppmp_grid = $('#grid_ppmp').grid();

                            $('.numeric').numeric();
                            $( document ).on( 'focus', ':input', function(){
                                $( this ).attr( 'autocomplete', 'off' );
                            });
                            $('.date-picker').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true
                            });

                            $("#quarter, #office_id").change(function(){
                                checkPlans();
                                reloadGrid('#grid_ppmp');
                            });

                        });

                    </script>