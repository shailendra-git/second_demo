<?php $url = 'https://onelane.com.au/'; ?>
<style>
.custom-menu
{
   list-style: none;
   padding: 0;
   margin: 0;
   list-style-type: none;
   line-height: 2rem;
}
.custom-menu_ul2
{
   list-style: none;
   padding: 0;
   margin: 0;
   list-style-type: none;
   line-height: 2rem;
}
.menu-item-view
{
   color: #ffffff;
   text-decoration: none;
   font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;

}
.widget-title{
	color: #ffffff;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}
.menu-item-view:hover {
   color: #ffffff !important;
   text-decoration: none !important;
}
@media screen and (max-width: 823px){
    .menu_item_view
	{
	  width: 50% !important;
	}
}
</style>
<footer class="footer_back">
<div class=" container padding_view">
  <div class="row">
    <div class="col-md-3 menu_item_view">
    <div class="custom-menu_ul"><h5 class="widget-title">How it works</h5>
    <ul class="custom-menu">
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>how-it-works/for-tenants/">For Tenants</a></li>
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>how-it-works/for-managers/">For Managers</a></li>
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>how-it-works/for-agents/">For Agents</a></li>
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>how-it-works/for-owners/">For Owners</a></li></ul>
     </div>
    </div>

    <div class="col-md-2 menu_item_view">
    <div class="custom-menu_ul2"><h5 class="widget-title">About Us</h5>
    <ul class="custom-menu">
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>about/">About OneLane</a></li>
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>contact-us/">Contact Us</a></li>
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>careers/">Careers</a></li>
   	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>features/">Features</a></li>
	<li class="menu-item"><a class="menu-item-view" href="<?php echo $url; ?>pricing/">Pricing</a></li>
   </ul>
    </div>
    </div>
  </div>  
</div>
      <div class="container container_width">
         <p style="margin-bottom: 0px;" class="footer_p_clr text-center footer_last menu-item-view">© Onelane, Inc. <?php echo  date(Y) ?></p>
      </div>
 </footer>
 </body>
</html>