<?php
if ( ! function_exists('check_subscription'))
{
    function check_subscription($owner_id){
		$CI =& get_instance();
		$is_subscribed = $CI->common_model->check_subscription($owner_id); 
		//echo $CI->db->last_query(); exit;
		$subs_status = $is_subscribed['error'];
		if($subs_status == 'success')
			return 'success';
		elseif($subs_status == 'enddate')
			return 'subscriptions_next';  //
		else
			redirect(base_url('owner/subscriptions_prompt_next'));
    }
}