<div
                class="modal fade text-start"
                id="admin_lein_wallet_t_model"
                tabindex="-1"
                aria-labelledby="myModalLabel20"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered modal-xs">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel20">Enter Remark</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <label for="">Amount</label>
                      <input type="number" class="form-control" name="" id="admin_lein_t_amount" placeholder="Enter Amount">
                  </div>
                    <div class="modal-body">
                      <label for="">Remark</label>
                        <input type="text" class="form-control" name="" id="admin_lein_t_remark" placeholder="Enter Remark">
                    </div>
                    
                    <div class="modal-footer">
                      <button type="button" onclick="multy_lein_tranfer_form_btn_submit()" class="btn btn-block btn-success">Proceed</button>
                      <button type="button" id="add_money_model_cancel" class="btn btn-danger btn-block" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
<div
                class="modal fade text-start"
                id="add_money_model"
                tabindex="-1"
                aria-labelledby="myModalLabel20"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered modal-xs">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel20">Add Money</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('add_money_form') }}" method="post">
                      @csrf
                    <div class="modal-body">
                      <div class="user_data_model_css text-success">User name : <span class="uname"></span></div>
                      <div class="user_data_model_css text-success">Shop name : <span class="shopname"></span></div>
                        <input type="number" required class="form-control" name="amount" onkeyup="get_calculate_val()" id="add_amount_field" placeholder="Enter amount">
                        <span class="mb-2 mt-1" id="ammount_in_word_admin" style="text-transform: capitalized;color:hotpink;"></span><span id="nhide" style="color:hotpink;display:none;"> rupees only</span>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" id="shop_id_fild" name="shop_id">
                      <input type="text" required class="form-control" name="remark" id="remark_field" placeholder="Enter remark">
                  </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-block btn-dark">Credit Money</button>
                      <button type="button" id="add_money_model_cancel" class="btn btn-dark btn-block" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
      <div
                class="modal fade text-start"
                id="deduct_money_model"
                tabindex="-1"
                aria-labelledby="myModalLabel20"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered modal-xs">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel20">Deduct Money</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('deduct_money_form') }}" method="post">
                      @csrf
                    <div class="modal-body">
                      <div class="user_data_model_css text-success">User name : <span class="uname"></span></div>
                      <div class="user_data_model_css text-success">Shop name : <span class="shopname"></span></div>
                        <input type="number" required class="form-control" name="amount" onkeyup="get_deduct_calculate_val()" id="deduct_amount_field" placeholder="Enter amount">
                        <span class="mb-2 mt-1" id="deduct_amount_field_inword" style="text-transform: capitalized;color:hotpink;"></span><span id="nhide" style="color:hotpink;display:none;"> rupees only</span>
                    </div>
                    <div class="modal-body">
                      {{-- <div class="mb-2">
                        <label for="">Current balance</label>
                        <input type="text" readonly name="" value="" id="user_own_wll_bal">
                      </div> --}}
                      <input type="hidden" id="de_shop_id_fild" name="shop_id">
                      <input type="text" required class="form-control" name="remark" id="de_remark_field" placeholder="Enter remark">
                  </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-block btn-dark">Deduct Money</button>
                      <button type="button" id="deduct_money_model_cancel" class="btn btn-dark btn-block" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <div
class="modal fade text-start"
id="customdateinfobox"
tabindex="-1"
aria-labelledby="myModalLabel20"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered modal-xs">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel20">Select Custom Date</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 mb-2">
            <input type="hidden" id="customdateinfobox_value">
            <input type="hidden" id="customdateinfobox_boxid">
            <input type="hidden" id="filter_uid">
            <label for="">From Date</label>
            <div class="is_view_user_div">
              <input type="text" name="" id="home_filter_from_date" class="form-control">
            </div>
            <div class="not_view_user_div">
              <input type="text" name="" id="admin_filter_from_date" class="form-control">
            </div>
          </div>
          <div class="col-md-12 mb-2">
            <label for="">To Date</label>
            <div class="is_view_user_div">
              <input type="text" name="" id="home_filter_to_date" class="form-control">
            </div>
            <div class="not_view_user_div">
              <input type="text" name="" id="admin_filter_to_date" class="form-control">
            </div>
          </div>
          <div class="col-md-12 mb-2">
            <button id="not_viewuser" type="button" onclick="admin_utilities_date_filter()" class="btn btn-block btn-success">Submit</button>
            <button style="display: none" id="yes_not_viewuser" type="button" onclick="home_date_filter()" class="btn btn-block btn-success">Filter</button>
          </div>
        </div>
      </div>
  </div>
</div>
</div>
