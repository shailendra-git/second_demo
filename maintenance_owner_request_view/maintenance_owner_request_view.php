<div class="contnet-area">
   <div class="container">
      <h3 style="margin:20px;"><a href="http://onelane.local.wiseit.com/owner/requests" class="back_style">Back to all requests</a> <span style="float: right;"> <a href=""  class="back_style">Printer-friendly version</a></span></h3>
      <div class="row"  >

         <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 border_col">
          <div class="row" >
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <h1 class="category">
               <?php echo $requestbasicinfo['name']; ?>
            </h1>
            <div class="address " >
               <?php echo $requestbasicinfo['address']; ?>, Unit <?php echo $requestbasicinfo['unit_id']; ?>, Las Vegas, NV 89119
            </div>
          </div>
           <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
          <div class="filter pull-right">
               <div class="switch ">
                  <label class="cls_opn">
            
             <span class="closed_right">Close</span>
             <input type="checkbox"  class="ember-checkbox ember-view ccenter-block" checked="">
             <span class="lever"></span>
            <span class="open_left">Open</span>
             
           </label>
               </div>
            </div>
          </div>
        </div>
            <div class="col s12">
               <h5 class="title">
                  <strong style="font-size: 20px;"><?php echo $requestbasicinfo['request_text']; ?></strong>
                  <a class="clickable edit-request edit_style" data-ember-action="" data-ember-action-2026="2026"  >
                  <i class="material-icons">edit</i>
                  </a>
               </h5>
               <?php 
               $timeago=get_time_ago(strtotime($requestbasicinfo['created_at']));
               ?>
               <p class="info">

                  Created by <?php echo $requestbasicinfo['firstname'];?> <?php echo $requestbasicinfo['lastname'];?> at <?php echo $timeago;?>, REF<?php echo $requestbasicinfo['ref_id'];?>
               </p>
               <div class="description">
                 
                  <?php echo $requestbasicinfo['description_text']; ?>
               </div>
               <!---->            
            </div>
            <div class="card col-md-12 mt-3">
         <div id="showImages">
                       <?php
               if(!empty($requestdocs))
               {
                  foreach ($requestdocs as $requestdoc) { 
                     $filename = explode('.',$requestdoc['file_name']);
               
                     ?>
                  <div id="<?php echo $filename[0]?>"  >
                     <div style="float: left; margin: 10px; margin-left: 0px;">
                        <img  src="<?php echo base_url('upload/request_doc/').$requestdoc['file_name']?>" class="img-thumbnail size_image">
                        <div>
                           <center>
                              <button class='requestfileremdoc save_change m_top_buttom ' file-name='<?php echo $filename[0]?>' data-proid="<?php echo $requestdoc['id']?>" rem-file="<?php echo $requestdoc['file_name']?>" >
                                 Remove
                              </button>
                           </center>
                        </div>
                     </div>
                  </div>
               <?php }
                  }
               ?>
                     </div>
      </div>
   

    <?php
    if($requestbasicinfo['status'] = 'Open'){
    ?>
      <div id="maintenance_request_hide">
      <div class="card col-md-12 mt-3">
         <div class="card-body ">
         <h6 class="mb-3">Private Property Documents</h6>
         <p class="text-small text-secondary my-3">Documents uploaded here are only visible to you and property members who can access the Property tab.
         </p>
         
        <form action="<?php echo base_url('owner/request_doc_uploadAndDelete');?>" class="dropzone dz-clickable" id=""> 
         <input type="hidden" name="request_doc_id" value=" <?php echo $requestbasicinfo['id']; ?>">   
         <div class="dz-default dz-message"><span><i class="material-icons">cloud_upload</i> Drag Files or Click Here to Upload</span></div>
        </form>
         </div>
         </div>
      </div>
      <?php
        }
        ?>
         
      </div>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 border_col ">
         
            <div class=" white work-orders-and-participants">
               <div  class="row ember-view">
                  <div class="col s12 m7">
                     <h3 style="float: left;">Work Orders</h3>
                     <div id="maintenannce_hide">
                     <div class="assign_m">
                      <a   class="simple-ajax-popup-align-top assign_style" href="/owner/getRequestById/<?php echo $requestbasicinfo['id'];?>" class="btn2 new_req_btn pull-right">

                       Assign
                       </a>
                     </div>
                     </div>

            
                  </div>


                 
                  <!---->              
      
               </div>
               
            </div>


            <div class="col s12">
                <p>
                  <input type="checkbox" class="checkbox_include" id="check_include_close" onclick="check_box(); ">
                  <label for="include-closed-work-orders" class="include_close">Include Closed</label>
                </p>
              </div>
          <?php
          foreach ($getworkorders as $getworkorder) {
           
          ?>
          <div class="card  mt-3" style="display: none" id="detail_worker">
            <div id="showImages">
              <div id="415303b0a1d4963ff362af6e1a05892d71c5d4771554474954request_1">
                <div>
                  <div class="card-body ">
                    <h6 class="mb-3 content_color">REF<?php echo $getworkorder['work_order_ref_id'];?></h6>
                    <p class="text-small text-secondary my-3"><a class="simple-ajax-popup-align-top" href="/team/getTeamById/95" style="color:#039be5;">
                      <?php echo $getworkorder['title'];?>                        </a>
                    </p>
                    <div class="managed-by participant">
                      <div class="info">
                        <div class="name content_color" >
                          <?php echo $getworkorder['contact_name'];?>
                          <?php echo $getworkorder['company_name'];?>  
                        </div>

                        <a style="color:#039be5;margin-top: 10px;     font-size: 15px;" href="tel:(958) 431-6586" class="phone-number">
                        <?php echo $getworkorder['mobile'];?> 
                        </a>
                        </div>
                        <p class="content_color">Not Scheduled</p>
                      </div>
                    </div>
                    <div>
                      <center>
                        <a href="<?php echo base_url('owner/workOrderDetails/').$getworkorder['id'];?>" class="btn  view_work_order" style="margin-bottom: 20px;" file-name="">VIEW WORK ORDER
                        </a>
                      </center>
                    </div>
                  </div>
                </div>
              </div>

          


            </div>

<br>
    <div class="row" id="manage_worker">
<div id="ember1279" class="col s12 participants-flex-ordered ember-view">            <h3>Participants</h3>
   <p>
                  Managed By <a class=" edit_style clickable edit-managed-by" data-ember-action="" data-ember-action-1337="1337"><i class="material-icons">edit</i></a>
                </p>
              <div class="row participants">
               
                <div class="managed-by participant">
                  <div class="info">
                    <div class="name">
                      ravi birla
                    </div>
                    <a href="tel:(958) 431-6586" class="phone-number">
                      <u>(958) 431-6586</u>
                    </a>
                  </div>
                </div>
              </div>
              <div class="row participants tenants">
                <p>
                  Others <a class=" edit_style clickable edit-tenants"><i class="material-icons" data-ember-action="" data-ember-action-1338="1338">edit</i></a>
                </p>
<!----><!---->              </div>
            
</div>        </div>
         
          <?php } ?>
  
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg">
            <div>
           
         </div>
      </div> -->
    </div>
         </div>
         

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
            <!-- ADD SERVICE PRO button -->
            

            <div style="color: red;"><?php echo $this->session->flashdata('errmsg')?></div>
            <!-- ADD SERVICE PRO button -->
            <!-- The Modal -->
            <div class="modal" id="teamModal">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title">New Maintenance Work Order</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Modal body -->
                  </div>
               </div>
            </div>
       
      
   </div>
</div>

<?php

function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return ' 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60 
                                     =>  'minute',
                60                      =>  'second',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return ' ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
?>
<script type="text/javascript">
  // DROPZONE Request FILE UPLOADING STARTS
  Dropzone.autoDiscover = false;
        $(".dropzone").requestdropzone({
          success: function( file, response ) {
        obj = JSON.parse(response);
        file.previewElement.id = obj.filename;
        },
            addRemoveLinks: true,
            removedfile: function(file) {
                var name = file.previewElement.id;
                request_id = $('#id').val();
                $.ajax({
                    type: 'POST',
                    url: "<?php //echo base_url('owner/request_doc_uploadAndDelete')?>",
                    data: {name: name,id:request_id,request: 'REMOVEFILE'},
                    success: function(data){
                        console.log('success: ' + data);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });
        // DROPZONE Request FILE UPLOADING ENDS
</script>

<script type="text/javascript">
  function show1(){
  document.getElementById('div1').style.display ='block';
  document.getElementById('div2').style.display = 'none';
  document.getElementById('div3').style.display = 'none';

}
function show2(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='block';
  document.getElementById('div3').style.display = 'none';
}
function show3(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display = 'block';
}
</script>

   <script>
function check_box() {
 var checkBox = document.getElementById("check_include_close");
 var text = document.getElementById("detail_worker");
 if (checkBox.checked == true){
   text.style.display = "block";
   document.getElementById("manage_worker")style.display="none";
  else {

  if (checkBox.checked == false)
  {
    document.getElementById("manage_worker")style.display="block";
    text.style.display = "none";
  }
 
    
 }
}
}
</script>
<style type="text/css">
  .hide {
  display: none;
}
</style>
