<div class="portlet-body">
    <div class="table-container">
        <div class="table-actions-wrapper">
            <span> </span>
            <select class="table-group-action-input form-control input-inline input-small input-sm">
                <option value="">Select...</option>
                <option value="Cancel">Cancel</option>
                <option value="Cancel">Hold</option>
                <option value="Cancel">On Hold</option>
                <option value="Close">Close</option>
            </select>
            <button class="btn btn-sm btn-default table-group-action-submit">
                <i class="fa fa-check"></i> Submit</button>
        </div>
        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_orders">
            <thead>
                <tr role="row" class="heading">
                    <th width="2%">
                        <input type="checkbox" class="group-checkable"> </th>
                    <th width="5%"> Order&nbsp;# </th>
                    <th width="15%"> Purchased&nbsp;On </th>
                    <th width="15%"> Customer </th>
                    <th width="10%"> Ship&nbsp;To </th>
                    <th width="10%"> Base&nbsp;Price </th>
                    <th width="10%"> Purchased&nbsp;Price </th>
                    <th width="10%"> Status </th>
                    <th width="10%"> Actions </th>
                </tr>
                <tr role="row" class="filter">
                    <td> </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td>
                    <td>
                        <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control form-filter input-sm" readonly name="order_date_from" placeholder="From">
                            <span class="input-group-btn">
                                <button class="btn btn-sm default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control form-filter input-sm" readonly name="order_date_to" placeholder="To">
                            <span class="input-group-btn">
                                <button class="btn btn-sm default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="order_customer_name"> </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="order_ship_to"> </td>
                    <td>
                        <div class="margin-bottom-5">
                            <input type="text" class="form-control form-filter input-sm" name="order_base_price_from" placeholder="From" /> </div>
                        <input type="text" class="form-control form-filter input-sm" name="order_base_price_to" placeholder="To" /> </td>
                    <td>
                        <div class="margin-bottom-5">
                            <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="order_purchase_price_from" placeholder="From" /> </div>
                        <input type="text" class="form-control form-filter input-sm" name="order_purchase_price_to" placeholder="To" /> </td>
                    <td>
                        <select name="order_status" class="form-control form-filter input-sm">
                            <option value="">Select...</option>
                            <option value="pending">Pending</option>
                            <option value="closed">Closed</option>
                            <option value="hold">On Hold</option>
                            <option value="fraud">Fraud</option>
                        </select>
                    </td>
                    <td>
                        <div class="margin-bottom-5">
                            <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                <i class="fa fa-search"></i> Search</button>
                        </div>
                        <button class="btn btn-sm btn-default filter-cancel">
                            <i class="fa fa-times"></i> Reset</button>
                    </td>
                </tr>
            </thead>
            <tbody> </tbody>
        </table>
    </div>
</div>