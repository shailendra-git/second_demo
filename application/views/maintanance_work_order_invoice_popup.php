
<div  id="editModal">
   <div>
      <div class="padd-top-l">
         <!-- Modal Header -->
         <div>
         
          <form method="post" target="_parent" onsubmit="return invoiceValidation()" action="<?php echo base_url('owner/uploadWorkOrderInvoice');?>"  class="dropzoneForm ">
                <h4 class="modal-title">REQUEST PAYMENT</h4>
                <!-- Modal body -->
                
                <div class="">
                    <input type="hidden"
                     name="workorder_id" value="<?php echo $workorderinfo['id']; ?>">  
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="padd-top">
                                  <label for="maintenance " class="bmd-label-floating">Amount *</label>
                                  <div class="input-group">
                                     <input type="text" class="form-control" name="amount" required="" autocomplete="off">
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="">
                                  <label for="maintenance " class="bmd-label-floating">Due Date * </label>
                                  <div class="input-group">
                                    <input  type="text" id="datepicker" class="form-control" name="due_date" required="" autocomplete="off">
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <div class="">
                                  <label for="maintenance " class="bmd-label-floating">Payable To * </label>
                                  <div class="input-group">
                                    <input style="line-height: 0.5" type="text" class="form-control" name="payable_to" required="" autocomplete="off">
                                     
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                               <div class="">
                                  <label for="maintenance " class="bmd-label-floating">Memo * </label>
                                  <div class="input-group">
                                    <input style="line-height: 0.5" type="text" class="form-control" name="memo" required="" autocomplete="off">
                                  </div>
                               </div>
                            </div>
                         </div>
                         <div class="row bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <input type="hidden" name="file_name" id="filename" required="">
                                <div class="dz-default dz-message" style="cursor: pointer;"><span><i class="material-icons">cloud_upload</i> Drag Files or Click Here to Upload</span> </div>
                                <div class="pull-right"><button type="submit" class="btn2 btn_team_edit_save" >Submit</button>
                                <button type="button" class="btn btn-default btn_cancle" onClick="parent.closePopup();">Cancel</button></div>

                                
                                
                         </div> 
                         <div id="myInvoiceDIV" style="display: none; color: red;">
                            Please Choose Invoice Image.
                          </div> 
                  </div>
                </div>
               </form>
            </div>
        <!-- Modal footer -->
      </div>
   </div>
</div>

<style>

form#mainform input[type="email"] {
    border: 1px solid #E5E5E5;
    margin-bottom: 3px;
    padding: 5px;
}
form#mainform input[name="submit"] {
    border: 1px solid #BBBBBB;
    border-radius: 12px 12px 12px 12px;
    color: #464646;
    cursor: pointer;
    font-size: 13px;
  
    padding: 3px 8px;
}
form#mainform input[name="submit"]:hover {
    border: 1px solid #666666;
}
span.validation {
    font-style:italic;
    color:#B41F2B;
}
span.loading {
    font-style: italic;
    left: 5px;
    position: relative;
}
.dz-image {
    /* float: right; */
    margin-top: -90px;
    margin-right: 15px;
    text-align: center;
    
}
.dz-filename{
  display: none;
}
.dz-size{
  display: none;
}
.dz-details{
  display: none;
}
.dz-success-mark
{
  display: none;
}
.dz-error-mark
{
  display: none;
}
.custom-file-control, .form-control {
  padding: 0px !important;
}
</style>

  



 

