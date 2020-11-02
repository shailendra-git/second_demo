

  <form style="height: 600px;" class="popup_form_margin" id="transaction_validation" target="_parent" action="" method="POST">
    <br>
    <br>
    <h3 class="modal-title update_category">Change Payment Request</h3>  
    <br>
    <br>
          <div class="form-group">
            <div class="row bottom">
            <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 " >
               <label for="category" class="bmd-label-floating">Category *</label>
                <div class="select-wrapper">
                  <select name="category" class="form-control" >
                    <?php
                     foreach ($transaction_category as $category) {
                     ?>
                     <option  value="<?php echo $category['id'];?>"><?php
                     echo $category['category_show_name'];
                     ?></option>
                             <?php
                     }
                     ?>
                  </select> 
                  <span class="caret">▼</span>
                </div>
             </div>
            </div>
          </div>         
          <div class="form-group pull-right">
            <button type="submit" class="btn btn-primary btn-raised">SAVE</button>
            <button type='button' class="btn btn-default btn_cancle">CANCEL</button>
          </div>
  </form>


  
